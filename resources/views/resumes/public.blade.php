<x-guest-layout>

    <div class="min-h-screen bg-slate-100">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 text-white">

            <div class="max-w-6xl mx-auto px-6 py-12">

                <div class="flex flex-col md:flex-row items-center gap-8">

                    @if ($resume->photo)
                        <img src="{{ asset('storage/' . $resume->photo) }}"
                            class="w-40 h-40 rounded-full border-4 border-white object-cover shadow-xl">
                    @else
                        <div
                            class="w-40 h-40 rounded-full bg-white/20 flex items-center justify-center text-6xl font-bold">
                            {{ strtoupper(substr($resume->full_name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="flex-1">

                        <h1 class="text-5xl font-bold">
                            {{ $resume->full_name }}
                        </h1>

                        <p class="text-2xl mt-2 text-blue-100">
                            {{ $resume->job_title }}
                        </p>

                        <div class="mt-6 flex flex-wrap gap-5 text-sm">

                            <span>📧 {{ $resume->email }}</span>

                            @if ($resume->phone)
                                <span>📱 {{ $resume->phone }}</span>
                            @endif

                            @if ($resume->website)
                                <span>
                                    🌐
                                    <a href="{{ $resume->website }}" target="_blank" class="underline">
                                        {{ $resume->website }}
                                    </a>
                                </span>
                            @endif

                            @if ($resume->address)
                                <span>📍 {{ $resume->address }}</span>
                            @endif

                        </div>

                    </div>

                    <div>

                        <a href="{{ route('resumes.pdf', $resume->id) }}"
                            class="bg-white text-blue-700 px-6 py-3 rounded-xl font-semibold shadow-lg hover:bg-gray-100">
                            Download PDF
                        </a>

                    </div>

                </div>

            </div>

        </div>



        <div class="max-w-6xl mx-auto p-6 space-y-8">

            {{-- Summary --}}
            @if ($resume->summary)
                <div class="bg-white rounded-3xl shadow p-8">

                    <h2 class="text-2xl font-bold mb-5">
                        Professional Summary
                    </h2>

                    <p class="text-gray-700 leading-8">
                        {{ $resume->summary }}
                    </p>

                </div>
            @endif



            {{-- Experience --}}
            @if (count($resume->experiences))

                <div class="bg-white rounded-3xl shadow p-8">

                    <h2 class="text-2xl font-bold mb-8">
                        Experience
                    </h2>

                    <div class="space-y-8">

                        @foreach ($resume->experiences as $experience)
                            <div class="border-l-4 border-blue-600 pl-6">

                                <h3 class="text-xl font-bold">
                                    {{ $experience['position'] }}
                                </h3>

                                <p class="font-semibold text-blue-600">
                                    {{ $experience['company'] }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $experience['start'] }}
                                    -
                                    {{ $experience['end'] }}
                                </p>

                                <p class="mt-3 text-gray-700">
                                    {{ $experience['description'] }}
                                </p>

                            </div>
                        @endforeach

                    </div>

                </div>

            @endif



            {{-- Education --}}
            @if (count($resume->educations))

                <div class="bg-white rounded-3xl shadow p-8">

                    <h2 class="text-2xl font-bold mb-8">
                        Education
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">

                        @foreach ($resume->educations as $education)
                            <div class="border rounded-2xl p-6">

                                <h3 class="font-bold text-lg">
                                    {{ $education['degree'] }}
                                </h3>

                                <p class="text-blue-600">
                                    {{ $education['school'] }}
                                </p>

                                <p class="text-gray-500">
                                    {{ $education['start'] }} - {{ $education['end'] }}
                                </p>

                            </div>
                        @endforeach

                    </div>

                </div>

            @endif



            {{-- Skills --}}
            @if (count($resume->skills))

                <div class="bg-white rounded-3xl shadow p-8">

                    <h2 class="text-2xl font-bold mb-6">
                        Skills
                    </h2>

                    <div class="flex flex-wrap gap-3">

                        @foreach ($resume->skills as $skill)
                            <span class="px-5 py-2 rounded-full bg-blue-100 text-blue-700 font-medium">
                                {{ $skill }}
                            </span>
                        @endforeach

                    </div>

                </div>

            @endif



            {{-- Projects --}}
            @if (count($resume->projects))

                <div class="bg-white rounded-3xl shadow p-8">

                    <h2 class="text-2xl font-bold mb-6">
                        Projects
                    </h2>

                    <div class="grid gap-5">

                        @foreach ($resume->projects as $project)
                            <div class="border rounded-xl p-5">

                                <h3 class="font-bold">
                                    {{ $project['title'] ?? '' }}
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    {{ $project['description'] ?? '' }}
                                </p>

                            </div>
                        @endforeach

                    </div>

                </div>

            @endif



            {{-- Extra Sections --}}

            <div class="grid md:grid-cols-2 gap-8">

                @foreach ([
        'certificates' => 'Certificates',
        'languages' => 'Languages',
        'awards' => 'Awards',
        'volunteer' => 'Volunteer',
        'references' => 'References',
    ] as $field => $title)
                    @if (count($resume->$field))
                        <div class="bg-white rounded-3xl shadow p-8">

                            <h2 class="text-xl font-bold mb-5">
                                {{ $title }}
                            </h2>

                            <ul class="space-y-3">

                                @foreach ($resume->$field as $item)
                                    <li class="border rounded-xl p-4">

                                        {{ is_array($item) ? implode(' • ', $item) : $item }}

                                    </li>
                                @endforeach

                            </ul>

                        </div>
                    @endif
                @endforeach

            </div>

        </div>

        @if (isset($qrCode))
            <div style="text-align:right;">
                <img src="data:image/png;base64,{{ $qrCode }}" class="w-44 h-44 mx-auto" alt="QR Code">

                <div style="font-size:10px;color:#666;">
                    Scan to view online
                </div>
            </div>
        @endif



        {{-- Footer --}}

        <footer class="mt-16 bg-gray-900 text-gray-300">

            <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between">

                <p>
                    © {{ now()->year }} {{ $resume->full_name }}
                </p>

                <p>
                    Resume generated with {{ config('app.name') }}
                </p>

            </div>

        </footer>

    </div>

</x-guest-layout>
