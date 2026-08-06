<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Invitation</title>
</head>

<body style="
    margin:0;
    padding:0;
    background:#f3f4f6;
    font-family:Arial, Helvetica, sans-serif;
">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">


                <table width="600" cellpadding="0" cellspacing="0"
                    style="
                    background:#ffffff;
                    border-radius:18px;
                    overflow:hidden;
                    box-shadow:0 10px 30px rgba(0,0,0,.08);
                ">


                    <!-- Header -->

                    <tr>
                        <td
                            style="
                        background:linear-gradient(135deg,#f97316,#ea580c);
                        padding:35px;
                        text-align:center;
                    ">

                            <h1
                                style="
                            color:#ffffff;
                            margin:0;
                            font-size:32px;
                        ">
                                Welcome to Our Marketplace
                            </h1>

                            <p
                                style="
                            color:#ffedd5;
                            font-size:16px;
                            margin-top:10px;
                        ">
                                Supplier Partner Invitation
                            </p>

                        </td>
                    </tr>




                    <!-- Content -->

                    <tr>
                        <td
                            style="
                        padding:40px;
                        color:#374151;
                    ">


                            <h2
                                style="
                            margin-top:0;
                            color:#111827;
                            font-size:24px;
                        ">
                                Hello {{ $supplier->name }},
                            </h2>



                            <p
                                style="
                            font-size:16px;
                            line-height:1.7;
                        ">
                                You have been invited to become an official supplier on our marketplace.
                            </p>



                            <p
                                style="
                            font-size:16px;
                            line-height:1.7;
                        ">
                                As a supplier partner you can:
                            </p>



                            <ul
                                style="
                            padding-left:20px;
                            line-height:1.8;
                            color:#4b5563;
                        ">

                                <li>Manage your supplier dashboard</li>

                                <li>Receive POD fulfillment orders</li>

                                <li>Track products and earnings</li>

                                <li>Update your supplier information</li>

                            </ul>




                            <div
                                style="
                            text-align:center;
                            margin:35px 0;
                        ">


                                <a href="{{ $url }}"
                                    style="
                                    display:inline-block;
                                    background:#f97316;
                                    color:#ffffff;
                                    padding:16px 35px;
                                    border-radius:12px;
                                    text-decoration:none;
                                    font-size:16px;
                                    font-weight:bold;
                                ">

                                    Activate Supplier Account

                                </a>


                            </div>




                            <p
                                style="
                            font-size:14px;
                            color:#6b7280;
                            line-height:1.6;
                        ">

                                This invitation link is unique to your account.
                                Please activate your supplier account before the link expires.

                            </p>




                            <p
                                style="
                            font-size:14px;
                            color:#9ca3af;
                            margin-top:25px;
                        ">

                                If the button does not work, copy and paste this link:

                            </p>


                            <p
                                style="
                            word-break:break-all;
                            font-size:13px;
                            color:#f97316;
                        ">
                                {{ $url }}
                            </p>


                        </td>
                    </tr>





                    <!-- Footer -->


                    <tr>
                        <td
                            style="
                        background:#111827;
                        padding:25px;
                        text-align:center;
                    ">


                            <p
                                style="
                            color:#d1d5db;
                            margin:0;
                            font-size:14px;
                        ">
                                © {{ date('Y') }} {{ config('app.name') }} Marketplace. All rights reserved.
                            </p>


                            <p
                                style="
                            color:#9ca3af;
                            font-size:12px;
                            margin-top:10px;
                        ">
                                Supplier Partner Network
                            </p>


                        </td>
                    </tr>



                </table>


            </td>
        </tr>
    </table>


</body>

</html>
