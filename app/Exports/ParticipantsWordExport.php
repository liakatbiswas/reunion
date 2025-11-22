<?php

namespace App\Exports;

use App\Models\Registration;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

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
        $section = $phpWord->addSection();

        // Title
        $section->addText(
            'Participant List',
            ['bold' => true, 'size' => 16]
        );

        $section->addTextBreak(1);

        // Table style
        $style = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 50,
        ];
        $phpWord->addTableStyle('ParticipantTable', $style);

        $table = $section->addTable('ParticipantTable');

        // Table Headings
        $headings = [
            'Student Name',
            'Email Address',
            'Phone Number',
            'Registration ID',
            'Batch',
            'Division',
            'District',
            'Upazila',
            'Occupation',
            'Gender',
            'Member Type',
            'Children',
            'Amount',
        ];

        $table->addRow();
        foreach ($headings as $heading) {
            $table->addCell(2000)->addText($heading, ['bold' => true]);
        }

        // Fetch Data (Same as your Excel)
        $query = Registration::with(['batch', 'division', 'district', 'upazila']);

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('regi_id', 'like', "%{$this->search}%")
                ->orWhereHas('batch', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                })
                ->orWhere('phone', 'like', "%{$this->search}%");
        }

        $records = $query->get();

        // Add Data Rows
        foreach ($records as $r) {
            $table->addRow();

            $table->addCell(2000)->addText($r->name);
            $table->addCell(2000)->addText($r->email);
            $table->addCell(2000)->addText($r->phone);
            $table->addCell(2000)->addText($r->regi_id);

            $table->addCell(2000)->addText($r->batch?->name ?? '');
            $table->addCell(2000)->addText($r->division?->name ?? '');
            $table->addCell(2000)->addText($r->district?->name ?? '');
            $table->addCell(2000)->addText($r->upazila?->name ?? '');

            $table->addCell(2000)->addText($r->occupation);
            $table->addCell(2000)->addText(ucfirst($r->gender));
            $table->addCell(2000)->addText(ucfirst(str_replace('_', ' ', $r->member_type)));
            $table->addCell(2000)->addText($r->children);
            $table->addCell(2000)->addText($r->amount);
        }

        // Generate file
        $fileName = 'participants.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
