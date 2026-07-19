<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>
        @page {
            margin: 35px;
        }


        body {

            font-family: Arial, sans-serif;
            color: #111;
            font-size: 12px;

        }



        .header {

            text-align: left;
            border-bottom: 2px solid #111;
            padding-bottom: 15px;

        }



        .name {

            font-size: 26px;
            font-weight: bold;

        }



        .title {

            font-size: 15px;

        }



        .contact {

            margin-top: 8px;

        }



        .section {

            margin-top: 20px;

        }



        .title-section {

            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1px solid #333;
            padding-bottom: 4px;
            margin-bottom: 10px;

        }



        .item {

            margin-bottom: 12px;

        }



        .skills {

            line-height: 2;

        }
    </style>

</head>


<body>



    <div class="header">


        <div class="name">
            {{ $resume->full_name }}
        </div>


        <div class="title">
            {{ $resume->job_title }}
        </div>


        <div class="contact">

            {{ $resume->email }}

            @if ($resume->phone)
                |
                {{ $resume->phone }}
            @endif


            <br>

            {{ $resume->website }}

            <br>

            {{ $resume->address }}


        </div>


    </div>







    @if ($resume->summary)
        <div class="section">

            <div class="title-section">
                Professional Summary
            </div>


            <p>
                {{ $resume->summary }}
            </p>


        </div>
    @endif






    @if ($resume->experiences)

        <div class="section">


            <div class="title-section">
                Experience
            </div>


            @foreach ($resume->experiences as $experience)
                <div class="item">


                    <b>
                        {{ $experience['position'] }}
                    </b>


                    <br>


                    {{ $experience['company'] }}


                    <br>


                    {{ $experience['start'] }}
                    -
                    {{ $experience['end'] }}



                    <p>

                        {{ $experience['description'] }}

                    </p>


                </div>
            @endforeach


        </div>


    @endif







    @if ($resume->educations)

        <div class="section">

            <div class="title-section">
                Education
            </div>


            @foreach ($resume->educations as $education)
                <div class="item">


                    <b>
                        {{ $education['degree'] }}
                    </b>


                    <br>

                    {{ $education['school'] }}


                </div>
            @endforeach


        </div>

    @endif







    @if ($resume->skills)
        <div class="section">

            <div class="title-section">
                Skills
            </div>


            <div class="skills">

                {{ implode(', ', $resume->skills) }}

            </div>


        </div>
    @endif



</body>

</html>
