<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>
        @page {
            margin: 35px;
        }


        body {

            font-family: DejaVu Sans, sans-serif;
            color: #222;
            font-size: 12px;

        }



        .header {

            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid {{ $resume->accent_color }};

        }



        .name {

            font-size: 28px;
            font-weight: bold;
            color: #111;

        }



        .title {

            margin-top: 6px;
            font-size: 15px;
            color: #555;

        }



        .contact {

            margin-top: 10px;
            font-size: 11px;
            color: #666;

        }




        .section {

            margin-top: 25px;

        }



        .section-title {

            font-size: 15px;
            font-weight: bold;
            color: {{ $resume->accent_color }};
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;

        }



        .line {

            border-bottom: 1px solid #ddd;
            margin-bottom: 12px;

        }



        .item {

            margin-bottom: 15px;

        }



        .item-title {

            font-weight: bold;
            font-size: 13px;

        }



        .meta {

            color: #666;
            font-size: 11px;
            margin-top: 3px;

        }



        .description {

            margin-top: 5px;
            line-height: 1.5;

        }



        .skills {

            margin-top: 5px;

        }



        .skill {

            display: inline-block;
            margin-right: 8px;
            margin-bottom: 8px;
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 3px;

        }



        .photo {

            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-bottom: 10px;

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

                Profile

            </div>


            <div class="line"></div>



            <div class="description">

                {{ $resume->summary }}

            </div>


        </div>
    @endif







    @if ($resume->experiences)


        <div class="section">


            <div class="section-title">

                Experience

            </div>


            <div class="line"></div>



            @foreach ($resume->experiences as $experience)
                <div class="item">


                    <div class="item-title">

                        {{ $experience['position'] ?? '' }}

                        @if (!empty($experience['company']))
                            - {{ $experience['company'] }}
                        @endif

                    </div>



                    <div class="meta">

                        {{ $experience['start'] ?? '' }}

                        -

                        {{ $experience['end'] ?? '' }}

                    </div>



                    <div class="description">

                        {{ $experience['description'] ?? '' }}

                    </div>


                </div>
            @endforeach


        </div>


    @endif







    @if ($resume->educations)


        <div class="section">


            <div class="section-title">

                Education

            </div>


            <div class="line"></div>



            @foreach ($resume->educations as $education)
                <div class="item">


                    <div class="item-title">

                        {{ $education['degree'] ?? '' }}

                    </div>


                    <div>

                        {{ $education['school'] ?? '' }}

                    </div>


                    <div class="meta">

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


            <div class="line"></div>



            <div class="skills">


                @foreach ($resume->skills as $skill)
                    <span class="skill">

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


            <div class="line"></div>



            @foreach ($resume->projects as $project)
                <div class="item">


                    <div class="item-title">

                        {{ $project['name'] ?? '' }}

                    </div>


                    <div class="description">

                        {{ $project['description'] ?? '' }}

                    </div>


                </div>
            @endforeach


        </div>


    @endif







    @if ($resume->certificates)


        <div class="section">


            <div class="section-title">

                Certificates

            </div>


            <div class="line"></div>



            @foreach ($resume->certificates as $certificate)
                <div class="item">

                    {{ $certificate['name'] ?? '' }}

                </div>
            @endforeach


        </div>


    @endif







    @if ($resume->languages)


        <div class="section">


            <div class="section-title">

                Languages

            </div>


            <div class="line"></div>



            @foreach ($resume->languages as $language)
                <div>

                    {{ $language['name'] ?? '' }}

                    @if (isset($language['level']))
                        - {{ $language['level'] }}
                    @endif


                </div>
            @endforeach


        </div>


    @endif




</body>

</html>
