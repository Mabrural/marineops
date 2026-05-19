<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Certificate Reminder</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <h2>Certificate Reminder Notification</h2>

    {{-- EXPIRED --}}
    @if ($expiredCertificates->count())

        <h3 style="color:red;">
            Expired Certificates
        </h3>

        <table border="1"
            cellpadding="8"
            cellspacing="0"
            width="100%">

            <thead>
                <tr>
                    <th>Vessel</th>
                    <th>Certificate</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($expiredCertificates as $certificate)

                    <tr>
                        <td>{{ $certificate->vessel->name }}</td>
                        <td>{{ $certificate->name }}</td>
                        <td>{{ $certificate->expiry_date->format('d M Y') }}</td>
                    </tr>

                @endforeach

            </tbody>

        </table>

        <br>

    @endif

    {{-- EXPIRING SOON --}}
    @if ($expiringCertificates->count())

        <h3 style="color:orange;">
            Expiring Within 30 Days
        </h3>

        <table border="1"
            cellpadding="8"
            cellspacing="0"
            width="100%">

            <thead>
                <tr>
                    <th>Vessel</th>
                    <th>Certificate</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($expiringCertificates as $certificate)

                    <tr>
                        <td>{{ $certificate->vessel->name }}</td>
                        <td>{{ $certificate->name }}</td>
                        <td>{{ $certificate->expiry_date->format('d M Y') }}</td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

    @if (!$expiredCertificates->count() && !$expiringCertificates->count())

        <p>No certificate reminders today.</p>

    @endif

</body>

</html>