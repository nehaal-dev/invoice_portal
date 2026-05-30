<!DOCTYPE html>
<html>

<head>
    <title>Invoice Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #2c3e50;
            margin: 0;
            font-size: 22px;
        }

        .header p {
            margin: 3px 0;
            color: #555;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #2c3e50;
            color: white;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 7px 8px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .summary td {
            padding: 5px 8px;
        }

        .total-row td {
            font-weight: bold;
            background-color: #eaf3de;
            font-size: 14px;
        }

        .notes {
            margin-top: 15px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h2>{{ config('app.name') }}</h2>
        <p>Invoice # {{ $invoice->invoice_number }}</p>
        <p>Date: {{ $invoice->invoice_date }}</p>
    </div>

    <!-- Bill To + Due Date -->
    <table class="info-table">
        <tr>
            <td><strong>Bill To:</strong><br>
                {{ $clint->client_name }}<br>
                {{ $clint->email }}<br>
                {{ $clint->city }}, {{ $clint->country }}
            </td>
            <td style="text-align:right; padding-right:15px;">

                <div style="margin-bottom:8px;">
                    <strong>Due Date:</strong>
                    {{ $invoice->due_date }}
                </div>
            
                <div>
                    <strong>Status:</strong>
            
                    <span style="color:#dc2626; padding-right:25px;">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </div>
            
            </td>
            {{-- <td style="text-align: right;">
                <strong>Status:</strong> {{ $invoice->status }}
            </td> --}}
        </tr>
    </table>

    <!-- Items Table -->
    <table>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach

        <!-- Summary -->
        <tr class="summary">
            <td colspan="3" style="text-align: right;"><strong>Subtotal:</strong></td>
            <td>{{ $invoice->subtotal }}</td>
        </tr>
        <tr class="summary">
            <td colspan="3" style="text-align: right;"><strong>Tax ({{ $invoice->tax }}%):</strong></td>
            <td>{{ number_format(($invoice->subtotal * $invoice->tax) / 100, 2) }}</td>
        </tr>
        <tr class="summary">
            <td colspan="3" style="text-align: right;"><strong>Discount (₹):</strong></td>
            <td>{{ $invoice->discount }}</td>
        </tr>
        <tr class="total-row">
            <td colspan="3" style="text-align: right;">Total:</td>
            <td>{{ $invoice->total }}</td>
        </tr>

        {{-- @if ($invoice->payment)
            <tr>
                <td colspan="4" style="padding-top:20px;">
                    <hr>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <strong>Payment Status:</strong>
                </td>

                <td colspan="2" style="color: green;">
                    Paid
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <strong>Payment Method:</strong>
                </td>

                <td colspan="2">
                    {{ ucfirst($invoice->payment->payment_method) }}
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <strong>Transaction ID:</strong>
                </td>

                <td colspan="2">
                    {{ $invoice->payment->transaction_id }}
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <strong>Payment Date:</strong>
                </td>

                <td colspan="2">
                    {{ $invoice->payment->payment_date }}
                </td>
            </tr>
        @endif --}}
    </table>

    <!-- Notes -->
    @if ($invoice->notes)
        <p class="notes"><strong>Notes:</strong> {{ $invoice->notes }}</p>
    @endif

</body>

</html>
