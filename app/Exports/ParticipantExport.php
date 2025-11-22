<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    // Data Collection
    public function collection()
    {
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

        return $query->get();
    }

    // Map each row to Excel format
    public function map($registration): array
    {
        return [
            $registration->name,
            $registration->email,
            $registration->phone,
            $registration->regi_id,
            $registration->batch?->name ?? '',
            $registration->division?->name ?? '',
            $registration->district?->name ?? '',
            $registration->upazila?->name ?? '',
            $registration->occupation,
            ucfirst($registration->gender),
            ucfirst(str_replace('_', ' ', $registration->member_type)),
            $registration->children,
            $registration->amount,
        ];
    }

    // Column Headings
    public function headings(): array
    {
        return [
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
    }
}
