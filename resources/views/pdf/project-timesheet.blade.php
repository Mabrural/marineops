<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Project Timesheet</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        .container {
            width: 100%;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* ===== INFORMATION BLOCK ===== */

        .info-block {
            margin: 10px 0 20px 0;
            font-size: 11px;
        }

        .info-row {
            display: table;
            width: 100%;
            line-height: 1.3;
        }

        .info-label {
            display: table-cell;
            width: 130px;
            font-weight: bold;
        }

        .info-separator {
            display: table-cell;
            width: 10px;
        }

        .info-value {
            display: table-cell;
        }

        .divider {
            border-bottom: 1px solid #000;
            margin: 10px 0;
        }

        /* ===== TABLE STYLE CLASSIC ===== */

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1.5px solid #000;
        }

        thead th {
            background-color: #f5f5f5;
            border: 1px solid #000;
            padding: 3px;
            text-align: center;
            font-weight: bold;
        }

        tbody td {
            border: 1px solid #000;
            padding: 1px;
            vertical-align: middle;
        }

        .no-col {
            width: 5%;
            text-align: center;
        }

        .date-col {
            width: 30%;
        }

        .position-col {
            width: 40%;
        }

        .status-col {
            width: 25%;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="title">PROJECT TIMESHEET</div><br>

        @if ($project->voyages->count())

            <div class="info-block">

                @foreach ($project->voyages as $voyage)
                    <div class="info-row">
                        <div class="info-label">Project</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $project->client->name }} (Voy-{{ $project->project_number }})</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Type</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">
                            {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $project->type)) }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Loading Port</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $voyage->loadingPort->name ?? '-' }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Discharge Port</div>
                        <div class="info-separator">:</div>
                        <div class="info-value">{{ $voyage->dischargePort->name ?? '-' }}</div>
                    </div>

                    @if (!$loop->last)
                        <div class="divider"></div>
                    @endif
                @endforeach

            </div>
        @else
            <div class="info-block">

                <div class="info-row">
                    <div class="info-label">Project</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">{{ $project->client->name }} (Voy-{{ $project->project_number }})</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Type</div>
                    <div class="info-separator">:</div>
                    <div class="info-value">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $project->type)) }}
                    </div>
                </div>

            </div>

        @endif

        <table>
            <thead>
                <tr>
                    <th class="no-col">No</th>
                    <th class="date-col">Date & Time</th>
                    <th class="position-col">Position</th>
                    <th class="status-col">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($timesheets as $timesheet)
                    <tr>
                        <td class="no-col">{{ $loop->iteration }}</td>
                        <td class="date-col">
                            {{ $timesheet->datetime->format('d M Y H:i') }}
                        </td>
                        <td class="position-col">
                            {{ $timesheet->position }}
                        </td>
                        <td class="status-col">
                            {{ $timesheet->status }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:15px; font-style:italic;">
                            No Records Found for Selected Period
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            Generated at {{ now()->format('d M Y H:i') }}
        </div>

    </div>

</body>

</html>
