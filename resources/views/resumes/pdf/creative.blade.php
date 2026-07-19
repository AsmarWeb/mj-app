<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>
        @page {
            margin: 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            font-size: 12px;
        }


        .header {

            background: linear-gradient(135deg,
                    {{ $resume->accent_color }},
                    #9333ea);

            color: white;
            padding: 30px;
            border-radius: 15px;

        }


        .name {

            font-size: 30px;
            font-weight: bold;

        }


        .title {

            font-size: 16px;
            margin-top: 5px;

        }


        .contact {

            margin-top: 15px;

        }



        .photo {

            width: 90px;
            height: 90px;
            border-radius: 50%;
            float: right;

        }



        .section {

            margin-top: 25px;

        }



        .section-title {

            font-size: 17px;
            font-weight: bold;
            color: {{ $resume->accent_color }};
            margin-bottom: 10px;

        }



        .card {

            background: #f8fafc;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 10px;

        }



        .skill {

            display: inline-block;
            background: {{ $resume->accent_color }};
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            margin: 3px;

        }
    </style>

</head>


<body>



    <div class="header">


        @if ($resume->photo)
            <img src="{{ public_path('storage/' . $resume->photo) }}" class="photo">
        @endif


        <div class="name">
            {{ $resume->full_name }}
        </div>


        <div class="title">
            {{ $resume->job_title }}
        </div>


        <div class="contact">

            {{ $resume->email }}

            @if ($resume->phone)
                | {{ $resume->phone }}
            @endif

            <br>

            {{ $resume->website }}

            <br>

            {{ $resume->address }}

        </div>


    </div>





    @if ($resume->summary)
        <div class="section">

            <div class="section-title">
                About Me
            </div>

            <p>
                {{ $resume->summary }}
            </p>

        </div>
    @endif







    @if ($resume->experiences)

        <div class="section">

            <div class="section-title">
                Experience
            </div>


            @foreach ($resume->experiences as $item)
                <div class="card">


                    <b>
                        {{ $item['position'] ?? '' }}
                    </b>

                    <br>

                    {{ $item['company'] ?? '' }}

                    <br>


                    {{ $item['start'] ?? '' }}
                    -
                    {{ $item['end'] ?? '' }}


                    <p>
                        {{ $item['description'] ?? '' }}
                    </p>


                </div>
            @endforeach


        </div>

    @endif







    @if ($resume->skills)

        <div class="section">

            <div class="section-title">
                Skills
            </div>


            @foreach ($resume->skills as $skill)
                <span class="skill">
                    {{ $skill }}
                </span>
            @endforeach


        </div>

    @endif




</body>

</html>
