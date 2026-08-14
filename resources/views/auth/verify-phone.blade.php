@php
    $isArabic = app()->getLocale() === 'ar';

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    */

    $labels = [
        'title' => $isArabic ? 'تأكيد رقم الهاتف' : 'Verify your phone number',

        'subtitle' => $isArabic
            ? 'سنرسل رمز تحقق مكوّنًا من 6 أرقام إلى رقم هاتفك عبر رسالة نصية.'
            : 'We will send a 6-digit verification code to your phone by SMS.',

        'phone' => $isArabic ? 'رقم الهاتف' : 'Phone number',

        'phone_help' => $isArabic
            ? 'استخدم رقم هاتفك بصيغة دولية، مثل +971501234567.'
            : 'Enter your phone number in international format, for example +971501234567.',

        'send_code' => $isArabic ? 'إرسال رمز التحقق' : 'Send verification code',

        'code_title' => $isArabic ? 'أدخل رمز التحقق' : 'Enter verification code',

        'code_help' => $isArabic
            ? 'أدخل الرمز المكوّن من 6 أرقام الذي أرسلناه إلى هاتفك.'
            : 'Enter the 6-digit code we sent to your phone.',

        'code' => $isArabic ? 'رمز التحقق' : 'Verification code',

        'verify' => $isArabic ? 'تأكيد رقم الهاتف' : 'Verify phone number',

        'resend' => $isArabic ? 'إعادة إرسال الرمز' : 'Resend code',

        'resend_help' => $isArabic
            ? 'لم يصلك الرمز؟ يمكنك طلب رمز جديد.'
            : "Didn't receive the code? You can request a new one.",

        'success' => $isArabic ? 'تم إرسال رمز التحقق بنجاح.' : 'Verification code sent successfully.',

        'error_title' => $isArabic ? 'تعذر إكمال العملية' : 'Something went wrong',

        'verification_sent' => $isArabic
            ? 'تم إرسال رمز التحقق إلى رقم هاتفك.'
            : 'A verification code has been sent to your phone.',

        'secure' => $isArabic
            ? 'بياناتك محمية ولن نستخدم رقم هاتفك إلا لأغراض التحقق والتواصل المتعلقة بحسابك.'
            : 'Your information is protected. Your phone number is only used for verification and account-related communication.',
    ];

    $phone = old('phone', auth()->user()->phone);

    $showCode = session('codeSent') || session('success') || old('code');
@endphp

<x-guest-layout>

    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div dir="{{ $isArabic ? 'rtl' : 'ltr' }}" lang="{{ $isArabic ? 'ar' : 'en' }}" class="mx-auto w-full max-w-md">

            <div
                class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800">

                {{-- =====================================================
                    HEADER
                ====================================================== --}}

                <div class="px-6 pb-6 pt-8 text-center sm:px-8">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 shadow-sm dark:bg-orange-500/10 dark:text-orange-400">

                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />

                        </svg>

                    </div>

                    <h1 class="mt-5 text-2xl font-black tracking-tight text-gray-900 dark:text-white">
                        {{ $labels['title'] }}
                    </h1>

                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-gray-500 dark:text-gray-400">
                        {{ $labels['subtitle'] }}
                    </p>

                </div>


                <div class="px-6 pb-8 sm:px-8">

                    {{-- =================================================
                        SUCCESS MESSAGE
                    ================================================== --}}

                    @if (session('success'))
                        <div
                            class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800 dark:border-green-900/50 dark:bg-green-950/30 dark:text-green-300">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-green-100 font-bold dark:bg-green-900/50">

                                ✓

                            </div>

                            <div class="min-w-0">

                                <p class="font-bold">
                                    {{ $labels['success'] }}
                                </p>

                                <p class="mt-1 text-sm leading-5 opacity-80">
                                    {{ $labels['verification_sent'] }}
                                </p>

                            </div>

                        </div>
                    @endif


                    {{-- =================================================
                        ERROR MESSAGE
                    ================================================== --}}

                    @if ($errors->any())

                        <div
                            class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-300">

                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 font-black dark:bg-red-900/50">

                                    !

                                </div>

                                <div class="min-w-0">

                                    <p class="font-bold">
                                        {{ $labels['error_title'] }}
                                    </p>

                                    <ul class="mt-2 space-y-1 text-sm leading-5">

                                        @foreach ($errors->all() as $error)
                                            <li class="flex gap-2">
                                                <span>•</span>
                                                <span>{{ $error }}</span>
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                        PHONE NUMBER
                    ================================================== --}}

                    <form method="POST" action="{{ route('phone.send') }}">

                        @csrf

                        <div>

                            <label for="phone" class="mb-2 block text-sm font-bold text-gray-800 dark:text-gray-200">

                                {{ $labels['phone'] }}

                            </label>

                            <input id="phone" type="tel" name="phone" value="{{ $phone }}"
                                placeholder="+971501234567" autocomplete="tel" inputmode="tel" dir="ltr"
                                class="block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3.5 text-left text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500">

                            <p class="mt-2 text-xs leading-5 text-gray-500 dark:text-gray-400">
                                {{ $labels['phone_help'] }}
                            </p>

                        </div>


                        <button type="submit"
                            class="mt-5 flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 px-5 py-3.5 font-bold text-white shadow-lg shadow-orange-500/20 transition hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-4 focus:ring-orange-500/20">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />

                            </svg>

                            {{ $labels['send_code'] }}

                        </button>

                    </form>


                    {{-- =================================================
                        VERIFICATION CODE
                    ================================================== --}}

                    @if ($showCode)
                        <div class="my-7 flex items-center gap-3">

                            <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>

                            <span
                                class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500 dark:bg-gray-700 dark:text-gray-300">

                                {{ $isArabic ? 'الخطوة التالية' : 'Next step' }}

                            </span>

                            <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>

                        </div>


                        <div
                            class="rounded-2xl border border-orange-100 bg-orange-50/60 p-5 dark:border-orange-500/10 dark:bg-orange-500/5">

                            <div class="mb-5">

                                <h2 class="text-lg font-black text-gray-900 dark:text-white">
                                    {{ $labels['code_title'] }}
                                </h2>

                                <p class="mt-1 text-sm leading-6 text-gray-500 dark:text-gray-400">
                                    {{ $labels['code_help'] }}
                                </p>

                            </div>


                            <form method="POST" action="{{ route('phone.check') }}">

                                @csrf

                                <label for="code"
                                    class="mb-2 block text-sm font-bold text-gray-800 dark:text-gray-200">

                                    {{ $labels['code'] }}

                                </label>

                                <input id="code" type="text" name="code" maxlength="6"
                                    value="{{ old('code') }}" placeholder="123456" autocomplete="one-time-code"
                                    inputmode="numeric" pattern="[0-9]{6}" dir="ltr"
                                    class="block w-full rounded-2xl border-gray-200 bg-white px-4 py-4 text-center text-2xl font-black tracking-[0.5em] text-gray-900 outline-none transition placeholder:text-gray-300 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-600">

                                <button type="submit"
                                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-2xl bg-green-600 px-5 py-3.5 font-bold text-white shadow-lg shadow-green-600/20 transition hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-500/20">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        aria-hidden="true">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />

                                    </svg>

                                    {{ $labels['verify'] }}

                                </button>

                            </form>


                            {{-- RESEND --}}

                            <div class="mt-5 text-center">

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $labels['resend_help'] }}
                                </p>

                                <form method="POST" action="{{ route('phone.send') }}" class="mt-2">

                                    @csrf

                                    <input type="hidden" name="phone" value="{{ $phone }}">

                                    <button type="submit"
                                        class="text-sm font-bold text-orange-600 transition hover:text-orange-700 hover:underline dark:text-orange-400 dark:hover:text-orange-300">

                                        {{ $labels['resend'] }}

                                    </button>

                                </form>

                            </div>

                        </div>
                    @endif


                    {{-- =================================================
                        SECURITY NOTE
                    ================================================== --}}

                    <div class="mt-6 flex items-start gap-3 rounded-2xl bg-gray-50 p-4 dark:bg-gray-900">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">

                            🔒

                        </div>

                        <p class="text-xs leading-5 text-gray-500 dark:text-gray-400">
                            {{ $labels['secure'] }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </x-authentication-card>

</x-guest-layout>
