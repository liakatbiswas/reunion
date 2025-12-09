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

        // Landscape Page Setup
        $sectionStyle = [
            'orientation' => 'landscape',
            'marginLeft' => 600,
            'marginRight' => 600,
            'marginTop' => 600,
            'marginBottom' => 600,
        ];
        $section = $phpWord->addSection($sectionStyle);

        // Title
        $section->addText('Participant List', ['bold' => true, 'size' => 16]);
        $section->addTextBreak(1);

        // Table style
        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 50,
        ];
        $phpWord->addTableStyle('ParticipantTable', $tableStyle);
        $table = $section->addTable('ParticipantTable');

        // Table Headings (18 fields)
        $headings = [
            'Name',
            'Registration ID',
            'Batch',
            'Division',
            'District',
            'Upazila',
            'User',
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

        $table->addRow();
        foreach ($headings as $heading) {
            $table->addCell(2000)->addText($heading, ['bold' => true]);
        }

        // Fetch Data with Relations and optional search
        $query = Registration::with(['batch', 'division', 'district', 'upazila', 'user'])
            ->join('batches', 'registrations.batch_id', '=', 'batches.id')
            ->orderBy('batches.name', 'asc')
            ->select('registrations.*');

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('regi_id', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->orWhere('bKash', 'like', "%{$this->search}%")
                ->orWhereHas('batch', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('division', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('district', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('upazila', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$this->search}%"));
        }

        $records = $query->get();

        // Add Data Rows
        foreach ($records as $r) {
            $table->addRow();
            $table->addCell(2000)->addText($r->name);
            $table->addCell(2000)->addText($r->regi_id);
            $table->addCell(2000)->addText($r->batch?->name ?? '');
            $table->addCell(2000)->addText($r->division?->name ?? '');
            $table->addCell(2000)->addText($r->district?->name ?? '');
            $table->addCell(2000)->addText($r->upazila?->name ?? '');
            $table->addCell(2000)->addText($r->user?->name ?? '');
            $table->addCell(2000)->addText($r->village);
            $table->addCell(2000)->addText($r->post_office);
            $table->addCell(2000)->addText($r->status);
            $table->addCell(2000)->addText($r->occupation);
            $table->addCell(2000)->addText($r->phone);

            // Photo (embed if exists)
            $cell = $table->addCell(2000);
            if ($r->photo && file_exists(storage_path('app/public/'.$r->photo))) {
                $cell->addImage(storage_path('app/public/'.$r->photo), [
                    'width' => 50,
                    'height' => 50,
                    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
                ]);
            } else {
                $cell->addText('-');
            }

            $table->addCell(2000)->addText($r->bKash);
            $table->addCell(2000)->addText($r->email);
            $table->addCell(2000)->addText(ucfirst($r->gender));
            $table->addCell(2000)->addText($r->amount);
            $table->addCell(2000)->addText($r->note);
        }

        // Generate Word File
        $fileName = 'participants.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
