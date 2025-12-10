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

    public function __construct($search = null)
    {
        $this->search = trim($search);
    }

    // Fetch and filter data
    public function collection()
    {
        $query = Registration::query()
            ->join('batches', 'registrations.batch_id', '=', 'batches.id')
            ->join('divisions', 'registrations.division_id', '=', 'divisions.id')
            ->join('districts', 'registrations.district_id', '=', 'districts.id')
            ->join('upazilas', 'registrations.upazila_id', '=', 'upazilas.id')
            ->leftJoin('users', 'registrations.user_id', '=', 'users.id')
            ->when($this->search, function ($q) {
                $q->where(function ($x) {
                    $x->where('registrations.name', 'like', "%{$this->search}%")
                        ->orWhere('registrations.regi_id', 'like', "%{$this->search}%")
                        ->orWhere('registrations.email', 'like', "%{$this->search}%")
                        ->orWhere('registrations.phone', 'like', "%{$this->search}%")
                        ->orWhere('registrations.bKash', 'like', "%{$this->search}%")

                        ->orWhere('batches.name', 'like', "%{$this->search}%")
                        ->orWhere('divisions.name', 'like', "%{$this->search}%")
                        ->orWhere('districts.name', 'like', "%{$this->search}%")
                        ->orWhere('upazilas.name', 'like', "%{$this->search}%")
                        ->orWhere('users.name', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('batches.name', 'asc')
            ->select('registrations.*')
            ->get();

        // load relationships for mapping()
        $this->registrations = $query->load(['batch', 'division', 'district', 'upazila', 'user']);

        return $this->registrations;
    }

    // Map rows
    public function map($reg): array
    {
        return [
            $reg->name,
            $reg->regi_id,
            $reg->batch?->name ?? '',
            $reg->division?->name ?? '',
            $reg->district?->name ?? '',
            $reg->upazila?->name ?? '',
            $reg->user?->name ?? '',
            $reg->village,
            $reg->post_office,
            $reg->status,
            $reg->occupation,
            $reg->phone,
            '', // Photo column
            $reg->bKash,
            $reg->email,
            ucfirst($reg->gender),
            $reg->amount,
            $reg->note,
        ];
    }

    // Headings
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

    // Add images
    public function drawings()
    {
        $drawings = [];
        $row = 2;

        foreach ($this->registrations as $reg) {
            if ($reg->photo) {
                $path = storage_path('app/public/'.$reg->photo);

                if (file_exists($path)) {
                    $drawing = new Drawing;
                    $drawing->setName('Photo');
                    $drawing->setDescription('Participant Photo');
                    $drawing->setPath($path);
                    $drawing->setHeight(60);
                    $drawing->setCoordinates('M'.$row);
                    $drawing->setOffsetX(5);
                    $drawing->setOffsetY(3);
                    $drawings[] = $drawing;
                }
            }
            $row++;
        }

        return $drawings;
    }

    // Column widths
    public function columnWidths(): array
    {
        return [
            'A' => 20, 'B' => 18, 'C' => 15, 'D' => 15,
            'E' => 15, 'F' => 15, 'G' => 20, 'H' => 15,
            'I' => 15, 'J' => 12, 'K' => 15, 'L' => 15,
            'M' => 15, 'N' => 15, 'O' => 25, 'P' => 10,
            'Q' => 12, 'R' => 30,
        ];
    }

    // Styling
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $rowCount = $this->registrations->count() + 1;

                for ($i = 2; $i <= $rowCount; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(70);
                }

                // heading style
                $sheet->getStyle('A1:R1')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => 'E0E0E0'],
                    ],
                ]);
            },
        ];
    }
}
