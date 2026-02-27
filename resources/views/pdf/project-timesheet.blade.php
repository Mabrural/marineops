<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Project Timesheet</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .container {
            width: 100%;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            color: #666;
            margin-bottom: 20px;
        }

        .info-label {
            font-weight: bold;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            border-bottom: 1px solid #bbb;
            padding: 8px 6px;
            color: #444;
        }

        tbody td {
            padding: 7px 6px;
            border-bottom: 1px solid #e5e5e5;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-col {
            width: 5%;
            text-align: center;
        }

        .date-col {
            width: 30%;
        }

        .position-col {
            width: 35%;
        }

        .status-col {
            width: 20%;
            text-align: center;
        }

        .footer {
            margin-top: 25px;
            font-size: 10px;
            color: #777;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="title">PROJECT TIMESHEET</div>

        @if ($project->voyages->count())

            <div style="margin:15px 0 20px 0; font-size:11px;">

                @foreach ($project->voyages as $voyage)
                    <div style="display:table; width:100%; line-height:1.8;">

                        <div style="display:table-row;">
                            <div style="display:table-cell; width:130px; font-weight:bold;">
                                Project
                            </div>
                            <div style="display:table-cell; width:10px;">
                                :
                            </div>
                            <div style="display:table-cell;">
                                {{ $project->client->name }}
                            </div>
                        </div>

                        <div style="display:table-row;">
                            <div style="display:table-cell; font-weight:bold;">
                                Type
                            </div>
                            <div style="display:table-cell;">
                                :
                            </div>
                            <div style="display:table-cell;">
                                {{ strtoupper($project->type) }}
                            </div>
                        </div>

                        <div style="display:table-row;">
                            <div style="display:table-cell; font-weight:bold;">
                                Loading Port
                            </div>
                            <div style="display:table-cell;">
                                :
                            </div>
                            <div style="display:table-cell;">
                                {{ $voyage->loadingPort->name ?? '-' }}
                            </div>
                        </div>

                        <div style="display:table-row;">
                            <div style="display:table-cell; font-weight:bold;">
                                Discharge Port
                            </div>
                            <div style="display:table-cell;">
                                :
                            </div>
                            <div style="display:table-cell;">
                                {{ $voyage->dischargePort->name ?? '-' }}
                            </div>
                        </div>

                    </div>

                    @if (!$loop->last)
                        <div style="border-bottom:1px solid #e5e5e5; margin:12px 0;"></div>
                    @endif
                @endforeach

            </div>
        @else
            <div style="margin:15px 0 20px 0; font-size:11px; line-height:1.8;">

                <div><strong>Project</strong> : {{ $project->client->name }}</div>
                <div><strong>Type</strong> : {{ strtoupper($project->type) }}</div>

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
                @foreach ($timesheets as $timesheet)
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
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Generated at {{ now()->format('d M Y H:i') }}
        </div>

    </div>

</body>

</html>
