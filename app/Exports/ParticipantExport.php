<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ParticipantExport implements FromCollection, WithColumnWidths, WithDrawings, WithEvents, WithHeadings, WithMapping
{
    protected $search;

    protected $registrations;

    protected $rowNumber = 2; // Starting from row 2 (after heading)

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    // Data Collection
    public function collection()
    {
        $query = Registration::with(['batch', 'division', 'district', 'upazila', 'user']);

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('regi_id', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->orWhere('bKash', 'like', "%{$this->search}%")
                ->orWhereHas('batch', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('division', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('district', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('upazila', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$this->search}%"));
        }

        // Order by batch name
        $this->registrations = $query->join('batches', 'registrations.batch_id', '=', 'batches.id')
            ->orderBy('batches.name', 'asc')
            ->select('registrations.*')
            ->get();

        return $this->registrations;
    }

    // Map each row to Excel format
    public function map($registration): array
    {
        return [
            $registration->name,
            $registration->regi_id,
            $registration->batch?->name ?? '',
            $registration->division?->name ?? '',
            $registration->district?->name ?? '',
            $registration->upazila?->name ?? '',
            $registration->user?->name ?? '',
            $registration->village,
            $registration->post_office,
            $registration->status,
            $registration->occupation,
            $registration->phone,
            '', // Photo column - will be filled by drawings
            $registration->bKash,
            $registration->email,
            ucfirst($registration->gender),
            $registration->amount,
            $registration->note,
        ];
    }

    // Column Headings
    public function headings(): array
    {
        return [
            'Name',
            'Registration ID',
            'Batch',
            'Division',
            'District',
            'Upazila',
            'Registered By',
            'Village',
            'Post Office',
            'Status',
            'Occupation',
            'Phone',
            'Photo',
            'bKash',
            'Email',
            'Gender',
            'Amount',
            'Note',
        ];
    }

    // Add images to Excel
    public function drawings()
    {
        $drawings = [];
        $row = 2; // Start from row 2 (after heading)

        foreach ($this->registrations as $registration) {
            if ($registration->photo) {
                $photoPath = storage_path('app/public/'.$registration->photo);

                // Check if file exists
                if (file_exists($photoPath)) {
                    $drawing = new Drawing;
                    $drawing->setName('Photo');
                    $drawing->setDescription('Participant Photo');
                    $drawing->setPath($photoPath);
                    $drawing->setHeight(50);              // Set image height in pixels
                    $drawing->setCoordinates('M'.$row); // Column M (Photo column)
                    $drawing->setOffsetX(5);
                    $drawing->setOffsetY(5);

                    $drawings[] = $drawing;
                }
            }
            $row++;
        }

        return $drawings;
    }

    // Set column widths
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Name
            'B' => 18, // Registration ID
            'C' => 15, // Batch
            'D' => 15, // Division
            'E' => 15, // District
            'F' => 15, // Upazila
            'G' => 20, // User
            'H' => 15, // Village
            'I' => 15, // Post Office
            'J' => 12, // Status
            'K' => 15, // Occupation
            'L' => 15, // Phone
            'M' => 15, // Photo
            'N' => 15, // bKash
            'O' => 25, // Email
            'P' => 10, // Gender
            'Q' => 12, // Amount
            'R' => 30, // Note
        ];
    }

    // Set row heights for images
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Set row height for all data rows
                $rowCount = $this->registrations->count() + 1; // +1 for heading
                for ($row = 2; $row <= $rowCount; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(60); // Set row height
                }

                // Style heading row
                $sheet->getStyle('A1:R1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E0E0E0'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Center align all cells
                $sheet->getStyle('A1:R'.$rowCount)->applyFromArray([
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
