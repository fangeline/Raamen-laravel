<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Report</title>
    <style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        min-width: 110px;
        text-align: center;
    }
    th {
        border: 1px solid black;
        border-collapse: collapse;
        min-width: 110px;
        text-align: center;
        background-color: rgb(172, 197, 252);
    }
    </style>
</head>
<body>
    <h1>Report #{{ $header_id }}</h1>
    <table>
        <thead>
            <tr>
                <th scope="col" style="text-align: center">Header ID</th>
                <th scope="col" style="text-align: center">Ramen Name</th>
                <th scope="col" style="text-align: center">Quantity</th>
                <th scope="col" style="text-align: center">Price</th>
                <th scope="col" style="text-align: center">Sub Total</th>
                <th scope="col" style="text-align: center">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="text-center">
                    <td>{{ $item['header_id'] }}</td>
                    <td>{{ $item->ramen->name }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item->ramen->price }}</td>
                    <td>{{ $item->ramen->price*$item['quantity'] }}</td>
                    <td>{{ $item['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2>Total: {{ $total }}</h2>
    
</body>
</html>