<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <title>Registration List</title>
    <style>
        @page {
            size: legal landscape;
            margin: 10mm;
        }

        @font-face {
            font-family: 'NikoshBAN';
            src: url('{{ storage_path('fonts/NikoshBAN.ttf') }}') format('truetype');
        }

        body {
            font-family: 'NikoshBAN', 'Noto Sans Bengali', 'DejaVu Sans', sans-serif;
            font-size: 9px;
            line-height: 1.2;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            page-break-inside: auto;
            font-size: 9px;
        }

        th,
        td {
            border: 1px solid #bdc3c7;
            padding: 4px;
            vertical-align: top;
            font-size: 9px;
        }

        th {
            background-color: #34495e;
            color: #fff;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        .photo-cell img {
            width: 25px;
            height: 25px;
            object-fit: cover;
            border: 1px solid #bdc3c7;
            border-radius: 3px;
        }

        .status-badge {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 8px;
            text-transform: uppercase;
        }

        .status-active {
            background-color: #27ae60;
            color: #fff;
        }

        .status-pending {
            background-color: #f39c12;
            color: #fff;
        }

        .gender-male {
            color: #3498db;
        }

        .gender-female {
            color: #e91e63;
        }

        .gender-other {
            color: #9b59b6;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #333;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            padding: 3px;
            border-top: 1px solid #bdc3c7;
            background-color: #fff;
        }

        .page-number:before {
            content: "Page " counter(page);
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>রেজিস্ট্রেশন লিস্ট</h1>
        <p>Complete Registration Records</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Regi ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Batch</th>
                <th>Division</th>
                <th>District</th>
                <th>Upazila</th>
                <th>Village</th>
                <th>Post Office</th>
                <th>Occupation</th>
                <th>Gender</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Registered By</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $index => $registration)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="photo-cell">
                        @if ($registration->photo)
                            <img src="{{ storage_path('app/public/' . $registration->photo) }}" alt="Photo">
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-bold">{{ $registration->regi_id }}</td>
                    <td>{{ $registration->name }}</td>
                    <td>{{ $registration->phone }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->batch?->name ?? '-' }}</td>
                    <td>{{ $registration->division?->name ?? '-' }}</td>
                    <td>{{ $registration->district?->name ?? '-' }}</td>
                    <td>{{ $registration->upazila?->name ?? '-' }}</td>
                    <td>{{ $registration->village }}</td>
                    <td>{{ $registration->post_office }}</td>
                    <td>{{ $registration->occupation }}</td>
                    <td class="text-center">
                        <span class="gender-{{ $registration->gender }}">
                            {{ ucfirst($registration->gender) }}
                        </span>
                    </td>
                    <td class="text-right">{{ number_format($registration->amount) }}</td>
                    <td class="text-center">
                        <span class="status-badge status-{{ $registration->status }}">
                            {{ ucfirst($registration->status) }}
                        </span>
                    </td>
                    <td>{{ $registration->user?->name ?? '-' }}</td>
                    <td>{{ $registration->note }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="14" class="text-right text-bold">Total Amount:</td>
                <td class="text-right text-bold">{{ number_format($participants->sum('amount')) }}</td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <span class="page-number"></span> | Generated by Registration System | Confidential
    </div>

</body>

</html>
