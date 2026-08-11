<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Your murwaj Subscription</title>
</head>


<body style="font-family:Arial,Helvetica,sans-serif;background:#f5f5f5;padding:40px;margin:0;">


    <div style="max-width:650px;margin:auto;background:white;border-radius:12px;padding:30px;">


        <h1 style="margin-top:0;">
            Thank you for subscribing 🎉
        </h1>


        <p style="font-size:16px;line-height:1.7;color:#444;">
            Hello {{ $user->name ?? 'there' }},
        </p>


        <p style="font-size:16px;line-height:1.7;color:#444;">
            Your murwaj seller subscription is now active.
            Here are the details of your current subscription:
        </p>


        {{-- Current Plan --}}

        <div
            style="
            margin-top:25px;
            padding:25px;
            background:#fff7ed;
            border:1px solid #fed7aa;
            border-radius:10px;
        ">

            <p
                style="
                margin:0;
                color:#9a3412;
                font-size:12px;
                font-weight:bold;
                text-transform:uppercase;
                letter-spacing:1px;
            ">
                Current Subscription
            </p>


            <h2
                style="
                margin:10px 0 5px;
                color:#171411;
                font-size:26px;
            ">
                {{ $plan->name }}
            </h2>


            <p
                style="
                margin:0;
                color:#f97316;
                font-size:22px;
                font-weight:bold;
            ">
                ${{ number_format((float) $plan->price, 2) }}

                <span
                    style="
                    color:#777;
                    font-size:14px;
                    font-weight:normal;
                ">
                    /{{ ucfirst($plan->billing_period) }}
                </span>
            </p>

        </div>


        {{-- Plan Features --}}

        <h3 style="
            margin-top:30px;
            margin-bottom:15px;
        ">
            Your plan includes
        </h3>


        <div style="
            color:#444;
            font-size:15px;
            line-height:2;
        ">

            <div>
                ✓ {{ $plan->listing_limit }} Active Products
            </div>

            <div>
                ✓ {{ $plan->storage_limit }} MB Storage
            </div>

            <div>
                ✓ Listings live for {{ $plan->listing_duration }} days
            </div>

            <div>
                ✓ Featured Listings:
                {{ $plan->featured_limit ?? 'Unlimited' }}
            </div>


            @if ($plan->video_upload)
                <div>
                    ✓ Video Uploads Included
                </div>
            @else
                <div style="color:#999;">
                    × No Video Uploads
                </div>
            @endif

        </div>


        {{-- Cancellation --}}

        <div
            style="
            margin-top:35px;
            padding:25px;
            background:#fafafa;
            border:1px solid #e5e5e5;
            border-radius:10px;
        ">

            <h3 style="
                margin-top:0;
                margin-bottom:10px;
            ">
                Want to cancel your subscription?
            </h3>


            <p
                style="
                color:#666;
                font-size:14px;
                line-height:1.7;
                margin-bottom:20px;
            ">
                You can cancel your subscription at any time.
                If you cancel, your current plan will remain active
                until the end of your current billing period.
            </p>


            <a href="{{ $cancelUrl }}"
                style="
                    display:inline-block;
                    padding:15px 30px;
                    background:#dc2626;
                    color:white;
                    text-decoration:none;
                    border-radius:8px;
                    margin-top:5px;
                    font-weight:bold;
                ">
                Cancel Subscription
            </a>

        </div>


        {{-- Footer --}}

        <p
            style="
            margin-top:40px;
            color:#666;
            line-height:1.7;
            font-size:14px;
        ">
            Thank you for using murwaj.com.
            We appreciate your support and hope your business continues to grow.
        </p>


        <p style="
            color:#999;
            font-size:12px;
            line-height:1.6;
        ">
            If you did not make this subscription, please contact Murwaj support.
        </p>


    </div>


</body>

</html>

<a href="{{ $cancelUrl }}">
    Cancel Subscription
</a>
