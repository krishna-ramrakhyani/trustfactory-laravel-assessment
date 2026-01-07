<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daily Sales Report</title>
</head>
<body>
<h2>Daily Sales Report</h2>

@if($items->isEmpty())
    <p>No products were sold today.</p>
@else
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
        <tr>
            <th>Product</th>
            <th>Quantity Sold</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->product->price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

<p>
    Generated on {{ now()->toDayDateTimeString() }}
</p>
</body>
</html>
