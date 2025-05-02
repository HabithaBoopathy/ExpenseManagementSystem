<!DOCTYPE html>
<html>
<head>
    <title>Budget Exceeded</title>
</head>
<body>
    <h2>Hi {{ $user->name }},</h2>
    <p>You have exceeded your monthly budget!</p>
    <p><strong>Total Expenses:</strong> ${{ number_format($totalExpenses, 2) }}</p>
    <p>Please review your spending.</p>
</body>
</html>
