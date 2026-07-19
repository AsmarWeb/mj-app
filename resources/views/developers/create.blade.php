<x-app-layout>

    <div class="min-h-screen bg-slate-100 py-10">


        <div class="max-w-5xl mx-auto px-5">


            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">


                {{-- Header --}}
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 p-10 text-white">


                    <h1 class="text-4xl font-bold">
                        👨‍💻 Join Our Developer Community
                    </h1>


                    <p class="mt-3 text-white/90 text-lg">
                        Become part of the team building {{ config('app.name') }}.
                        Share your skills, experience, and help improve the platform.
                    </p>


                </div>





                <form action="{{ route('developers.store') }}" method="POST" enctype="multipart/form-data" class="p-8">


                    @csrf



                    {{-- Profile --}}
                    <div class="mb-8">


                        <h2 class="text-2xl font-bold text-slate-800 mb-5">
                            👤 Developer Profile
                        </h2>



                        <div class="grid md:grid-cols-2 gap-6">



                            <div>

                                <label class="font-semibold">
                                    Full Name *
                                </label>


                                <input name="name" value="{{ old('name', auth()->user()->name) }}" required
                                    class="mt-2 w-full rounded-xl border-gray-300" placeholder="John Developer">

                            </div>





                            <div>

                                <label class="font-semibold">
                                    Developer Role *
                                </label>


                                <select name="role" class="mt-2 w-full rounded-xl border-gray-300">


                                    <option>
                                        Full Stack Developer
                                    </option>

                                    <option>
                                        Backend Developer
                                    </option>

                                    <option>
                                        Frontend Developer
                                    </option>

                                    <option>
                                        Mobile Developer
                                    </option>

                                    <option>
                                        UI/UX Designer
                                    </option>

                                    <option>
                                        DevOps Engineer
                                    </option>


                                </select>


                            </div>



                        </div>


                    </div>








                    {{-- Avatar --}}
                    <div class="mb-8">


                        <label class="font-semibold">
                            Profile Image
                        </label>


                        <input type="file" name="avatar" accept="image/*" class="mt-2 w-full border rounded-xl p-3">


                        <p class="text-sm text-gray-500 mt-2">
                            Recommended square image.
                        </p>


                    </div>








                    {{-- About --}}
                    <div class="mb-8">


                        <label class="font-semibold">
                            About You
                        </label>


                        <textarea name="bio" rows="5" class="mt-2 w-full rounded-xl border-gray-300"
                            placeholder="Tell us about your experience, skills and what you want to contribute...">{{ old('bio') }}</textarea>


                    </div>









                    {{-- Social Links --}}
                    <div class="mb-8">


                        <h2 class="text-2xl font-bold mb-5">
                            🌐 Developer Links
                        </h2>



                        <div class="grid md:grid-cols-3 gap-6">



                            <div>

                                <label class="font-semibold">
                                    GitHub
                                </label>

                                <input name="github" value="{{ old('github') }}"
                                    class="mt-2 w-full rounded-xl border-gray-300"
                                    placeholder="https://github.com/username">

                            </div>






                            <div>

                                <label class="font-semibold">
                                    LinkedIn
                                </label>


                                <input name="linkedin" value="{{ old('linkedin') }}"
                                    class="mt-2 w-full rounded-xl border-gray-300"
                                    placeholder="https://linkedin.com/in/name">

                            </div>






                            <div>

                                <label class="font-semibold">
                                    Portfolio Website
                                </label>


                                <input name="website" value="{{ old('website') }}"
                                    class="mt-2 w-full rounded-xl border-gray-300"
                                    placeholder="https://yourwebsite.com">

                            </div>


                        </div>


                    </div>









                    {{-- Developer Agreement --}}
                    <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 mb-8">


                        <h3 class="font-bold text-indigo-700 text-lg">
                            🚀 Developer Community
                        </h3>


                        <p class="text-gray-600 mt-2">

                            By joining, your profile may appear in the developer
                            community page as a contributor of murwaj.com.

                        </p>


                    </div>








                    <button
                        class="w-full py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg transition">


                        🚀 Join Developer Team


                    </button>





                </form>


            </div>


        </div>


    </div>


</x-app-layout>
