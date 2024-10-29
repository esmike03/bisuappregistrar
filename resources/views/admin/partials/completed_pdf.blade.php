<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Requests PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Wrapper for header elements */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Aligns each item in a row */
        .header-cell {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding: 5px;
        }

        .header img {
            display: block;
            margin: 0 auto;
            height: 60px;
            width: auto;
        }

        h1 {
            margin: 0;
            font-size: 12px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-cell">
            <img src="{{ public_path('images/header.png') }}" alt="BISU Logo">
        </div>

    </div>
    @php
        use Carbon\Carbon;

        // Convert numeric month to word (e.g., 11 -> November)
        $monthInWords = $month ? Carbon::createFromDate(null, $month)->format('F') : 'N/A';
    @endphp
    <h1>Report for the Month of {{ $monthInWords }}</h1>

    <table>
        <thead>
            <tr>
                <th>Request Document Report</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requestCounts as $requestName => $count)
                <tr>
                    <td>{{ $requestName }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Request</th>
            </tr>
        </thead>
        <tbody>
            @if ($appointments)
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->fname }} {{ $appointment->lname }}</td>
                        <td>{{ $appointment->request }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

</body>

</html>
