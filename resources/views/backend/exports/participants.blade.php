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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans Bengali', 'DejaVu Sans', sans-serif;
            font-size: 9px;
            line-height: 1.2;
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #333;
        }

        .header h1 {
            font-size: 12px;
            margin-bottom: 3px;
            color: #2c3e50;
        }

        .header p {
            font-size: 9px;
            color: #555;
        }

        .meta-info {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }

        .meta-info>div {
            display: table-cell;
        }

        .meta-info .left {
            text-align: left;
        }

        .meta-info .right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            page-break-inside: auto;
            font-size: 9px;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th {
            background-color: #34495e;
            color: #fff;
            font-weight: bold;
            padding: 5px;
            text-align: left;
            border: 1px solid #2c3e50;
            font-size: 9px;
        }

        td {
            padding: 4px;
            border: 1px solid #bdc3c7;
            vertical-align: top;
            font-size: 9px;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .status-badge {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 3px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8px;
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

        .photo-cell {
            text-align: center;
            padding: 1px;
        }

        .photo-cell img {
            width: 25px;
            height: 25px;
            border-radius: 3px;
            object-fit: cover;
            border: 1px solid #bdc3c7;
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

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        .nowrap {
            white-space: nowrap;
        }

        .summary-box {
            background-color: #ecf0f1;
            padding: 4px;
            margin-bottom: 5px;
            border-radius: 4px;
            display: table;
            width: 100%;
            font-size: 9px;
        }

        .summary-item {
            display: table-cell;
            padding: 0 6px;
        }

        .summary-item strong {
            color: #2c3e50;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h1>Registration List</h1>
        <p>Complete Registration Records</p>
    </div>

    <!-- Meta Info -->
    <div class="meta-info">
        <div class="left"><strong>Generated:</strong> {{ now()->format('d M Y, h:i A') }}</div>
        <div class="right"><strong>Total Records:</strong> {{ $participants->count() }}</div>
    </div>

    <!-- Summary -->
    <div class="summary-box">
        <div class="summary-item"><strong>Active:</strong> {{ $participants->where('status', 'active')->count() }}</div>
        <div class="summary-item"><strong>Pending:</strong> {{ $participants->where('status', 'pending')->count() }}
        </div>
        <div class="summary-item"><strong>Male:</strong> {{ $participants->where('gender', 'male')->count() }}</div>
        <div class="summary-item"><strong>Female:</strong> {{ $participants->where('gender', 'female')->count() }}</div>
        <div class="summary-item"><strong>Total Amount:</strong> {{ number_format($participants->sum('amount')) }}</div>
    </div>

    <!-- Main Table -->
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
                            <img src="{{ public_path('storage/' . $registration->photo) }}" alt="Photo">
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
                            @if ($registration->gender == 'male')
                                Male
                            @elseif($registration->gender == 'female')
                                Female
                            @else
                                Other
                            @endif
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

    <!-- Footer -->
    <div class="footer">
        <span class="page-number"></span> | Generated by Registration System | Confidential
    </div>

</body>

</html>
