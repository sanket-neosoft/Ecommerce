<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="padding:20px">
    <div class="container">
        <table style="text-align: center; vertical-align: middle;" cellpadding="25">
            <tr>
                <td>
                    <img src="" alt="">
                </td>
                <td colspan="4">
                    <h1>Order {{ $order_detail->status }}</h1>
                </td>
            </tr>
        </table>
        <hr>
        <div style="margin: 25px;">
            <p>Thank You so much for your order! &#128512;</p>
            <h3>Invoice</h3>
        </div>
        <table border cellpadding="10">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Order Summary</th>
                    <th>Billing Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p style="font-size: 24px; font-weight: bold; margin: 10px">
                            {{ $order_detail->product->name }}
                        </p>
                        <p style="margin: 10px;">
                            ({{ $order_detail->product->brand }})
                        </p>
                        <img src="{{ asset($order_detail->product->thumbnail) }}" alt="" style="height: 100px; width: 100px; object-fit:cover; object-position:center;">
                    </td>
                    <td>
                        <p style="margin: 10px;">
                            Tracking Id:{{ $order_detail->tracking_id }}
                        </p>
                        <p style="margin: 10px;">
                            Price: &#8377; {{ $order_detail->product->price }}
                        </p>
                        <p style="margin: 10px;">
                            Quantity: {{ $order_detail->quantity }}
                        </p>
                        <p style="margin: 10px;">
                            Payment Method: {{ $order_detail->user_order->payment_method }}
                        </p>
                        <p style="margin: 10px;">
                            Status: {{ $order_detail->status }}
                        </p>
                    </td>
                    <td>
                        <p style="margin: 10px;">
                            Name: {{ $order_detail->user_order->user_name }}
                        </p>
                        <p style="margin: 10px; width: 200px">
                            Address: {{ $order_detail->user_order->user_address }}
                        </p>
                        <p style="margin: 10px;">
                            Contact: {{ $order_detail->user_order->user_contact }}
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>