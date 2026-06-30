<html>

<head>

    <style>
        @page {
            size: 3.5in 2in;
            margin: 0;
        }


        .card {

            width: 3.5in;
            height: 2in;

            padding: 20px;

            background: {{ $card->color }};

            color: white;

            font-family: Arial;

        }


        .name {

            font-size: 22px;
            font-weight: bold;

        }


        .company {

            font-size: 16px;

        }


        .info {

            margin-top: 15px;
            font-size: 12px;

        }
    </style>

</head>


<body>


    <div class="card">


        <div class="name">
            {{ $card->name }}
        </div>


        <div class="company">
            {{ $card->company }}
        </div>


        <div>
            {{ $card->job_title }}
        </div>


        <div class="info">

            ☎ {{ $card->phone }}

            <br>

            ✉ {{ $card->email }}

            <br>

            {{ $card->website }}

            <br>

            {{ $card->address }}

        </div>


    </div>


</body>

</html>
