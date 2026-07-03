<!-- Shop Logo -->
<div class="flex items-center gap-6">

    <div class="relative">

        <img id="logoPreview" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow hidden">


        <div id="logoPlaceholder"
            class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z" />
            </svg>

        </div>


        <input type="file" name="logo" onchange="previewLogo(event)"
            class="absolute inset-0 opacity-0 cursor-pointer rounded-full">

    </div>


    <div>
        <h3 class="font-semibold text-lg">
            Shop Logo
        </h3>

        <p class="text-sm text-gray-500">
            PNG or JPG (max 2MB)
        </p>
    </div>

</div>

<!-- Cover Image -->
<div>
    <h3 class="font-semibold text-lg mb-2">
        Cover Image
    </h3>

    <div class="relative h-52 rounded-xl overflow-hidden bg-gray-200 border-2 border-dashed border-gray-300">

        <img id="coverPreview" class="w-full h-full object-cover hidden">


        <div id="coverPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center text-gray-500">

            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
            </svg>

            Upload Cover Photo

        </div>


        <input type="file" name="banner" onchange="previewCover(event)"
            class="absolute inset-0 opacity-0 cursor-pointer">

    </div>

</div>

<script>
    function previewLogo(event) {
        const logoPreview = document.getElementById('logoPreview');
        const logoPlaceholder = document.getElementById('logoPlaceholder');

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
                logoPreview.classList.remove('hidden');
                logoPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            logoPreview.src = '';
            logoPreview.classList.add('hidden');
            logoPlaceholder.classList.remove('hidden');
        }
    }
</script>

<script>
    function previewCover(event) {
        const coverPreview = document.getElementById('coverPreview');
        const coverPlaceholder = document.getElementById('coverPlaceholder');

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                coverPreview.src = e.target.result;
                coverPreview.classList.remove('hidden');
                coverPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            coverPreview.src = '';
            coverPreview.classList.add('hidden');
            coverPlaceholder.classList.remove('hidden');
        }
    }
</script>
