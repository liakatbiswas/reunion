<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <title>Registration List</title>

    <style>
        @page {
            size: A4;
            margin: 10mm 10mm 10mm 10mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans Bengali', 'DejaVu Sans', sans-serif;
            font-size: 8pt;
            line-height: 1.3;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }

        .header h1 {
            font-size: 18pt;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .header p {
            font-size: 9pt;
            color: #555;
        }

        .meta-info {
            display: table;
            width: 100%;
            margin-bottom: 10px;
            font-size: 8pt;
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
            margin-bottom: 10px;
            page-break-inside: auto;
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
            padding: 6px 3px;
            text-align: left;
            font-size: 7pt;
            border: 1px solid #2c3e50;
        }

        td {
            padding: 5px 3px;
            border: 1px solid #bdc3c7;
            font-size: 7pt;
            vertical-align: top;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #e8f4f8;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 6pt;
            font-weight: bold;
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

        .photo-cell {
            text-align: center;
            padding: 3px;
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
            font-size: 7pt;
            padding: 5px;
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
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            display: table;
            width: 100%;
        }

        .summary-item {
            display: table-cell;
            padding: 0 10px;
            font-size: 8pt;
        }

        .summary-item strong {
            color: #2c3e50;
        }

        .compact th {
            padding: 4px 2px;
            font-size: 6.5pt;
        }

        .compact td {
            padding: 3px 2px;
            font-size: 6.5pt;
        }
    </style>
</head>

<body style="padding: 20px">
    <!-- Header -->
    <div class="header">
        <h1>Registration List</h1>
        <p>Complete Registration Records</p>
    </div>

    <!-- Meta Information -->
    <div class="meta-info">
        <div class="left">
            <strong>Generated:</strong> {{ now()->format('d M Y, h:i A') }}
        </div>
        <div class="right">
            <strong>Total Records:</strong> {{ count($participants) }}
        </div>
    </div>

    <!-- Summary Box -->
    <div class="summary-box">
        <div class="summary-item">
            <strong>Active:</strong> {{ $participants->where('status', 'active')->count() }}
        </div>
        <div class="summary-item">
            <strong>Pending:</strong> {{ $participants->where('status', 'pending')->count() }}
        </div>
        <div class="summary-item">
            <strong>Male:</strong> {{ $participants->where('gender', 'male')->count() }}
        </div>
        <div class="summary-item">
            <strong>Female:</strong> {{ $participants->where('gender', 'female')->count() }}
        </div>
        <div class="summary-item">
            <strong>Total Amount:</strong> {{ number_format($participants->sum('amount')) }}
        </div>
    </div>

    <!-- Main Table -->
    <table class="compact">
        <thead>
            <tr>
                <th style="width: 3%;">#</th>
                <th style="width: 5%;">Photo</th>
                <th style="width: 8%;">Regi ID</th>
                <th style="width: 12%;">Name</th>
                <th style="width: 8%;">Phone</th>
                <th style="width: 8%;">Batch</th>
                <th style="width: 10%;">Address</th>
                <th style="width: 6%;">Gender</th>
                <th style="width: 8%;">Member Type</th>
                <th style="width: 5%;">Children</th>
                <th style="width: 7%;">Amount</th>
                <th style="width: 6%;">Status</th>
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

                    <td class="nowrap text-bold">{{ $registration->regi_id }}</td>
                    <td>{{ $registration->name }}</td>
                    <td class="nowrap">{{ $registration->phone }}</td>
                    <td>{{ $registration->batch?->name ?? '-' }}</td>

                    <td>
                        {{ $registration->village }},
                        {{ $registration->upazila?->name ?? '' }}
                        @if ($registration->district)
                            , {{ $registration->district->name }}
                        @endif
                    </td>

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

                    <td style="font-size: 6pt;">
                        @switch($registration->member_type)
                            @case('single')
                                Single
                            @break

                            @case('couple')
                                Couple
                            @break

                            @case('parent_with_children')
                                Parent+Kids
                            @break

                            @case('couple_with_children')
                                Couple+Kids
                            @break

                            @case('children_only')
                                Kids Only
                            @break
                        @endswitch
                    </td>

                    <td class="text-center">{{ $registration->children }}</td>

                    <td class="text-right">{{ number_format($registration->amount) }}</td>

                    <td class="text-center">
                        <span class="status-badge status-{{ $registration->status }}">
                            {{ $registration->status }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="9" class="text-right text-bold">Total:</td>

                <td class="text-right text-bold">{{ number_format($participants->sum('children')) }}</td>
                <td class="text-right text-bold">{{ number_format($participants->sum('amount')) }}</td>

                <td colspan="1"></td>
            </tr>
        </tfoot>
    </table>

    <!-- Footer -->
    <div class="footer">
        <span class="page-number"></span> | Generated by Registration System | Confidential
    </div>

</body>

</html>
