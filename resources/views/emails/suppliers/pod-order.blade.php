<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New POD Fulfillment Order</title>
</head>

<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#f97316,#ea580c);padding:35px;text-align:center;">

                            <h1 style="margin:0;color:#fff;font-size:30px;">
                                🖨️ New POD Fulfillment Order
                            </h1>

                            <p style="margin-top:10px;color:#ffedd5;font-size:16px;">
                                A customer has placed a new Print-on-Demand order.
                            </p>

                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:40px;">

                            <h2 style="margin-top:0;color:#111827;">
                                Hello {{ $product->supplier->company ?? $product->supplier->name }},
                            </h2>

                            <p style="font-size:16px;color:#4b5563;line-height:1.7;">
                                A new order has been assigned to your fulfillment account.
                                Please begin production and ship the order once it is ready.
                            </p>

                            <!-- Order Info -->
                            <table width="100%" cellpadding="12" cellspacing="0"
                                style="margin:30px 0;border:1px solid #e5e7eb;border-radius:12px;">

                                <tr style="background:#f9fafb;">
                                    <td width="40%"><strong>Order Number</strong></td>
                                    <td>{{ $order->order_number }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Order Date</strong></td>
                                    <td>{{ $order->created_at->format('F d, Y H:i') }}</td>
                                </tr>

                                <tr style="background:#f9fafb;">
                                    <td><strong>Status</strong></td>
                                    <td>{{ ucfirst($order->status) }}</td>
                                </tr>

                            </table>

                            <h3 style="margin-bottom:15px;color:#111827;">
                                Customer Information
                            </h3>

                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="border:1px solid #e5e7eb;border-radius:12px;margin-bottom:30px;">

                                <tr>
                                    <td width="40%"><strong>Name</strong></td>
                                    <td>{{ $order->customer->name }}</td>
                                </tr>

                                <tr style="background:#f9fafb;">
                                    <td><strong>Email</strong></td>
                                    <td>{{ $order->customer->email }}</td>
                                </tr>

                            </table>

                            <h3 style="margin-bottom:15px;color:#111827;">
                                Product Details
                            </h3>

                            <table width="100%" cellpadding="12" cellspacing="0"
                                style="border:1px solid #e5e7eb;border-radius:12px;">

                                <tr style="background:#f9fafb;">
                                    <td width="40%"><strong>Product</strong></td>
                                    <td>{{ $product->title }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Base Product</strong></td>
                                    <td>{{ $product->base_product }}</td>
                                </tr>

                                <tr style="background:#f9fafb;">
                                    <td><strong>Quantity</strong></td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Supplier Cost</strong></td>
                                    <td>
                                        AED {{ number_format($product->base_cost, 2) }}
                                    </td>
                                </tr>

                                <tr style="background:#f9fafb;">
                                    <td><strong>Total Supplier Payout</strong></td>
                                    <td>
                                        <strong style="color:#16a34a;">
                                            AED {{ number_format($product->base_cost * $item->quantity, 2) }}
                                        </strong>
                                    </td>
                                </tr>

                            </table>

                            <div style="margin:40px 0;text-align:center;">

                                <a href="{{ route('supplier.orders.index') }}"
                                    style="display:inline-block;background:#f97316;color:#fff;text-decoration:none;padding:16px 35px;border-radius:12px;font-weight:bold;">
                                    View Fulfillment Order
                                </a>

                            </div>

                            <div
                                style="background:#fff7ed;border-left:4px solid #f97316;padding:18px;border-radius:8px;">

                                <strong style="color:#9a3412;">
                                    Next Steps
                                </strong>

                                <ul style="margin:10px 0 0;padding-left:20px;color:#7c2d12;line-height:1.8;">
                                    <li>Review the order details.</li>
                                    <li>Begin production.</li>
                                    <li>Ship the completed order.</li>
                                    <li>Update the fulfillment status in your dashboard.</li>
                                </ul>

                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#111827;padding:30px;text-align:center;">

                            <p style="margin:0;color:#d1d5db;font-size:14px;">
                                © {{ date('Y') }} {{ config('app.name') }}
                            </p>

                            <p style="margin-top:8px;color:#9ca3af;font-size:12px;">
                                Print-on-Demand Supplier Network
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
