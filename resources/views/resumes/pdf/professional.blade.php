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

            background: #1f2937;
            color: white;
            padding: 25px;

        }


        .name {

            font-size: 28px;
            font-weight: bold;

        }


        .title {

            font-size: 16px;
            margin-top: 5px;

        }



        .contact {

            margin-top: 15px;
            font-size: 12px;

        }



        .section {

            margin-top: 25px;

        }


        .section-title {

            color: #1f2937;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid {{ $resume->accent_color }};
            padding-bottom: 5px;
            margin-bottom: 10px;

        }



        .item {

            margin-bottom: 15px;

        }


        .item-title {

            font-weight: bold;
            font-size: 13px;

        }


        .small {

            color: #666;

        }


        .skills span {

            display: inline-block;
            background: #f3f4f6;
            padding: 5px 10px;
            margin: 3px;
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



        <div class="contact">

            {{ $resume->email }}

            @if ($resume->phone)
                | {{ $resume->phone }}
            @endif


            @if ($resume->website)
                | {{ $resume->website }}
            @endif


            <br>


            {{ $resume->address }}

        </div>


    </div>





    @if ($resume->summary)
        <div class="section">

            <div class="section-title">
                Professional Summary
            </div>


            <p>
                {{ $resume->summary }}
            </p>


        </div>
    @endif





    @if ($resume->experiences)

        <div class="section">


            <div class="section-title">
                Professional Experience
            </div>



            @foreach ($resume->experiences as $experience)
                <div class="item">


                    <div class="item-title">

                        {{ $experience['position'] ?? '' }}

                        -
                        {{ $experience['company'] ?? '' }}

                    </div>



                    <div class="small">

                        {{ $experience['start'] ?? '' }}

                        -

                        {{ $experience['end'] ?? '' }}

                    </div>



                    <p>

                        {{ $experience['description'] ?? '' }}

                    </p>


                </div>
            @endforeach



        </div>

    @endif








    @if ($resume->educations)

        <div class="section">


            <div class="section-title">
                Education
            </div>


            @foreach ($resume->educations as $education)
                <div class="item">


                    <div class="item-title">

                        {{ $education['degree'] ?? '' }}

                    </div>


                    <div>

                        {{ $education['school'] ?? '' }}

                    </div>


                    <div class="small">

                        {{ $education['start'] ?? '' }}

                        -

                        {{ $education['end'] ?? '' }}

                    </div>


                </div>
            @endforeach


        </div>

    @endif







    @if ($resume->skills)

        <div class="section">


            <div class="section-title">
                Skills
            </div>


            <div class="skills">


                @foreach ($resume->skills as $skill)
                    <span>
                        {{ $skill }}
                    </span>
                @endforeach


            </div>


        </div>

    @endif







    @if ($resume->projects)

        <div class="section">


            <div class="section-title">
                Projects
            </div>


            @foreach ($resume->projects as $project)
                <div class="item">


                    <div class="item-title">

                        {{ $project['name'] ?? '' }}

                    </div>


                    <p>

                        {{ $project['description'] ?? '' }}

                    </p>


                </div>
            @endforeach


        </div>

    @endif





    @if ($resume->certificates)

        <div class="section">


            <div class="section-title">
                Certificates
            </div>


            @foreach ($resume->certificates as $certificate)
                <div>

                    {{ $certificate['name'] ?? '' }}

                </div>
            @endforeach


        </div>

    @endif



</body>

</html>
