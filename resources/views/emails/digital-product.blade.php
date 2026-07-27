<!DOCTYPE html>
<html>

<body style="font-family:Arial;background:#f5f5f5;padding:40px;">

    <div style="max-width:650px;margin:auto;background:white;border-radius:12px;padding:30px;">

        <h1>
            Thank you for your purchase 🎉
        </h1>

        <p>
            Your digital product is ready.
        </p>

        <img src="{{ asset('storage/' . $download->product->image) }}" style="width:100%;border-radius:10px;">

        <h2>
            {{ $download->product->title }}
        </h2>

        <p>
            {{ $download->product->description }}
        </p>

        <a href="{{ route('downloads.download', $download->token) }}"
            style="
            display:inline-block;
            padding:15px 30px;
            background:#f97316;
            color:white;
            text-decoration:none;
            border-radius:8px;
            margin-top:20px;
        ">
            Download Product
        </a>

        <p style="margin-top:40px;color:#666;line-height:1.7;">
            Thank you for using murwaj.com. We appreciate your support and hope you enjoy your purchase.
        </p>

    </div>

</body>

</html>
