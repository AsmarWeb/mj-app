<x-main-layout>
    @section('title', "$title")
    @section('description', "$description")
    @section('keywords', "$keywords")

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">

                <div class="profile-card bg-[var(--bg-card)] rounded-3xl overflow-hidden shadow-2xl">

                    <!-- Banner -->
                    <div class="banner-container h-56 relative"
                        style="background: url('{{ asset('storage/shop-suggest/' . $shop->banner) }}') center/cover;">
                        <button
                            class="edit-banner-btn absolute top-6 right-6 bg-white p-3 rounded-2xl shadow-md hover:bg-gray-100 transition-all">
                            <i class="bi bi-pencil-square text-xl"></i>
                        </button>
                    </div>

                    <!-- Shop Logo -->
                    <div class="profile-img-wrapper -mt-16 ml-10 relative z-10 inline-block">
                        <img src="{{ asset('storage/shop-suggest/' . $shop->logo) }}" alt="{{ $shop->name }}"
                            class="profile-image w-40 h-40 rounded-full border-4 border-white object-cover shadow-xl">
                    </div>

                    <div class="px-8 pb-8 pt-6">
                        <div class="flex flex-wrap items-end gap-8">
                            <!-- Left Info -->
                            <div class="flex-1">
                                <h2 class="text-4xl font-bold">{{ $shop->name }}</h2>
                                <p class="text-gray-500 text-lg">{{ $shop->type }}</p>
                                <p class="text-gray-500 flex items-center gap-2 mt-1"><i class="bi bi-geo-alt"></i>
                                    {{ $shop->city->name }}, {{ $shop->state->name }}</p>

                                <div class="flex gap-3 mt-6">
                                    <button
                                        class="btn-action border border-gray-300 dark:border-gray-600 px-6 py-3 rounded-3xl font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">Edit
                                        Profile</button>
                                    <button
                                        class="btn-action border border-gray-300 dark:border-gray-600 px-6 py-3 rounded-3xl font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">Settings</button>
                                </div>
                            </div>

                            <!-- Right Info -->
                            <div class="text-right">
                                <div class="mb-6">
                                    <p class="text-sm text-gray-500 mb-2">Current role</p>
                                    <span
                                        class="badge bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white border px-4 py-2 rounded-3xl font-semibold">Software
                                        Engineer</span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-3">Skills</p>
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <span class="badge-skill">HTML</span>
                                        <span class="badge-skill">CSS</span>
                                        <span class="badge-skill">Dart</span>
                                        <span class="badge-skill">C++</span>
                                        <span class="badge-skill">UI Design</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Boxes -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-12">
                            <a href="#"
                                class="info-box bg-[var(--info-card-bg)] border border-[var(--border-custom)] rounded-3xl p-6 hover:shadow-lg transition-all">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h6 class="font-bold">Ready for work</h6>
                                        <p class="text-sm text-gray-500 mt-2">Show recruiters that you're ready for
                                            work.</p>
                                    </div>
                                    <div
                                        class="icon-circle w-9 h-9 p-5 border-2 border-blue-600 text-blue-600 rounded-full flex items-center justify-center">
                                        →
                                    </div>
                                </div>
                            </a>

                            <a href="#"
                                class="info-box bg-[var(--info-card-bg)] border border-[var(--border-custom)] rounded-3xl p-6 hover:shadow-lg transition-all">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h6 class="font-bold">Share posts</h6>
                                        <p class="text-sm text-gray-500 mt-2">Share latest news to get connected with
                                            others.</p>
                                    </div>
                                    <div
                                        class="icon-circle w-9 h-9 p-5 border-2 border-blue-600 text-blue-600 rounded-full flex items-center justify-center">
                                        →
                                    </div>
                                </div>
                            </a>

                            <a href="#"
                                class="info-box bg-[var(--info-card-bg)] border border-[var(--border-custom)] rounded-3xl p-6 hover:shadow-lg transition-all">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h6 class="font-bold">Update</h6>
                                        <p class="text-sm text-gray-500 mt-2">Keep your profile updated so recruiters
                                            know you better.</p>
                                    </div>
                                    <div
                                        class="icon-circle w-9 h-9 p-5 border-2 border-blue-600 text-blue-600 rounded-full flex items-center justify-center">
                                        →
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-main-layout>
