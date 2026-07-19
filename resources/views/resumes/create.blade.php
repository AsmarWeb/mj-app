<x-app-layout>
    <div class="min-h-screen bg-slate-100 py-10">

        <div class="max-w-6xl mx-auto px-5">


            <div class="bg-white shadow-2xl rounded-3xl p-8">


                <div class="mb-8">

                    <h1 class="text-4xl font-bold text-slate-800">
                        Create Your Professional Resume
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Design your CV, add your experience and download a beautiful PDF.
                    </p>

                </div>



                <form action="{{ route('resumes.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf



                    {{-- PERSONAL INFORMATION --}}

                    <div class="border-b pb-8">

                        <h2 class="text-2xl font-bold text-slate-800 mb-6">
                            👤 Personal Information
                        </h2>


                        <div class="grid md:grid-cols-2 gap-6">


                            <div>

                                <label class="font-semibold">
                                    Full Name *
                                </label>

                                <input name="full_name" required class="mt-2 w-full rounded-xl border-slate-300"
                                    placeholder="Muhammad Umair Arshad">

                            </div>



                            <div>

                                <label class="font-semibold">
                                    Professional Title
                                </label>

                                <input name="job_title" class="mt-2 w-full rounded-xl border-slate-300"
                                    placeholder="Laravel Developer">

                            </div>



                            <div>

                                <label class="font-semibold">
                                    Email *
                                </label>

                                <input name="email" type="email" required
                                    class="mt-2 w-full rounded-xl border-slate-300" placeholder="email@example.com">

                            </div>



                            <div>

                                <label class="font-semibold">
                                    Phone
                                </label>

                                <input name="phone" class="mt-2 w-full rounded-xl border-slate-300"
                                    placeholder="+971 50 0000000">

                            </div>




                            <div>

                                <label class="font-semibold">
                                    Website / Portfolio
                                </label>

                                <input name="website" class="mt-2 w-full rounded-xl border-slate-300"
                                    placeholder="https://portfolio.com">

                            </div>



                            <div>

                                <label class="font-semibold">
                                    Address
                                </label>

                                <input name="address" class="mt-2 w-full rounded-xl border-slate-300"
                                    placeholder="Dubai, UAE">

                            </div>



                        </div>





                        <div class="mt-6">

                            <label class="font-semibold">
                                Profile Photo
                            </label>


                            <input type="file" name="photo" accept="image/*"
                                class="mt-2 w-full border rounded-xl p-3">


                            <p class="text-sm text-slate-500 mt-2">
                                Recommended: Square image, maximum 2MB
                            </p>


                        </div>


                    </div>







                    {{-- DESIGN SETTINGS --}}

                    <div class="py-8 border-b">

                        <h2 class="text-2xl font-bold mb-6">
                            🎨 Resume Design
                        </h2>


                        <div class="grid md:grid-cols-3 gap-6">


                            {{-- MODERN --}}
                            <label class="cursor-pointer group">

                                <input type="radio" name="template" value="modern" checked class="hidden peer">


                                <div
                                    class="
                                     template-card
                relative
                rounded-2xl
                border-2
                border-gray-200
                overflow-hidden
                transition-all
                duration-300
                peer-checked:border-blue-600
                peer-checked:ring-4
                peer-checked:ring-blue-200
                peer-checked:shadow-xl
                group-hover:-translate-y-1
            ">


                                    <span
                                        class="
                    hidden
                    peer-checked:block
                    absolute
                    top-3
                    right-3
                    z-10
                    bg-blue-600
                    text-white
                    text-xs
                    font-bold
                    px-3
                    py-1
                    rounded-full
                ">
                                        ✓ Selected
                                    </span>


                                    <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-700 p-5">

                                        <div class="w-20 h-2 bg-white rounded mb-3"></div>

                                        <div class="w-36 h-2 bg-white/50 rounded"></div>

                                    </div>


                                    <div class="p-5">

                                        <h3 class="font-bold text-lg">
                                            Modern
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Clean professional layout
                                        </p>

                                    </div>


                                </div>

                            </label>





                            {{-- PROFESSIONAL --}}
                            <label class="cursor-pointer group">

                                <input type="radio" name="template" value="professional" class="hidden peer">


                                <div
                                    class="
                                     template-card
                relative
                rounded-2xl
                border-2
                border-gray-200
                overflow-hidden
                transition-all
                duration-300
                peer-checked:border-blue-600
                peer-checked:ring-4
                peer-checked:ring-blue-200
                peer-checked:shadow-xl
                group-hover:-translate-y-1
            ">


                                    <span
                                        class="
                    hidden
                    peer-checked:block
                    absolute
                    top-3
                    right-3
                    bg-blue-600
                    text-white
                    text-xs
                    font-bold
                    px-3
                    py-1
                    rounded-full
                    z-10
                ">
                                        ✓ Selected
                                    </span>


                                    <div class="h-32 bg-slate-800 p-5">

                                        <div class="w-28 h-2 bg-white rounded mb-3"></div>

                                        <div class="w-40 h-1 bg-gray-400 rounded"></div>

                                    </div>


                                    <div class="p-5">

                                        <h3 class="font-bold text-lg">
                                            Professional
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Corporate CV style
                                        </p>

                                    </div>


                                </div>

                            </label>






                            {{-- MINIMAL --}}
                            <label class="cursor-pointer group">

                                <input type="radio" name="template" value="minimal" class="hidden peer">


                                <div
                                    class="
                                     template-card
                relative
                rounded-2xl
                border-2
                border-gray-200
                overflow-hidden
                transition-all
                duration-300
                peer-checked:border-blue-600
                peer-checked:ring-4
                peer-checked:ring-blue-200
                peer-checked:shadow-xl
                group-hover:-translate-y-1">


                                    <span
                                        class="
                hidden
                peer-checked:block
                absolute
                top-3
                right-3
                bg-blue-600
                text-white
                text-xs
                font-bold
                px-3
                py-1
                rounded-full
                z-10">
                                        ✓ Selected
                                    </span>


                                    <div class="h-32 bg-white p-5">

                                        <div class="w-24 h-2 bg-black rounded mb-4"></div>

                                        <div class="space-y-2">
                                            <div class="h-1 bg-gray-200"></div>
                                            <div class="h-1 bg-gray-200"></div>
                                        </div>

                                    </div>


                                    <div class="p-5">

                                        <h3 class="font-bold text-lg">
                                            Minimal
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Simple ATS friendly
                                        </p>

                                    </div>


                                </div>

                            </label>








                            {{-- CREATIVE --}}
                            <label class="cursor-pointer group">

                                <input type="radio" name="template" value="creative" class="hidden peer">


                                <div
                                    class="
                                     template-card
            relative
            rounded-2xl
            border-2
            border-gray-200
            overflow-hidden
            transition-all
            duration-300
            peer-checked:border-blue-600
            peer-checked:ring-4
            peer-checked:ring-blue-200
            peer-checked:shadow-xl
            group-hover:-translate-y-1">


                                    <span
                                        class="
            hidden
            peer-checked:block
            absolute
            top-3
            right-3
            bg-blue-600
            text-white
            text-xs
            font-bold
            px-3
            py-1
            rounded-full
            z-10">
                                        ✓ Selected
                                    </span>


                                    <div class="h-32 bg-gradient-to-br from-purple-600 to-pink-500 p-5">

                                        <div class="h-16 w-16 rounded-full bg-white/40"></div>

                                    </div>


                                    <div class="p-5">

                                        <h3 class="font-bold text-lg">
                                            Creative
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Designer style
                                        </p>

                                    </div>


                                </div>

                            </label>









                            {{-- DARK --}}
                            <label class="cursor-pointer group">


                                <input type="radio" name="template" value="dark" class="hidden peer">


                                <div
                                    class="
                                     template-card
            relative
            rounded-2xl
            border-2
            border-gray-200
            overflow-hidden
            transition-all
            duration-300
            peer-checked:border-blue-600
            peer-checked:ring-4
            peer-checked:ring-blue-200
            peer-checked:shadow-xl
            group-hover:-translate-y-1">


                                    <span
                                        class="
            hidden
            peer-checked:block
            absolute
            top-3
            right-3
            bg-blue-600
            text-white
            text-xs
            font-bold
            px-3
            py-1
            rounded-full
            z-10">
                                        ✓ Selected
                                    </span>


                                    <div class="h-32 bg-black p-5">

                                        <div class="w-24 h-2 bg-white rounded mb-3"></div>

                                        <div class="w-full h-1 bg-gray-700"></div>

                                    </div>


                                    <div class="p-5">

                                        <h3 class="font-bold text-lg">
                                            Dark
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Modern dark theme
                                        </p>

                                    </div>


                                </div>

                            </label>








                            {{-- ATS --}}
                            <label class="cursor-pointer group">


                                <input type="radio" name="template" value="ats" class="hidden peer">


                                <div
                                    class="
                                     template-card
            relative
            rounded-2xl
            border-2
            border-gray-200
            overflow-hidden
            transition-all
            duration-300
            peer-checked:border-blue-600
            peer-checked:ring-4
            peer-checked:ring-blue-200
            peer-checked:shadow-xl
            group-hover:-translate-y-1">


                                    <span
                                        class="
            hidden
            peer-checked:block
            absolute
            top-3
            right-3
            bg-blue-600
            text-white
            text-xs
            font-bold
            px-3
            py-1
            rounded-full
            z-10">
                                        ✓ Selected
                                    </span>


                                    <div class="h-32 bg-gray-100 p-5">

                                        <div class="h-2 bg-gray-800 rounded mb-3"></div>

                                        <div class="space-y-2">

                                            <div class="h-1 bg-gray-300"></div>

                                            <div class="h-1 bg-gray-300"></div>

                                        </div>


                                    </div>



                                    <div class="p-5">

                                        <h3 class="font-bold text-lg">
                                            ATS Friendly
                                        </h3>


                                        <p class="text-sm text-gray-500">
                                            Recruiter optimized
                                        </p>


                                    </div>


                                </div>


                            </label>



                        </div>

                    </div>





                    <div class="grid md:grid-cols-2 gap-6 mt-8">


                        <div>

                            <label class="font-semibold">
                                Accent Color
                            </label>

                            <input type="color" name="accent_color" value="#2563eb"
                                class="mt-2 h-12 w-full rounded-xl">


                        </div>




                        <div>

                            <label class="font-semibold">
                                Font Style
                            </label>


                            <select name="font" class="mt-2 w-full rounded-xl border-slate-300">


                                <option>Inter</option>
                                <option>Roboto</option>
                                <option>Poppins</option>
                                <option>Lato</option>
                                <option>Montserrat</option>


                            </select>

                        </div>


                    </div>


            </div>








            {{-- SUMMARY --}}

            <div class="py-8 border-b">


                <h2 class="text-2xl font-bold mb-5">
                    📝 Professional Summary
                </h2>


                <textarea name="summary" rows="5" class="w-full rounded-xl border-slate-300"
                    placeholder="Example: Experienced Laravel developer with 5 years building scalable web applications..."></textarea>


            </div>







            {{-- EXPERIENCE --}}

            <div id="experience-container">


                <div class="experience-item grid md:grid-cols-2 gap-4">


                    <input name="experiences[0][company]" class="rounded-xl border" placeholder="Company">


                    <input name="experiences[0][position]" class="rounded-xl border" placeholder="Job Title">


                    <input name="experiences[0][start]" class="rounded-xl border" placeholder="Start Year">


                    <input name="experiences[0][end]" class="rounded-xl border" placeholder="End Year">


                    <textarea name="experiences[0][description]" class="rounded-xl border md:col-span-2" placeholder="Job description"></textarea>


                </div>


            </div>


            <button type="button" onclick="addExperience()"
                class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-xl">

                + Add Experience

            </button>






            {{-- EDUCATION --}}

            <div class="py-8 border-t">

                <h2 class="text-2xl font-bold mb-5">
                    🎓 Education
                </h2>


                <div id="education-container">


                    <div class="education-item grid md:grid-cols-2 gap-4">


                        <input name="educations[0][school]" class="rounded-xl border"
                            placeholder="School / University">


                        <input name="educations[0][degree]" class="rounded-xl border" placeholder="Degree">


                        <input name="educations[0][start]" class="rounded-xl border" placeholder="Start Year">


                        <input name="educations[0][end]" class="rounded-xl border" placeholder="End Year">


                    </div>


                </div>



                <button type="button" onclick="addEducation()"
                    class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-xl">

                    + Add Education

                </button>


            </div>







            {{-- SKILLS --}}

            <div class="py-8 border-t">


                <h2 class="text-2xl font-bold mb-5">
                    ⚡ Skills
                </h2>


                <div id="skills-container">


                    <input name="skills[]" class="rounded-xl border w-full mb-3" placeholder="Example: Laravel">


                </div>



                <button type="button" onclick="addSkill()" class="bg-blue-600 text-white px-4 py-2 rounded-xl">

                    + Add Skill

                </button>


            </div>







            {{-- EXTRA SECTIONS --}}

            <div class="py-8 border-t">


                <h2 class="text-2xl font-bold mb-5">
                    ⭐ Additional Sections
                </h2>



                <div class="space-y-8">


                    {{-- Projects --}}

                    <div>

                        <h3 class="font-bold mb-3">
                            Projects
                        </h3>


                        <div id="project-container">

                            <input name="projects[0][name]" class="rounded-xl border w-full mb-3"
                                placeholder="Project Name">


                            <textarea name="projects[0][description]" class="rounded-xl border w-full" placeholder="Project Description"></textarea>


                        </div>


                        <button type="button" onclick="addProject()"
                            class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-xl">

                            + Add Project

                        </button>

                    </div>





                    {{-- Certificates --}}

                    <div>

                        <h3 class="font-bold mb-3">
                            Certificates
                        </h3>


                        <input name="certificates[0][name]" class="rounded-xl border w-full"
                            placeholder="Certificate Name">


                    </div>






                    {{-- Languages --}}

                    <div>

                        <h3 class="font-bold mb-3">
                            Languages
                        </h3>


                        <input name="languages[0][name]" class="rounded-xl border w-full mb-2"
                            placeholder="Language">


                        <input name="languages[0][level]" class="rounded-xl border w-full" placeholder="Level">


                    </div>





                    {{-- Awards --}}

                    <div>

                        <h3 class="font-bold mb-3">
                            Awards
                        </h3>


                        <input name="awards[0][name]" class="rounded-xl border w-full" placeholder="Award Name">


                    </div>





                    {{-- Volunteer --}}

                    <div>

                        <h3 class="font-bold mb-3">
                            Volunteer
                        </h3>


                        <textarea name="volunteer[0][description]" class="rounded-xl border w-full" placeholder="Volunteer Experience"></textarea>


                    </div>






                    {{-- References --}}

                    <div>

                        <h3 class="font-bold mb-3">
                            References
                        </h3>


                        <input name="references[0][name]" class="rounded-xl border w-full mb-2"
                            placeholder="Reference Name">


                        <input name="references[0][contact]" class="rounded-xl border w-full" placeholder="Contact">


                    </div>



                </div>


            </div>






            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl text-lg font-bold transition">


                Generate My Resume PDF


            </button>



            <script>
                let experienceIndex = 1;
                let educationIndex = 1;
                let projectIndex = 1;



                function addExperience() {

                    let html = `

<div class="grid md:grid-cols-2 gap-4 mt-5">

<input name="experiences[${experienceIndex}][company]"
class="rounded-xl border"
placeholder="Company">


<input name="experiences[${experienceIndex}][position]"
class="rounded-xl border"
placeholder="Job Title">


<input name="experiences[${experienceIndex}][start]"
class="rounded-xl border"
placeholder="Start Year">


<input name="experiences[${experienceIndex}][end]"
class="rounded-xl border"
placeholder="End Year">


<textarea
name="experiences[${experienceIndex}][description]"
class="rounded-xl border md:col-span-2"
placeholder="Description"></textarea>


</div>

`;

                    document
                        .getElementById('experience-container')
                        .insertAdjacentHTML('beforeend', html);


                    experienceIndex++;

                }






                function addEducation() {

                    let html = `

<div class="grid md:grid-cols-2 gap-4 mt-5">


<input
name="educations[${educationIndex}][school]"
class="rounded-xl border"
placeholder="University">


<input
name="educations[${educationIndex}][degree]"
class="rounded-xl border"
placeholder="Degree">


<input
name="educations[${educationIndex}][start]"
class="rounded-xl border"
placeholder="Start">


<input
name="educations[${educationIndex}][end]"
class="rounded-xl border"
placeholder="End">


</div>

`;


                    document
                        .getElementById('education-container')
                        .insertAdjacentHTML('beforeend', html);


                    educationIndex++;

                }






                function addSkill() {

                    document
                        .getElementById('skills-container')
                        .insertAdjacentHTML(
                            'beforeend',
                            `
<input
name="skills[]"
class="rounded-xl border w-full mb-3"
placeholder="Skill">
`
                        );

                }






                function addProject() {

                    let html = `

<div class="mt-5">

<input
name="projects[${projectIndex}][name]"
class="rounded-xl border w-full mb-3"
placeholder="Project Name">


<textarea
name="projects[${projectIndex}][description]"
class="rounded-xl border w-full"
placeholder="Description"></textarea>


</div>

`;


                    document
                        .getElementById('project-container')
                        .insertAdjacentHTML('beforeend', html);


                    projectIndex++;

                }
            </script>

            <script>
                document.querySelectorAll('input[name="template"]').forEach(input => {

                    input.addEventListener('change', function() {


                        // Remove selected style from all cards
                        document.querySelectorAll('.template-card')
                            .forEach(card => {

                                card.classList.remove(
                                    'ring-4',
                                    'ring-blue-300',
                                    'border-blue-600',
                                    'shadow-xl'
                                );

                            });



                        // Add selected style to current card
                        const card = this
                            .closest('label')
                            .querySelector('.template-card');


                        card.classList.add(
                            'ring-4',
                            'ring-blue-300',
                            'border-blue-600',
                            'shadow-xl'
                        );


                    });

                });


                // Apply selected style on page load

                document
                    .querySelector('input[name="template"]:checked')
                    ?.dispatchEvent(new Event('change'));
            </script>


            </form>


        </div>

    </div>

    </div>
</x-app-layout>
