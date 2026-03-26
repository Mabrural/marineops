<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Vessel Certificates List</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding-left: 3px;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        th {
            background: #f2f2f2;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        h2 {
            margin-bottom: 5px;
        }
    </style>

</head>

<body>

    <h2>Vessel Certificates List</h2>

    <p style="margin:0;">
        <strong>Generated :</strong>
        {{ now()->format('d M Y H:i') }}
    </p>

    <br>

    <table>

        <thead>
            <tr>
                <th width="3%" class="text-center">No</th>
                <th>Certificate</th>
                <th width="18%">Vessel</th>
                <th width="12%">Issue Date</th>
                <th width="12%">Expiry Date</th>
                <th width="10%">Status</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($certificates as $index => $certificate)
                @php

                    if ($certificate->isExpired()) {
                        $status = 'Expired';
                    } elseif ($certificate->isExpiringSoon()) {
                        $status = 'Expiring Soon';
                    } else {
                        $status = 'Valid';
                    }

                @endphp

                <tr>

                    <td class="text-center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $certificate->name }}
                    </td>

                    <td>
                        {{ $certificate->vessel->name ?? '-' }}
                    </td>

                    <td>
                        {{ $certificate->issue_date->format('d M Y') }}
                    </td>

                    <td>
                        {{ $certificate->expiry_date->format('d M Y') }}
                    </td>

                    <td class="text-center">
                        {{ $status }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center">
                        No Data Available
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

</body>

</html>
