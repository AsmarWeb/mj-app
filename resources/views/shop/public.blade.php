<x-guest-layout>

    <div class="min-h-screen bg-slate-100 flex items-center justify-center p-6">

        <div class="w-full max-w-5xl">


            {{-- Download Button --}}

            <div class="text-center mb-10">

                <a href="{{ route('shop.business-card', $shop->slug) }}"
                    class="inline-flex items-center gap-2 bg-blue-700 text-white px-7 py-3 rounded-2xl shadow-lg hover:bg-blue-800 transition">

                    ⬇ Download Card

                </a>

            </div>



            {{-- CARD --}}

            <div class="flex justify-center">


                <div class="scene">


                    <div class="card" onclick="this.classList.toggle('flip')">



                        {{-- FRONT --}}

                        <div class="side front">


                            <div class="circle one"></div>
                            <div class="circle two"></div>



                            <div class="header">


                                @if ($shop->logo)
                                    <img src="{{ asset('storage/' . $shop->logo) }}" class="logo">
                                @else
                                    <div class="logo flex items-center justify-center text-3xl font-bold">
                                        {{ strtoupper(substr($shop->name, 0, 1)) }}
                                    </div>
                                @endif



                                <div>

                                    <h1>
                                        {{ $shop->name }}
                                    </h1>


                                    <p>
                                        {{ $shop->businessCard->title ?? 'Business' }}
                                    </p>


                                </div>


                            </div>




                            <div class="info">


                                @if ($shop->businessCard->phone)
                                    <div>
                                        📱 {{ $shop->businessCard->phone }}
                                    </div>
                                @endif



                                @if ($shop->businessCard->email)
                                    <div>
                                        ✉ {{ $shop->businessCard->email }}
                                    </div>
                                @endif



                                @if ($shop->businessCard->website)
                                    <div>
                                        🌐 {{ $shop->businessCard->website }}
                                    </div>
                                @endif


                            </div>



                            <div class="nfc">
                                ◔
                            </div>



                            <div class="tap">
                                Tap card
                            </div>


                        </div>





                        {{-- BACK --}}


                        <div class="side back">


                            <h2>
                                Tap or Scan
                            </h2>



                            @if ($qrCode)
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

                                Digital NFC Business Card

                            </div>


                        </div>


                    </div>


                </div>


            </div>



            {{-- Details --}}


            <div class="mt-12 bg-white rounded-3xl shadow p-8">


                <h2 class="text-2xl font-bold mb-4">
                    {{ $shop->name }}
                </h2>


                @if ($shop->description)
                    <p class="text-gray-600 leading-7">
                        {{ $shop->description }}
                    </p>
                @endif


            </div>



        </div>

    </div>




    <style>
        .scene {

            perspective: 1200px;

        }



        .card {

            width: 430px;
            height: 250px;
            position: relative;

            transform-style: preserve-3d;

            transition: 1s;

            cursor: pointer;

        }



        .card.flip {

            transform: rotateY(180deg);

        }



        .side {

            position: absolute;
            inset: 0;

            border-radius: 28px;

            padding: 25px;

            backface-visibility: hidden;

            overflow: hidden;

            box-shadow:
                0 25px 60px rgba(0, 0, 0, .25);

        }





        .front {


            color: white;


            background:

                linear-gradient(135deg,
                    #0f172a,
                    #2563eb,
                    #7c3aed);


        }





        .circle {

            position: absolute;

            border-radius: 50%;

            background: rgba(255, 255, 255, .12);

        }



        .one {

            width: 220px;
            height: 220px;

            right: -90px;
            top: -90px;

        }



        .two {

            width: 150px;
            height: 150px;

            left: -60px;
            bottom: -60px;

        }





        .header {

            display: flex;

            align-items: center;

            gap: 18px;

        }



        .logo {

            width: 75px;
            height: 75px;

            border-radius: 50%;

            object-fit: cover;

            border: 3px solid rgba(255, 255, 255, .8);

        }



        .header h1 {

            font-size: 25px;

            font-weight: 800;

            margin: 0;

        }



        .header p {

            color: #dbeafe;

            margin-top: 4px;

        }




        .info {

            margin-top: 22px;

            font-size: 14px;

            line-height: 25px;

        }





        .nfc {

            position: absolute;

            right: 25px;

            bottom: 25px;

            font-size: 38px;

            opacity: .8;

        }



        .tap {

            position: absolute;

            bottom: 18px;

            left: 25px;

            font-size: 11px;

            opacity: .7;

        }





        .back {


            background: white;

            text-align: center;

            transform: rotateY(180deg);

        }



        .back h2 {

            font-size: 24px;

            font-weight: bold;

            color: #1e293b;

        }



        .qr {

            width: 110px;

            height: 110px;

            margin: 15px auto;

        }



        .website {

            font-size: 14px;

            color: #475569;

        }



        .location {

            font-size: 12px;

            color: #64748b;

            margin-top: 8px;

        }



        .scan {

            font-size: 11px;

            color: #94a3b8;

            margin-top: 12px;

        }




        @media(max-width:500px) {


            .card {

                width: 330px;
                height: 220px;

            }


            .side {

                padding: 20px;

            }


            .header h1 {

                font-size: 20px;

            }


            .logo {

                width: 60px;
                height: 60px;

            }


        }
    </style>



</x-guest-layout>
