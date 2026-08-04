<div class="container px-4 mx-auto">
    @php
        $shop = $services->first()->shop;
    @endphp
    {{-- Shop Details --}}
    @if ($shop)
        <div class="p-6 mb-8 bg-white border rounded-xl shadow-sm">
            <h2 class="text-3xl font-bold text-gray-800">
                {{ app()->getLocale() == 'ar' ? $shop->name_ar : $shop->name }}
            </h2>

            @if (app()->getLocale() == 'ar')
                <p class="mt-3 text-gray-600">
                    {{ $shop->description_ar }}
                </p>
            @else
                <p class="mt-3 text-gray-600">
                    {{ $shop->description }}
                </p>
            @endif
        </div>
    @endif

    {{-- Services --}}
    @if ($services->count())

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

            @foreach ($services as $service)
                <div class="relative">

                    <span class="absolute inset-0 translate-x-1 translate-y-1 rounded-xl"
                        style="background-color: {{ $service->bg_color }}">
                    </span>

                    <div class="relative h-full p-6 bg-white border-2 border-indigo-500 rounded-xl">

                        <div class="flex items-center justify-between mb-4">

                            <h3 class="text-xl font-bold text-gray-800">
                                {{ app()->getLocale() == 'ar' ? $service->title_ar : $service->title }}
                            </h3>

                            <span class="px-3 py-1 text-xs font-semibold text-white rounded-full"
                                style="background-color: {{ $service->bg_color }}">
                                {{ $service->delivery_days }}
                                {{ __('Days') }}
                            </span>

                        </div>

                        <div class="w-16 h-1 mb-4 rounded" style="background-color: {{ $service->bg_color }}">
                        </div>

                        <p class="leading-7 text-gray-600">
                            {{ app()->getLocale() == 'ar' ? $service->description_ar : $service->description }}
                        </p>

                        @if ($service->shop)
                            <div class="pt-4 mt-6 border-t">

                                <p class="text-sm text-gray-500">
                                    {{ __('services.main.by') }}
                                </p>

                                <p class="font-semibold text-indigo-600">
                                    {{ app()->getLocale() == 'ar' ? $service->shop->name_ar : $service->shop->name }}
                                </p>

                            </div>
                        @endif

                    </div>

                </div>
            @endforeach

        </div>
    @else
        <div class="py-16 text-center bg-gray-50 rounded-xl">
            <p class="text-lg text-gray-500">
                {{ __('services.main.td') }}
            </p>
        </div>

    @endif

    {{-- Contact CTA --}}
    @if ($shop && $shop->whatsapp)
        <div class="flex justify-center mt-10">
            <div class="max-w-2xl p-8 text-center bg-white border border-gray-200 shadow-lg rounded-2xl">

                <div class="flex justify-center mb-4">
                    <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M20.52 3.48A11.82 11.82 0 0012.04 0C5.4 0 .01 5.39.01 12.04c0 2.12.55 4.19 1.6 6.03L0 24l6.11-1.59a12 12 0 005.93 1.51h.01c6.64 0 12.03-5.39 12.03-12.03a11.9 11.9 0 00-3.56-8.41zM12.04 21.9a9.8 9.8 0 01-5-1.37l-.36-.22-3.62.94.97-3.53-.24-.37a9.83 9.83 0 1117.99-5.31c0 5.42-4.41 9.83-9.84 9.83z" />
                        </svg>
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-gray-900">
                    {{ app()->getLocale() == 'ar' ? 'جاهز لتنمية أعمالك؟' : 'Ready to Grow Your Business?' }}
                </h3>

                <p class="mt-3 text-gray-600 leading-7">
                    {{ app()->getLocale() == 'ar'
                        ? 'تواصل معنا عبر واتساب لمناقشة مشروعك. سواء كنت ترغب في بيع منتجات رقمية، أو إنشاء متجر إلكتروني، أو تطوير علامتك التجارية، فإن فريقنا جاهز لمساعدتك.'
                        : 'Chat with our team on WhatsApp to discuss your project. Whether you want to sell digital products, build an online store, or grow your brand, we’re here to help you succeed.' }}
                </p>

                <a href="https://wa.me/{{ preg_replace('/\D/', '', $shop->whatsapp) }}" target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center px-8 py-4 mt-6 text-lg font-semibold text-white transition-all duration-300 bg-green-600 rounded-full shadow-lg hover:bg-green-700 hover:shadow-xl hover:-translate-y-1">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M20.52 3.48A11.82 11.82 0 0012.04 0C5.4 0 .01 5.39.01 12.04c0 2.12.55 4.19 1.6 6.03L0 24l6.11-1.59a12 12 0 005.93 1.51h.01c6.64 0 12.03-5.39 12.03-12.03a11.9 11.9 0 00-3.56-8.41z" />
                    </svg>

                    {{ app()->getLocale() == 'ar' ? 'ابدأ المحادثة عبر واتساب' : 'Start a Conversation on WhatsApp' }}
                </a>

            </div>
        </div>
    @endif

</div>
