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
        return $query->join('batches', 'registrations.batch_id', '=', 'batches.id')
            ->orderBy('batches.name', 'asc')
            ->select('registrations.*')
            ->get();
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
            $registration->photo ? asset('storage/'.$registration->photo) : '',
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
    }
}
