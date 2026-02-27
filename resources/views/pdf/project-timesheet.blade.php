<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Project Timesheet</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
            text-align: left;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="title">Project Timesheet</div>
<div class="subtitle">
    Project: {{ $project->name }}
</div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Date & Time</th>
            <th>Position</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($timesheets as $timesheet)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $timesheet->datetime->format('d M Y H:i') }}</td>
                <td>{{ $timesheet->position }}</td>
                <td>{{ $timesheet->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>