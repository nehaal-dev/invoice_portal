<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
            padding: 20px;
        }

        .wrapper {
            max-width: 620px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: #16a34a;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            color: #dcfce7;
            font-size: 14px;
        }

        .body {
            padding: 30px;
        }

        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .content {
            font-size: 14px;
            line-height: 1.7;
            color: #4b5563;
            margin-bottom: 20px;
        }

        .success-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }

        .success-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .success-box td {
            padding: 8px 0;
            font-size: 14px;
        }

        .success-box td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .status-paid {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            background: #d1fae5;
            color: #065f46;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .amount-row td {
            border-top: 1px solid #bbf7d0;
            padding-top: 15px;
            font-size: 16px;
            color: #16a34a;
            font-weight: bold;
        }

        .footer {
            background: #f8fafc;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <div class="header">
            <h1>Payment Received</h1>
            <p>{{ config('app.name') }}</p>
        </div>

        <div class="body">

            <p class="greeting">
                Hello <strong>{{ $invoice->client->client_name }}</strong>,
            </p>

            <p class="content">
                Thank you. We have successfully received your payment for the following invoice.
            </p>

            <div class="success-box">

                <table>

                    <tr>
                        <td style="color:#6b7280;">Invoice Number</td>
                        <td>{{ $invoice->invoice_number }}</td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Payment Status</td>
                        <td>
                            <span class="status-paid">
                                Paid
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Payment Method</td>
                        <td>
                            {{ ucfirst($invoice->payment->payment_method) }}
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Transaction ID</td>
                        <td style="word-break: break-all;">
                            {{ $invoice->payment->transaction_id }}
                        </td>
                    </tr>


                    <tr>
                        <td style="color:#6b7280;">Payment Date</td>
                        <td>
                            {{-- {{ $invoice->payment->payment_date }} --}}
                            {{ \Carbon\Carbon::parse($invoice->payment->payment_date)->format('d M Y') }}
                        </td>
                    </tr>

                    <tr class="amount-row">
                        <td>Amount Paid</td>
                        <td>₹{{ number_format($invoice->total, 2) }}</td>
                    </tr>

                </table>

            </div>

            <p class="content">
                Your payment has been processed successfully and the invoice is now marked as paid.
            </p>

            <p class="content">
                Thank you for your business. We appreciate your trust in us.
            </p>

        </div>

        <div class="footer">
            <p>
                © {{ date('Y') }} {{ config('app.name') }}
            </p>

            <p style="margin-top:8px;">
                Payment confirmation sent to
                <strong>{{ $invoice->client->email }}</strong>
            </p>
        </div>

    </div>

</body>

</html>
