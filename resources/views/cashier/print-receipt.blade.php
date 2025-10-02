<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - {{ $order->order_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Courier New', monospace;
            width: 80mm;
            margin: 0 auto;
            padding: 10mm;
            font-size: 12px;
        }
        
        .receipt {
            width: 100%;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px dashed #000;
        }
        
        .header h1 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 10px;
        }
        
        .info {
            margin-bottom: 15px;
            font-size: 11px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        
        .items {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #000;
        }
        
        .item {
            margin-bottom: 8px;
        }
        
        .item-name {
            font-weight: bold;
            margin-bottom: 2px;
        }
        
        .item-detail {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
        }
        
        .totals {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px dashed #000;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 11px;
        }
        
        .total-row.grand {
            font-size: 14px;
            font-weight: bold;
            padding-top: 5px;
            border-top: 1px solid #000;
        }
        
        .payment {
            margin-bottom: 15px;
            padding: 8px;
            background: #f5f5f5;
            border: 1px solid #ddd;
        }
        
        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 11px;
        }
        
        .payment-row.change {
            font-size: 13px;
            font-weight: bold;
            padding-top: 5px;
            border-top: 1px solid #999;
        }
        
        .footer {
            text-align: center;
            padding-top: 10px;
            border-top: 2px dashed #000;
        }
        
        .footer p {
            font-size: 10px;
            margin-bottom: 3px;
        }
        
        @media print {
            body {
                padding: 0;
            }
            
            @page {
                margin: 0;
                size: 80mm auto;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt">
        <div class="header">
            <h1>LAIDBACK CAFE</h1>
            <p>Thank you for your order!</p>
        </div>

        <div class="info">
            <div class="info-row">
                <span>Order #:</span>
                <strong>{{ $order->order_number }}</strong>
            </div>
            <div class="info-row">
                <span>Date:</span>
                <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span>Customer:</span>
                <span>{{ $order->customer_name }}</span>
            </div>
            @if($order->table_number)
            <div class="info-row">
                <span>Table:</span>
                <span>{{ $order->table_number }}</span>
            </div>
            @endif
            <div class="info-row">
                <span>Cashier:</span>
                <span>{{ $order->cashier->name }}</span>
            </div>
        </div>

        <div class="items">
            @foreach($order->items as $item)
            <div class="item">
                <div class="item-name">{{ $item->product_name }}</div>
                <div class="item-detail">
                    <span>{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                </div>
            </div>
            @endforeach
        </div>

        <div class="totals">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <span>Tax (10%):</span>
                <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
            </div>
            <div class="total-row grand">
                <span>TOTAL:</span>
                <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="payment">
            <div class="payment-row">
                <span>Payment Method:</span>
                <strong>{{ ucfirst($order->payment_method) }}</strong>
            </div>
            <div class="payment-row">
                <span>Amount Paid:</span>
                <span>Rp {{ number_format($order->amount_paid, 0, ',', '.') }}</span>
            </div>
            <div class="payment-row change">
                <span>CHANGE:</span>
                <span>Rp {{ number_format($order->change_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <p>Visit us again soon!</p>
            <p>www.laidbackcafe.com</p>
            <p style="margin-top: 10px;">{{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>