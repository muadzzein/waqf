<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background-color: #FFEA00	;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: lightyellow;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #FFDB58	;
        }
    </style>
</head>
<body>

<div class="text-center">

<table>
    <tr>
        <th>Heirs</th>
        <th>Amount</th>
    </tr>
    @if($mother_share > 0)
    <tr>
        <td>Mother</td>
        <td>{{ number_format($mother_share, 2) }}</td>
    </tr>
    @endif
    @if($father_share > 0)
    <tr>
        <td>Father</td>
        <td>{{ number_format($father_share, 2) }}</td>
    </tr>
    @endif
    @if($bro_share > 0)
    <tr>
        <td>Brother</td>
        <td>{{ number_format($bro_share, 2) }}</td>
    </tr>
    @endif
    @if($spo_share > 0)
    <tr>
        <td>Sister</td>
        <td>{{ number_format($sis_share, 2) }}</td>
    </tr>
    @endif
    @if($spo_share > 0)
    <tr>
        <td>Wives</td>
        <td>{{ number_format($spo_share, 2) }}</td>
    </tr>
    @endif
</table>
</div>
</body>
</html>
