<x-app-layout>

    <div class="min-h-screen bg-slate-100 py-12">


        <div class="max-w-6xl mx-auto">


            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-10 text-white">

                <h1 class="text-5xl font-bold">
                    Build The Future With Us 🚀
                </h1>


                <p class="mt-4 text-xl text-white/90">
                    Meet the developers behind {{ config('app.name') }}
                    and join our growing murwaj community.
                </p>


                <a href="{{ route('developers.join') }}"
                    class="inline-block mt-8 bg-white text-indigo-700 px-8 py-4 rounded-xl font-bold">

                    Join Developer Team

                </a>


            </div>



            <div class="grid md:grid-cols-3 gap-6 mt-10">


                @foreach ($developers as $developer)
                    <div class="bg-white rounded-3xl shadow p-6 text-center">


                        <img src="{{ asset('storage/' . $developer->avatar) }}"
                            class="w-28 h-28 rounded-full mx-auto object-cover">


                        <h2 class="text-xl font-bold mt-4">

                            {{ $developer->name }}

                        </h2>


                        <p class="text-indigo-600">

                            {{ $developer->role }}

                        </p>


                        <p class="text-gray-500 mt-3">

                            {{ $developer->bio }}

                        </p>


                        <div class="flex justify-center gap-3 mt-5">


                            @if ($developer->github)
                                <a href="{{ $developer->github }}" class="px-4 py-2 bg-gray-900 text-white rounded-lg">

                                    GitHub

                                </a>
                            @endif


                            @if ($developer->linkedin)
                                <a href="{{ $developer->linkedin }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg">

                                    LinkedIn

                                </a>
                            @endif


                        </div>


                    </div>
                @endforeach


            </div>


        </div>


    </div>


</x-app-layout>
