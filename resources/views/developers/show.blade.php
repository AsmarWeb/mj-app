<x-app-layout>

    <div class="min-h-screen bg-slate-100 py-10">

        <div class="max-w-5xl mx-auto px-5">


            {{-- Developer Profile --}}
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">


                {{-- Header --}}
                <div class="h-48 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500"></div>



                <div class="p-8">


                    <div class="flex flex-col md:flex-row items-center gap-6">


                        {{-- Avatar --}}
                        <img src="{{ $developer->avatar
                            ? asset('storage/' . $developer->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($developer->name) }}"
                            class="w-36 h-36 rounded-full border-4 border-white shadow-lg object-cover -mt-24">



                        <div class="flex-1">


                            <h1 class="text-4xl font-bold text-slate-800">
                                {{ $developer->name }}
                            </h1>


                            <p class="text-indigo-600 font-semibold text-lg">
                                {{ $developer->role }}
                            </p>


                            <p class="text-gray-500 mt-3">
                                {{ $developer->bio }}
                            </p>


                        </div>



                        <a href="{{ route('developers.create') }}"
                            class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700">

                            👨‍💻 Join Developer Group

                        </a>


                    </div>


                </div>


            </div>





            {{-- Developer Links --}}
            <div class="grid md:grid-cols-3 gap-6 mt-8">


                @if ($developer->github)
                    <a href="{{ $developer->github }}" target="_blank"
                        class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">

                        <h3 class="font-bold text-lg">
                            GitHub
                        </h3>

                        <p class="text-gray-500 mt-2">
                            View projects and code contributions.
                        </p>

                    </a>
                @endif





                @if ($developer->linkedin)
                    <a href="{{ $developer->linkedin }}" target="_blank"
                        class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">

                        <h3 class="font-bold text-lg">
                            LinkedIn
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Professional profile and experience.
                        </p>

                    </a>
                @endif






                @if ($developer->website)
                    <a href="{{ $developer->website }}" target="_blank"
                        class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">

                        <h3 class="font-bold text-lg">
                            Website
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Personal portfolio.
                        </p>

                    </a>
                @endif


            </div>






            {{-- SaaS Creator Section --}}
            <div class="mt-8 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 rounded-3xl text-white p-10">


                <h2 class="text-3xl font-bold">
                    🚀 Building {{ config('app.name') }}
                </h2>


                <p class="mt-4 text-white/90 text-lg">

                    This murwaj platform is built by developers who love creating
                    useful tools, improving technology, and building solutions
                    for real-world problems.

                </p>



                <div class="mt-8 grid md:grid-cols-3 gap-5">


                    <div class="bg-white/10 rounded-xl p-5">

                        <h3 class="font-bold text-xl">
                            💻 Developers
                        </h3>

                        <p class="mt-2 text-white/80">
                            Collaborate with talented developers.
                        </p>

                    </div>




                    <div class="bg-white/10 rounded-xl p-5">

                        <h3 class="font-bold text-xl">
                            🚀 Projects
                        </h3>

                        <p class="mt-2 text-white/80">
                            Work together on SaaS improvements.
                        </p>

                    </div>





                    <div class="bg-white/10 rounded-xl p-5">

                        <h3 class="font-bold text-xl">
                            🌎 Community
                        </h3>

                        <p class="mt-2 text-white/80">
                            Learn, share, and grow together.
                        </p>

                    </div>


                </div>



            </div>





            {{-- Share Developer --}}
            <div class="bg-white rounded-3xl shadow p-8 mt-8">


                <h2 class="text-2xl font-bold">
                    Share Developer Profile
                </h2>


                <div class="flex gap-3 mt-5">


                    <input readonly value="{{ route('developers.show', $developer->id) }}" id="developerLink"
                        class="flex-1 rounded-xl border-gray-300">



                    <button onclick="navigator.clipboard.writeText(document.getElementById('developerLink').value)"
                        class="px-5 py-3 bg-indigo-600 text-white rounded-xl">

                        Copy

                    </button>


                </div>


            </div>



        </div>

    </div>


</x-app-layout>
