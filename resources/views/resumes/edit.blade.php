<x-app-layout>

    <div class="min-h-screen bg-slate-100 py-10">

        <div class="max-w-6xl mx-auto px-5">

            <div class="bg-white rounded-3xl shadow-xl p-8">


                <h1 class="text-4xl font-bold text-slate-800 mb-2">
                    Edit Your Resume
                </h1>

                <p class="text-slate-500 mb-8">
                    Update your information, design and download your latest PDF.
                </p>


                <form action="{{ route('resumes.update', $resume->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    {{-- PERSONAL INFORMATION --}}

                    <div class="border-b pb-8">

                        <h2 class="text-2xl font-bold mb-6">
                            👤 Personal Information
                        </h2>


                        <div class="grid md:grid-cols-2 gap-6">


                            <div>
                                <label class="font-semibold">
                                    Full Name
                                </label>

                                <input name="full_name" value="{{ old('full_name', $resume->full_name) }}"
                                    class="mt-2 w-full rounded-xl border-slate-300">

                            </div>



                            <div>
                                <label class="font-semibold">
                                    Job Title
                                </label>

                                <input name="job_title" value="{{ old('job_title', $resume->job_title) }}"
                                    class="mt-2 w-full rounded-xl border-slate-300">

                            </div>




                            <div>
                                <label class="font-semibold">
                                    Email
                                </label>

                                <input name="email" value="{{ old('email', $resume->email) }}"
                                    class="mt-2 w-full rounded-xl border-slate-300">

                            </div>



                            <div>
                                <label>
                                    Phone
                                </label>

                                <input name="phone" value="{{ old('phone', $resume->phone) }}"
                                    class="mt-2 w-full rounded-xl border-slate-300">

                            </div>



                            <div>
                                <label>
                                    Website
                                </label>

                                <input name="website" value="{{ old('website', $resume->website) }}"
                                    class="mt-2 w-full rounded-xl border-slate-300">

                            </div>



                            <div>
                                <label>
                                    Address
                                </label>

                                <input name="address" value="{{ old('address', $resume->address) }}"
                                    class="mt-2 w-full rounded-xl border-slate-300">

                            </div>


                        </div>


                    </div>



                    {{-- DESIGN --}}

                    <div class="py-8 border-b">


                        <h2 class="text-2xl font-bold mb-6">
                            🎨 Resume Design
                        </h2>


                        <div class="grid md:grid-cols-3 gap-5">


                            @foreach ([
        'modern' => 'Clean professional layout',
        'professional' => 'Corporate CV style',
        'minimal' => 'Simple ATS friendly',
        'creative' => 'Designer style',
        'dark' => 'Modern dark theme',
        'ats' => 'Recruiter optimized',
    ] as $key => $description)
                                <label class="cursor-pointer">


                                    <input type="radio" name="template" value="{{ $key }}"
                                        class="hidden peer" {{ $resume->template == $key ? 'checked' : '' }}>


                                    <div
                                        class="
template-card
p-6
rounded-2xl
border-2
border-gray-200
transition

peer-checked:border-blue-600
peer-checked:ring-4
peer-checked:ring-blue-200

hover:shadow-lg
">


                                        <h3 class="font-bold text-lg capitalize">
                                            {{ $key }}
                                        </h3>


                                        <p class="text-sm text-gray-500">
                                            {{ $description }}
                                        </p>


                                    </div>


                                </label>
                            @endforeach


                        </div>




                        <div class="grid md:grid-cols-2 gap-6 mt-8">


                            <div>

                                <label>
                                    Accent Color
                                </label>


                                <input type="color" name="accent_color" value="{{ $resume->accent_color }}"
                                    class="w-full h-12 rounded-xl">


                            </div>



                            <div>

                                <label>
                                    Font
                                </label>


                                <select name="font" class="w-full rounded-xl border">


                                    @foreach (['Inter', 'Roboto', 'Poppins', 'Lato', 'Montserrat'] as $font)
                                        <option value="{{ $font }}"
                                            {{ $resume->font == $font ? 'selected' : '' }}>

                                            {{ $font }}

                                        </option>
                                    @endforeach


                                </select>


                            </div>


                        </div>


                    </div>




                    {{-- SUMMARY --}}

                    <div class="py-8">


                        <h2 class="text-2xl font-bold mb-4">
                            📝 Summary
                        </h2>


                        <textarea name="summary" rows="6" class="w-full rounded-xl border">

{{ old('summary', $resume->summary) }}

</textarea>


                    </div>


                    <button class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl text-lg font-bold">


                        Update Resume


                    </button>


                </form>


            </div>

        </div>

    </div>


</x-app-layout>
