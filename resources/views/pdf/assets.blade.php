<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Asset List</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding-left: 3px;
            padding-top: 0%;
            padding-bottom: 0%;
        }

        th {
            background: #f2f2f2;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        h2 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <h2 style="margin-bottom:5px;">Asset List</h2>

    <p style="margin:0; font-size:11px;">
        <strong>Last Checked :</strong> 
    </p>

    <br>

    <table>
        <thead>
            <tr>
                <th width="3%" class="text-center">No</th>
                <th>Asset</th>
                <th width="15%">Model/Merk</th>
                <th width="15%">Vessel</th>
                <th width="15%">Group</th>
                <th width="4%" class="text-center">Qty</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assets as $index => $asset)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->model ?? 'N/A' }}</td>
                    <td>{{ $asset->vessel->name ?? '-' }}</td>
                    <td>{{ $asset->group->name ?? '-' }}</td>
                    <td class="text-center">{{ $asset->qty }}</td>
                    <td>{{ $asset->remarks ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No Data Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
