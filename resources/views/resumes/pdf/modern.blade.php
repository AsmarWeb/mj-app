<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #374151;
            font-size: 13px;
        }


        :root {
            --color: {{ $resume->accent_color ?? '#2563eb' }};
        }


        .header {

            background: {{ $resume->accent_color ?? '#2563eb' }};
            color: white;
            padding: 35px;

        }


        .header-table {
            width: 100%;
        }


        .photo {

            width: 120px;
            height: 120px;
            border-radius: 60px;
            object-fit: cover;

        }



        .name {

            font-size: 30px;
            font-weight: bold;

        }


        .job {

            font-size: 18px;
            margin-top: 5px;

        }



        .contact {

            margin-top: 15px;
            line-height: 20px;

        }



        .content {

            padding: 35px;

        }



        .section {

            margin-bottom: 25px;

        }



        .title {

            font-size: 18px;
            font-weight: bold;

            color: {{ $resume->accent_color ?? '#2563eb' }};

            border-bottom: 2px solid {{ $resume->accent_color ?? '#2563eb' }};

            padding-bottom: 5px;

            margin-bottom: 15px;

        }



        .card {

            background: #f8fafc;

            border-left: 4px solid {{ $resume->accent_color ?? '#2563eb' }};

            padding: 12px;

            margin-bottom: 12px;

        }



        .card h3 {

            margin: 0;

            font-size: 15px;

        }



        .small {

            color: #6b7280;

            font-size: 12px;

        }



        .skill {

            display: inline-block;

            padding: 6px 12px;

            margin: 4px;

            background: #eef2ff;

            border-radius: 20px;

        }
    </style>


</head>


<body>


    {{-- HEADER --}}

    <div class="header">


        <table class="header-table">

            <tr>


                <td width="25%">


                    @if ($resume->photo)
                        <img class="photo" src="{{ public_path('storage/' . $resume->photo) }}">
                    @endif


                </td>


                <td width="75%">


                    <div class="name">
                        {{ $resume->full_name }}
                    </div>


                    <div class="job">
                        {{ $resume->job_title }}
                    </div>



                    <div class="contact">


                        @if ($resume->email)
                            {{ $resume->email }}
                        @endif


                        @if ($resume->phone)
                            <br>{{ $resume->phone }}
                        @endif



                        @if ($resume->website)
                            <br>{{ $resume->website }}
                        @endif



                        @if ($resume->address)
                            <br>{{ $resume->address }}
                        @endif


                    </div>


                </td>


            </tr>

        </table>


    </div>





    <div class="content">





        {{-- SUMMARY --}}

        @if ($resume->summary)
            <div class="section">

                <div class="title">
                    Professional Summary
                </div>


                <p>
                    {{ $resume->summary }}
                </p>


            </div>
        @endif







        {{-- EXPERIENCE --}}

        @if (!empty($resume->experiences))


            <div class="section">


                <div class="title">
                    Experience
                </div>


                @foreach ($resume->experiences as $experience)
                    <div class="card">


                        <h3>

                            {{ $experience['position'] ?? '' }}

                        </h3>


                        <strong>

                            {{ $experience['company'] ?? '' }}

                        </strong>



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







        {{-- EDUCATION --}}

        @if (!empty($resume->educations))


            <div class="section">


                <div class="title">
                    Education
                </div>



                @foreach ($resume->educations as $education)
                    <div class="card">


                        <h3>

                            {{ $education['degree'] ?? '' }}

                        </h3>


                        <strong>

                            {{ $education['school'] ?? '' }}

                        </strong>



                        <div class="small">

                            {{ $education['start'] ?? '' }}

                            -

                            {{ $education['end'] ?? '' }}

                        </div>


                    </div>
                @endforeach



            </div>


        @endif







        {{-- SKILLS --}}

        @if (!empty($resume->skills))


            <div class="section">


                <div class="title">
                    Skills
                </div>



                @foreach ($resume->skills as $skill)
                    <span class="skill">

                        {{ $skill }}

                    </span>
                @endforeach



            </div>


        @endif







        {{-- PROJECTS --}}

        @if (!empty($resume->projects))


            <div class="section">


                <div class="title">
                    Projects
                </div>



                @foreach ($resume->projects as $project)
                    <div class="card">


                        <h3>

                            {{ $project['name'] ?? '' }}

                        </h3>


                        <p>

                            {{ $project['description'] ?? '' }}

                        </p>


                    </div>
                @endforeach


            </div>


        @endif







        {{-- CERTIFICATES --}}

        @if (!empty($resume->certificates))


            <div class="section">


                <div class="title">
                    Certificates
                </div>



                @foreach ($resume->certificates as $certificate)
                    <div class="card">

                        {{ $certificate['name'] ?? '' }}

                    </div>
                @endforeach


            </div>


        @endif








        {{-- LANGUAGES --}}

        @if (!empty($resume->languages))


            <div class="section">


                <div class="title">
                    Languages
                </div>


                @foreach ($resume->languages as $language)
                    <div class="card">


                        <strong>

                            {{ $language['name'] ?? '' }}

                        </strong>


                        <br>


                        {{ $language['level'] ?? '' }}


                    </div>
                @endforeach



            </div>


        @endif








        {{-- AWARDS --}}

        @if (!empty($resume->awards))


            <div class="section">


                <div class="title">
                    Awards
                </div>


                @foreach ($resume->awards as $award)
                    <div class="card">

                        {{ $award['name'] ?? '' }}

                    </div>
                @endforeach


            </div>


        @endif








        {{-- VOLUNTEER --}}

        @if (!empty($resume->volunteer))


            <div class="section">


                <div class="title">
                    Volunteer Experience
                </div>


                @foreach ($resume->volunteer as $item)
                    <div class="card">

                        {{ $item['description'] ?? '' }}

                    </div>
                @endforeach


            </div>


        @endif








        {{-- REFERENCES --}}

        @if (!empty($resume->references))


            <div class="section">


                <div class="title">
                    References
                </div>


                @foreach ($resume->references as $reference)
                    <div class="card">


                        <strong>
                            {{ $reference['name'] ?? '' }}
                        </strong>


                        <br>


                        {{ $reference['contact'] ?? '' }}


                    </div>
                @endforeach


            </div>


        @endif




    </div>


</body>

</html>
