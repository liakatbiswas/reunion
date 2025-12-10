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

        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(10);

        $section = $phpWord->addSection([
            'orientation' => 'landscape',
            'marginLeft' => 600,
            'marginRight' => 600,
            'marginTop' => 600,
            'marginBottom' => 600,
        ]);

        $section->addText(
            'Participant List',
            ['name' => 'Arial', 'size' => 16, 'bold' => true],
            ['alignment' => Jc::CENTER]
        );
        $section->addTextBreak(1);

        // Table style
        $phpWord->addTableStyle('ParticipantTable', [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80,
        ]);

        $firstRowStyle = [
            'bgColor' => 'CCCCCC',
            'valign' => 'center',
        ];

        $cellStyle = ['valign' => 'center'];

        $table = $section->addTable('ParticipantTable');

        $headings = [
            'Id', 'Name', 'Registration ID', 'Batch', 'Division', 'District', 'Upazila',
            'User', 'Village', 'Post Office', 'Status', 'Occupation', 'Phone',
            'Photo', 'bKash', 'Email', 'Gender', 'Amount', 'Note',
        ];

        $table->addRow(900);
        foreach ($headings as $heading) {
            $cell = $table->addCell(1500, $firstRowStyle);
            $cell->addText($heading, ['bold' => true], ['alignment' => Jc::CENTER]);
        }

        // ------------------------------------------
        // FIXED QUERY — NO WHEREHAS — NO AMBIGUITY
        // ------------------------------------------

        $query = Registration::query()
            ->leftJoin('batches', 'registrations.batch_id', '=', 'batches.id')
            ->leftJoin('divisions', 'registrations.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'registrations.district_id', '=', 'districts.id')
            ->leftJoin('upazilas', 'registrations.upazila_id', '=', 'upazilas.id')
            ->leftJoin('users', 'registrations.user_id', '=', 'users.id')
            ->select('registrations.*')
            ->orderBy('batches.name', 'asc');

        if ($this->search) {
            $s = $this->search;

            $query->where(function ($x) use ($s) {
                $x->where('registrations.name', 'like', "%{$s}%")
                    ->orWhere('registrations.regi_id', 'like', "%{$s}%")
                    ->orWhere('registrations.email', 'like', "%{$s}%")
                    ->orWhere('registrations.phone', 'like', "%{$s}%")
                    ->orWhere('registrations.bKash', 'like', "%{$s}%")

                    ->orWhere('batches.name', 'like', "%{$s}%")
                    ->orWhere('divisions.name', 'like', "%{$s}%")
                    ->orWhere('districts.name', 'like', "%{$s}%")
                    ->orWhere('upazilas.name', 'like', "%{$s}%")
                    ->orWhere('users.name', 'like', "%{$s}%");
            });
        }

        $records = $query->with(['batch', 'division', 'district', 'upazila', 'user'])->get();

        // Data font style
        $fontStyle = ['name' => 'Arial', 'size' => 9];

        // ------------------------------------------
        // Add table rows
        // ------------------------------------------
        foreach ($records as $index => $r) {
            $table->addRow(1400);

            $table->addCell(1500, $cellStyle)->addText($index + 1 ?? '-', $fontStyle);
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

            // Photo
            $photoCell = $table->addCell(1500, $cellStyle);
            $photoPath = storage_path('app/public/'.$r->photo);

            if ($r->photo && file_exists($photoPath)) {
                try {
                    $photoCell->addImage($photoPath, [
                        'width' => 50,
                        'height' => 50,
                        'alignment' => Jc::CENTER,
                    ]);
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
