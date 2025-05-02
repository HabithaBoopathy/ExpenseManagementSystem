<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Expense Report</title>
</head>
<body>
    <h1>Monthly Expense Report for {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $year }}</h1>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Category</th>
                <th>Total Expenses</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categoryData as $category => $total)
                <tr>
                    <td>{{ $category }}</td>
                    <td>₹{{ number_format($total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3><strong>Grand Total: ${{ number_format($grandTotal, 2) }}</strong></h3>
</body>
</html>
