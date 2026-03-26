<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order Invoice</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 10px 0 0;
            font-size: 16px;
            color: #c7d2fe;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #111827;
        }
        .text {
            line-height: 1.6;
            margin-bottom: 30px;
            color: #4b5563;
        }
        .details-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 30px;
        }
        .details-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            margin-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 12px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 15px;
        }
        .detail-row:last-child {
            margin-bottom: 0;
        }
        .detail-label {
            color: #6b7280;
            font-weight: 500;
        }
        .detail-value {
            font-weight: 600;
            color: #111827;
            text-align: right;
        }
        .product-link-box {
            text-align: center;
            margin: 40px 0;
        }
        .product-link-btn {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            padding: 16px 32px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #f3f4f6;
            color: #6b7280;
            font-size: 14px;
        }
        .footer-logo {
            font-weight: 800;
            color: #4f46e5;
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Payment Successful!</h1>
            <p>Thank you for shopping at Wasemoo Shop</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                Hello {{ $order->first_name }} {{ $order->last_name }},
            </div>
            
            <div class="text">
                Your payment was successfully processed. We've compiled your order invoice and digital access details below. Since you purchased a digital Cyber Security product, you can access your content immediately.
            </div>
            
            <div class="details-box">
                <div class="details-title">Order Information</div>
                
                <div class="detail-row">
                    <div class="detail-label">Name: </div>
                    <div class="detail-value">{{ $order->first_name }} {{ $order->last_name }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Email: </div>
                    <div class="detail-value">{{ $order->email }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Phone: </div>
                    <div class="detail-value">{{ $order->phone }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Reference No.: </div>
                    <div class="detail-value" style="font-family: monospace; color: #4f46e5;">{{ $order->reference_number }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Order Time: </div>
                    <div class="detail-value">{{ $order->created_at->format('M d, Y - h:i A') }}</div>
                </div>
                
                <div class="detail-row" style="margin-top: 16px; padding-top: 16px; border-top: 1px dashed #e2e8f0;">
                    <div class="detail-label">Total Amount: </div>
                    <div class="detail-value" style="font-size: 18px; color: #4338ca;">${{ number_format($order->amount, 2) }}</div>
                </div>
            </div>

            @if($order->product && $order->product->product_link)
            <div class="product-link-box">
                <div style="margin-bottom: 16px; font-weight: 600; color: #111827;">Your digital product is ready:</div>
                <a href="{{ $order->product->product_link }}" class="product-link-btn">
                    Access Your Product
                </a>
                <div style="margin-top: 16px; font-size: 13px; color: #6b7280;">
                    Or copy the link directly:<br>
                    <a href="{{ $order->product->product_link }}" style="color: #4f46e5; word-break: break-all;">{{ $order->product->product_link }}</a>
                </div>
            </div>
            @endif
        </div>
        
        <div class="footer">
            <div class="footer-logo">Wasemoo Shop</div>
            <div>Secure Cyber Security Preparations</div>
            <div style="margin-top: 16px; font-size: 12px; color: #9ca3af;">
                If you have any questions, please contact our support team.
            </div>
        </div>
    </div>
</body>
</html>
