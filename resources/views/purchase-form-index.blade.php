<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Records</title>
</head>
<body>
    <h1>Purchase Records</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Category</th>
                <th>Item Code</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>VAT Code</th>
                <th>Discount</th>
                <th>Discount Type</th>
                <th>Basic Amount</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->category }}</td>
                <td>{{ $purchase->item_code }}</td>
                <td>{{ $purchase->description }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ $purchase->price }}</td>
                <td>{{ $purchase->vat_code }}</td>
                <td>{{ $purchase->discount }}</td>
                <td>{{ $purchase->discount_type }}</td>
                <td>{{ $purchase->basic_amount }}</td>
                <td>{{ $purchase->total_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
