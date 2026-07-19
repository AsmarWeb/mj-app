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
            background: #111827;
            color: #f9fafb;
            font-size: 12px;

        }


        .header {

            background: #020617;
            padding: 30px;
            border-bottom: 4px solid {{ $resume->accent_color }};

        }



        .name {

            font-size: 30px;
            font-weight: bold;

        }



        .title {

            color: #cbd5e1;
            font-size: 16px;

        }



        .section {

            margin-top: 25px;

        }



        .section-title {

            color: {{ $resume->accent_color }};
            font-size: 17px;
            font-weight: bold;
            border-bottom: 1px solid #374151;
            padding-bottom: 5px;

        }



        .item {

            margin-top: 12px;

        }



        .gray {

            color: #cbd5e1;

        }



        .skill {

            background: #1f2937;
            padding: 5px 10px;
            margin: 3px;
            display: inline-block;
            border-radius: 5px;

        }



        .photo {

            width: 90px;
            height: 90px;
            border-radius: 50%;
            float: right;

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



        <div class="gray">

            {{ $resume->email }}

            @if ($resume->phone)
                | {{ $resume->phone }}
            @endif

        </div>


    </div>






    @if ($resume->summary)
        <div class="section">

            <div class="section-title">
                Summary
            </div>

            <p class="gray">
                {{ $resume->summary }}
            </p>


        </div>
    @endif







    @if ($resume->experiences)

        <div class="section">

            <div class="section-title">
                Experience
            </div>


            @foreach ($resume->experiences as $experience)
                <div class="item">


                    <b>
                        {{ $experience['position'] }}
                    </b>


                    <br>

                    <span class="gray">

                        {{ $experience['company'] }}

                        |

                        {{ $experience['start'] }}
                        -
                        {{ $experience['end'] }}

                    </span>


                    <p class="gray">

                        {{ $experience['description'] }}

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
