<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f8fafc;
        }


        /* CARD */

        .card {

            width: 430px;
            height: 250px;

            margin: 35px auto;

            border-radius: 28px;

            padding: 25px;

            box-sizing: border-box;

            position: relative;

            overflow: hidden;

        }



        /* FRONT NFC CARD */

        .front {

            color: white;

            background: #2563eb;

        }



        /* Purple glow */

        .circle1 {

            position: absolute;

            width: 260px;
            height: 260px;

            right: -120px;
            top: -120px;

            background: #7c3aed;

            border-radius: 50%;

            opacity: .65;

        }



        /* Dark glow */

        .circle2 {

            position: absolute;

            width: 180px;
            height: 180px;

            left: -80px;
            bottom: -80px;

            background: #0f172a;

            border-radius: 50%;

            opacity: .55;

        }



        /* LOGO */

        .logo {

            width: 75px;

            height: 75px;

            border-radius: 50%;

            object-fit: cover;

            border: 3px solid rgba(255, 255, 255, .8);

        }



        /* HEADER */

        .header {

            display: flex;

            align-items: center;

        }



        .header-info {

            margin-left: 18px;

        }


        .name {

            font-size: 25px;

            font-weight: bold;

            line-height: 30px;

        }



        .title {

            margin-top: 5px;

            color: #dbeafe;

            font-size: 14px;

        }




        /* DETAILS */

        .info {

            margin-top: 22px;

            font-size: 13px;

            line-height: 23px;

        }



        /* NFC ICON */

        .nfc {

            position: absolute;

            right: 25px;

            bottom: 20px;

            font-size: 45px;

            color: #dbeafe;

            opacity: .9;

        }



        /* BACK */

        .back {

            background: white;

            border: 1px solid #e2e8f0;

            text-align: center;

        }



        .back-title {

            font-size: 24px;

            font-weight: bold;

            color: #0f172a;

        }



        .qr {

            width: 110px;

            height: 110px;

            margin-top: 15px;

        }



        .website {

            margin-top: 12px;

            font-size: 13px;

            color: #334155;

        }



        .location {

            margin-top: 8px;

            font-size: 12px;

            color: #64748b;

        }



        .scan {

            margin-top: 12px;

            font-size: 11px;

            color: #94a3b8;

        }



        /* SMALL FOOTER */

        .brand {

            position: absolute;

            bottom: 18px;

            left: 25px;

            font-size: 10px;

            color: rgba(255, 255, 255, .7);

        }
    </style>

</head>


<body>



    {{-- FRONT SIDE --}}

    <div class="card front">


        <div class="circle1"></div>

        <div class="circle2"></div>



        <div class="header">


            @if ($shop->logo)
                <img src="{{ public_path('storage/' . $shop->logo) }}" class="logo">
            @else
                <div class="logo" style="background:#ffffff33;text-align:center;padding-top:22px;">
                    {{ strtoupper(substr($shop->name, 0, 1)) }}
                </div>
            @endif



            <div class="header-info">


                <div class="name">

                    {{ $shop->name }}

                </div>



                <div class="title">

                    {{ $shop->businessCard->title ?? 'Business' }}

                </div>



            </div>


        </div>




        <div class="info">


            @if ($shop->businessCard->phone)
                📱 {{ $shop->businessCard->phone }}

                <br>
            @endif



            @if ($shop->businessCard->email)
                ✉ {{ $shop->businessCard->email }}

                <br>
            @endif



            @if ($shop->businessCard->website)
                🌐 {{ $shop->businessCard->website }}
            @endif


        </div>



        <div class="nfc">

            ◔

        </div>


    </div>





    {{-- BACK SIDE --}}


    <div class="card back">



        @if (isset($qrCode))
            <img src="data:image/png;base64,{{ $qrCode }}" class="qr">
        @endif




        <div class="website">

            {{ $shop->businessCard->website ?? '' }}

        </div>




        <div class="location">


            @if ($shop->city)
                {{ $shop->city->name }}
            @endif


            @if ($shop->country)
                , {{ $shop->country->name }}
            @endif


        </div>




        <div class="scan">

            Scan QR to connect instantly

        </div>



    </div>



</body>

</html>
