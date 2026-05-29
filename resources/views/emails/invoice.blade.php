<!DOCTYPE html>
<html>
<head>
    <title>Invoice Email</title>
</head>
<body>

    <h2>Hello {{ $invoice->client->client_name }}</h2>

    <p>
        Your invoice
        <strong>{{ $invoice->invoice_number }}</strong>
        has been generated.
    </p>

    <p>
        Total Amount:
        ₹{{ number_format($invoice->total, 2) }}
    </p>

    <p>
        Due Date:
        {{ $invoice->due_date }}
    </p>

    <p>
        Please find the attached invoice PDF.
    </p>

    <br>

    <p>Thank you,</p>

    <p>{{ config('app.name') }}</p>

</body>
</html>