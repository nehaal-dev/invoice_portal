<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }}</title>

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
            background: #1e3a5f;
            padding: 30px;
        }

        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            color: #cbd5e1;
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

        .invoice-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }

        .invoice-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-box td {
            padding: 8px 0;
            font-size: 14px;
        }

        .invoice-box td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .total-row td {
            border-top: 1px solid #d1d5db;
            padding-top: 15px;
            font-size: 16px;
            color: #1e3a5f;
            font-weight: bold;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .status-unpaid {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-overdue {
            background: #fef3c7;
            color: #92400e;
        }

        .status-draft {
            background: #e5e7eb;
            color: #374151;
        }

        .cta-btn {
            display: inline-block;
            background: #1e3a5f;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 20px;
        }

        .divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 25px 0;
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
            <h1>{{ config('app.name') }}</h1>
            <p>Invoice Notification</p>
        </div>

        <div class="body">

            <p class="greeting">
                Hello <strong>{{ $invoice->client->client_name }}</strong>,
            </p>

            <p class="content">
                Your invoice
                <strong>{{ $invoice->invoice_number }}</strong>
                has been generated successfully.
                Please review the details below.
            </p>

            <div class="invoice-box">
                <table>

                    <tr>
                        <td style="color:#6b7280;">Invoice Number</td>
                        <td>{{ $invoice->invoice_number }}</td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Invoice Date</td>
                        <td>
                            {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Due Date</td>
                        <td>
                            {{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Status</td>
                        <td>
                            <span class="status-badge status-{{ $invoice->status }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </td>
                    </tr>

                    <tr class="total-row">
                        <td>Total Amount</td>
                        <td>₹{{ number_format($invoice->total, 2) }}</td>
                    </tr>

                </table>
            </div>

            @if ($invoice->notes)
                <p class="content">
                    <strong>Notes:</strong>
                    {{ $invoice->notes }}
                </p>
            @endif

            <p class="content">
                Please find your invoice PDF attached with this email.
            </p>

            @if ($invoice->status !== 'paid')
                <a href="{{ route('invoices.checkout', $invoice->id) }}" class="cta-btn">
                    Pay Now
                </a>
            @endif

            <p class="content" style="margin-top: 15px;">
                <strong>Portal Access:</strong><br>
                Login to view all your invoices:<br>
                Email: {{ $invoice->client->email }}<br>
                Password: client123
                <br>
                <a href="{{ config('app.url') }}/login" class="cta-btn" style="margin-top:10px;">
                    View Portal
                </a>
            </p>

            <hr class="divider">

            <p class="content">
                If you have any questions regarding this invoice,
                please contact us.
            </p>

        </div>

        <div class="footer">
            <p>
                © {{ date('Y') }} {{ config('app.name') }}.
                All rights reserved.
            </p>

            <p style="margin-top:8px;">
                This email was sent to
                <strong>{{ $invoice->client->email }}</strong>
            </p>
        </div>

    </div>

</body>

</html>
