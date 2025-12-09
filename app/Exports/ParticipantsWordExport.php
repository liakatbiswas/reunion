<?php

namespace App\Exports;

use App\Models\Registration;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;

class ParticipantsWordExport
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function download()
    {
        $phpWord = new PhpWord;

        // Set default font
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(10);

        // Landscape Page Setup
        $sectionStyle = [
            'orientation' => 'landscape',
            'marginLeft' => 600,
            'marginRight' => 600,
            'marginTop' => 600,
            'marginBottom' => 600,
        ];
        $section = $phpWord->addSection($sectionStyle);

        // Title Style
        $section->addText(
            'Participant List',
            ['name' => 'Arial', 'size' => 16, 'bold' => true, 'color' => '000000'],
            ['alignment' => Jc::CENTER]
        );
        $section->addTextBreak(1);

        // Table style with visible borders
        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80,
            'alignment' => Jc::CENTER,
        ];
        $phpWord->addTableStyle('ParticipantTable', $tableStyle);

        // First Cell Style
        $firstRowStyle = [
            'bgColor' => 'CCCCCC',
            'valign' => 'center',
        ];

        $cellStyle = [
            'valign' => 'center',
        ];

        $table = $section->addTable('ParticipantTable');

        // Table Headings
        $headings = [
            'Name', 'Registration ID', 'Batch', 'Division', 'District', 'Upazila',
            'User', 'Village', 'Post Office', 'Status', 'Occupation', 'Phone',
            'Photo', 'bKash', 'Email', 'Gender', 'Amount', 'Note',
        ];

        $table->addRow(900);
        foreach ($headings as $heading) {
            $cell = $table->addCell(1500, $firstRowStyle);
            $textRun = $cell->addTextRun(['alignment' => Jc::CENTER]);
            $textRun->addText(
                $heading,
                ['name' => 'Arial', 'size' => 10, 'bold' => true, 'color' => '000000']
            );
        }

        // Fetch Data
        $query = Registration::with(['batch', 'division', 'district', 'upazila', 'user'])
            ->join('batches', 'registrations.batch_id', '=', 'batches.id')
            ->orderBy('batches.name', 'asc')
            ->select('registrations.*');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('regi_id', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%")
                    ->orWhere('bKash', 'like', "%{$this->search}%")
                    ->orWhereHas('batch', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                    ->orWhereHas('division', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                    ->orWhereHas('district', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                    ->orWhereHas('upazila', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                    ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$this->search}%"));
            });
        }

        $records = $query->get();

        // Font style for data
        $fontStyle = ['name' => 'Arial', 'size' => 9, 'color' => '000000'];

        // Add Data Rows
        foreach ($records as $r) {
            $table->addRow(1400);

            // Add each cell with explicit styling
            $table->addCell(1500, $cellStyle)->addText($r->name ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->regi_id ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->batch?->name ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->division?->name ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->district?->name ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->upazila?->name ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->user?->name ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->village ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->post_office ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->status ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->occupation ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->phone ?? '-', $fontStyle);

            // Photo cell
            $photoCell = $table->addCell(1500, $cellStyle);
            if ($r->photo && file_exists(storage_path('app/public/'.$r->photo))) {
                try {
                    $photoCell->addImage(
                        storage_path('app/public/'.$r->photo),
                        [
                            'width' => 50,
                            'height' => 50,
                            'alignment' => Jc::CENTER,
                        ]
                    );
                } catch (\Exception $e) {
                    $photoCell->addText('Error', $fontStyle);
                }
            } else {
                $photoCell->addText('-', $fontStyle);
            }

            $table->addCell(1500, $cellStyle)->addText($r->bKash ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->email ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText(ucfirst($r->gender ?? '-'), $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->amount ?? '-', $fontStyle);
            $table->addCell(1500, $cellStyle)->addText($r->note ?? '-', $fontStyle);
        }

        // Generate Word File
        $fileName = 'participants_'.date('Y-m-d_His').'.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
