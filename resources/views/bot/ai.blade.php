@php
    $isArabic = app()->getLocale() === 'ar';

    /*
    |--------------------------------------------------------------------------
    | Brand
    |--------------------------------------------------------------------------
    */
    $brandArabic = 'مُروَّج.كم';
    $brandEnglish = 'murwaj';

    /*
    |--------------------------------------------------------------------------
    | Translations
    |--------------------------------------------------------------------------
    */
    $labels = [
        'title' => $isArabic ? "مساعد {$brandArabic} الذكي" : "{$brandEnglish} AI Assistant",

        'welcome_title' => $isArabic ? "مرحباً بك في {$brandArabic} AI 👋" : "Welcome to {$brandEnglish} AI 👋",

        'welcome_text' => $isArabic
            ? "أنا مساعدك الذكي في {$brandArabic}. كيف يمكنني مساعدتك اليوم؟"
            : "I am your smart {$brandEnglish} assistant. How can I help you today?",

        'faq_title' => $isArabic ? 'أسئلة شائعة' : 'Frequently Asked Questions',

        'quick_questions' => $isArabic ? 'اختر سؤالاً' : 'Quick questions',

        'create_shop' => $isArabic ? 'كيفية إنشاء متجر؟' : 'How can I create a shop?',

        'sell_products' => $isArabic ? 'كيفية بيع المنتجات؟' : 'How can I sell products?',

        'buy_product' => $isArabic ? 'كيفية شراء منتج؟' : 'How can I buy a product?',

        'delivery' => $isArabic ? 'كيف تعمل خدمة التوصيل؟' : 'How does delivery work?',

        'contact_seller' => $isArabic ? 'كيفية التواصل مع البائع؟' : 'How can I contact the seller?',

        'placeholder' => $isArabic ? 'اكتب سؤالك هنا...' : "Ask {$brandEnglish} AI anything...",

        'send' => $isArabic ? 'إرسال' : 'Send',

        'typing' => $isArabic ? "{$brandArabic} AI يكتب..." : "{$brandEnglish} AI is typing...",

        'error' => $isArabic
            ? "⚠️ تعذر الاتصال بمساعد {$brandArabic} الذكي."
            : "⚠️ Unable to connect to {$brandEnglish} AI.",

        'fallback' => $isArabic ? 'عذراً، لم أتمكن من الإجابة على سؤالك.' : 'Sorry, I could not answer your question.',

        'online' => $isArabic ? 'متصل الآن' : 'Online',

        'assistant' => $isArabic ? "مساعد {$brandArabic}" : "{$brandEnglish} Assistant",

        'language' => $isArabic ? 'English' : 'العربية',

        'smart_assistant' => $isArabic
            ? "مساعدك الذكي للتسوق والبيع على {$brandArabic}"
            : "Your smart assistant for shopping and selling on {$brandEnglish}",

        'help_text' => $isArabic
            ? 'يمكنك السؤال عن المتاجر والمنتجات والبيع والشراء والتوصيل والمزيد.'
            : 'Ask about shops, products, selling, buying, delivery and more.',

        'connection_error' => $isArabic
            ? 'حدث خطأ أثناء الاتصال. يرجى المحاولة مرة أخرى.'
            : 'Something went wrong while connecting. Please try again.',
    ];

    /*
    |--------------------------------------------------------------------------
    | FAQ Questions
    |--------------------------------------------------------------------------
    */
    $faqQuestions = [
        [
            'icon' => '🏪',
            'label' => $labels['create_shop'],
            'question_en' => "How can I create a shop on {$brandEnglish}?",
            'question_ar' => "كيف يمكنني إنشاء متجر على {$brandArabic}؟",
        ],
        [
            'icon' => '🛒',
            'label' => $labels['sell_products'],
            'question_en' => "How can I sell products on {$brandEnglish}?",
            'question_ar' => "كيف يمكنني بيع المنتجات على {$brandArabic}؟",
        ],
        [
            'icon' => '💳',
            'label' => $labels['buy_product'],
            'question_en' => "How can I buy a product on {$brandEnglish}?",
            'question_ar' => "كيف يمكنني شراء منتج على {$brandArabic}؟",
        ],
        [
            'icon' => '🚚',
            'label' => $labels['delivery'],
            'question_en' => "How does delivery work on {$brandEnglish}?",
            'question_ar' => "كيف تعمل خدمة التوصيل على {$brandArabic}؟",
        ],
        [
            'icon' => '👤',
            'label' => $labels['contact_seller'],
            'question_en' => "How can I contact a seller on {$brandEnglish}?",
            'question_ar' => "كيف يمكنني التواصل مع البائع على {$brandArabic}؟",
        ],
    ];
@endphp


<x-main-layout>

    {{-- ============================================================= --}}
    {{-- PAGE SEO --}}
    {{-- ============================================================= --}}

    @section('title', $labels['title'])

    @section('description', $description ?? $labels['welcome_text'])

    @section('keywords', $keywords ?? 'murwaj, مُروَّج.كم, AI, UAE, متجر, منتجات, بيع, شراء, توصيل')


    {{-- ============================================================= --}}
    {{-- HEADER --}}
    {{-- ============================================================= --}}

    <x-slot name="header">
        <x-main-header />
    </x-slot>


    {{-- ============================================================= --}}
    {{-- PAGE --}}
    {{-- ============================================================= --}}

    <div dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
        class="min-h-screen bg-[#faf8f5] text-slate-900
               transition-colors duration-300
               dark:bg-[#0b0b0c] dark:text-white">

        <main class="mx-auto flex min-h-[calc(100vh-80px)] max-w-6xl
                   flex-col px-3 sm:px-5 lg:px-8">

            {{-- ===================================================== --}}
            {{-- AI HEADER --}}
            {{-- ===================================================== --}}

            <section class="pt-5 sm:pt-7">

                <div
                    class="relative overflow-hidden rounded-[2rem]
                           border border-slate-200/80
                           bg-white
                           shadow-[0_20px_70px_-35px_rgba(0,0,0,0.25)]
                           dark:border-white/10
                           dark:bg-[#151516]">

                    {{-- Decorative glow --}}
                    <div
                        class="pointer-events-none absolute -right-24 -top-24
                               h-64 w-64 rounded-full
                               bg-orange-300/20 blur-3xl
                               dark:bg-orange-500/10">
                    </div>

                    <div
                        class="pointer-events-none absolute -bottom-32 -left-20
                               h-72 w-72 rounded-full
                               bg-amber-300/20 blur-3xl
                               dark:bg-amber-500/10">
                    </div>


                    <div
                        class="relative flex items-center justify-between
                               gap-4 p-5 sm:p-7">

                        {{-- AI Identity --}}
                        <div class="flex min-w-0 items-center gap-4">

                            {{-- AI Logo --}}
                            <div class="relative flex h-14 w-14 shrink-0
                                       items-center justify-center
                                       rounded-2xl
                                       bg-gradient-to-br
                                       from-orange-500
                                       via-orange-600
                                       to-amber-500
                                       text-2xl text-white
                                       shadow-lg
                                       shadow-orange-500/25
                                       sm:h-16 sm:w-16 sm:text-3xl"
                                aria-hidden="true">

                                ✦

                                <span
                                    class="absolute -bottom-1 -right-1
                                           h-4 w-4 rounded-full
                                           border-[3px]
                                           border-white
                                           bg-emerald-500
                                           dark:border-[#151516]"></span>

                            </div>


                            {{-- Title --}}
                            <div class="min-w-0">

                                <div class="flex flex-wrap items-center gap-2">

                                    <h1
                                        class="truncate text-xl font-black
                                               tracking-tight
                                               text-slate-950
                                               dark:text-white
                                               sm:text-2xl">
                                        {{ $labels['assistant'] }}
                                    </h1>


                                    <span
                                        class="inline-flex items-center gap-1.5
                                               rounded-full
                                               bg-emerald-50
                                               px-2.5 py-1
                                               text-[10px]
                                               font-black
                                               uppercase
                                               tracking-wider
                                               text-emerald-700
                                               ring-1
                                               ring-inset
                                               ring-emerald-200
                                               dark:bg-emerald-500/10
                                               dark:text-emerald-400
                                               dark:ring-emerald-500/20">

                                        <span
                                            class="h-1.5 w-1.5
                                                   rounded-full
                                                   bg-emerald-500"></span>

                                        {{ $labels['online'] }}

                                    </span>

                                </div>


                                <p
                                    class="mt-1 text-sm
                                           text-slate-500
                                           dark:text-slate-400">
                                    {{ $labels['welcome_text'] }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ===================================================== --}}
            {{-- CHAT CONTAINER --}}
            {{-- ===================================================== --}}

            <section
                class="my-4 flex min-h-0 flex-1 flex-col
                       overflow-hidden rounded-[2rem]
                       border border-slate-200/80
                       bg-white
                       shadow-[0_20px_70px_-35px_rgba(0,0,0,0.2)]
                       dark:border-white/10
                       dark:bg-[#151516]
                       sm:my-5">

                {{-- ================================================= --}}
                {{-- MESSAGES --}}
                {{-- ================================================= --}}

                <div id="chat"
                    class="min-h-[420px] flex-1 overflow-y-auto
                           scroll-smooth p-4 sm:p-6 lg:p-8"
                    aria-live="polite" aria-atomic="false">

                    {{-- Welcome --}}
                    <div id="welcome" class="flex justify-center py-8 sm:py-12">

                        <div class="w-full max-w-2xl text-center">

                            {{-- Logo --}}
                            <div class="mx-auto flex h-20 w-20
                                       items-center justify-center
                                       rounded-[1.75rem]
                                       bg-gradient-to-br
                                       from-orange-500
                                       via-orange-600
                                       to-amber-500
                                       text-4xl text-white
                                       shadow-xl
                                       shadow-orange-500/20"
                                aria-hidden="true">
                                ✦
                            </div>


                            {{-- Welcome title --}}
                            <h2
                                class="mt-6 text-2xl font-black
                                       text-slate-950
                                       dark:text-white
                                       sm:text-3xl">
                                {{ $labels['welcome_title'] }}
                            </h2>


                            {{-- Welcome text --}}
                            <p
                                class="mx-auto mt-3 max-w-xl
                                       text-sm leading-7
                                       text-slate-500
                                       dark:text-slate-400
                                       sm:text-base">
                                {{ $labels['welcome_text'] }}
                            </p>


                            {{-- Brand message --}}
                            <div
                                class="mx-auto mt-6 flex max-w-md
                                       items-center justify-center
                                       gap-2 rounded-2xl
                                       border border-orange-100
                                       bg-orange-50/70
                                       px-4 py-3
                                       text-xs font-semibold
                                       text-orange-700
                                       dark:border-orange-500/10
                                       dark:bg-orange-500/5
                                       dark:text-orange-400">

                                <span aria-hidden="true">🇦🇪</span>

                                {{ $labels['smart_assistant'] }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- FAQ --}}
                {{-- ================================================= --}}

                <div
                    class="border-t border-slate-200/80
                           bg-slate-50/70
                           px-4 py-4
                           dark:border-white/10
                           dark:bg-white/[0.02]
                           sm:px-6">

                    <div class="mb-3 flex items-center
                               justify-between gap-3">

                        <h3
                            class="text-sm font-black
                                   text-slate-800
                                   dark:text-slate-200">
                            {{ $labels['faq_title'] }}
                        </h3>


                        <span
                            class="hidden text-[10px]
                                   font-bold uppercase
                                   tracking-widest
                                   text-slate-400 sm:block">
                            {{ $labels['quick_questions'] }}
                        </span>

                    </div>


                    <div class="flex gap-2 overflow-x-auto pb-1
                               scrollbar-hide"
                        role="group" aria-label="{{ $labels['faq_title'] }}">

                        @foreach ($faqQuestions as $faq)
                            @php
                                $faqQuestion = $isArabic ? $faq['question_ar'] : $faq['question_en'];
                            @endphp

                            <button type="button" onclick='askFAQ(@json($faqQuestion))'
                                class="group inline-flex shrink-0
                                       items-center gap-2
                                       rounded-xl
                                       border border-slate-200
                                       bg-white
                                       px-3.5 py-2.5
                                       text-xs font-bold
                                       text-slate-700
                                       shadow-sm
                                       transition duration-200
                                       hover:-translate-y-0.5
                                       hover:border-orange-200
                                       hover:bg-orange-50
                                       hover:text-orange-700
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-orange-500/10
                                       dark:border-white/10
                                       dark:bg-white/5
                                       dark:text-slate-300
                                       dark:hover:border-orange-500/20
                                       dark:hover:bg-orange-500/10
                                       dark:hover:text-orange-400">

                                <span
                                    class="text-base transition
                                           group-hover:scale-110"
                                    aria-hidden="true">
                                    {{ $faq['icon'] }}
                                </span>

                                {{ $faq['label'] }}

                            </button>
                        @endforeach

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- INPUT --}}
                {{-- ================================================= --}}

                <div
                    class="border-t border-slate-200/80
                           bg-white p-3
                           dark:border-white/10
                           dark:bg-[#151516]
                           sm:p-4">

                    <form id="chatForm" autocomplete="off">

                        <div
                            class="flex items-center gap-2
                                   rounded-2xl
                                   border border-slate-200
                                   bg-slate-50
                                   p-1.5
                                   shadow-inner
                                   transition
                                   focus-within:border-orange-400
                                   focus-within:ring-4
                                   focus-within:ring-orange-500/10
                                   dark:border-white/10
                                   dark:bg-white/[0.03]">

                            <label for="message" class="sr-only">
                                {{ $labels['placeholder'] }}
                            </label>


                            <input type="text" id="message" name="message" autocomplete="off" enterkeyhint="send"
                                maxlength="2000" placeholder="{{ $labels['placeholder'] }}"
                                class="min-w-0 flex-1
                                       border-0
                                       bg-transparent
                                       px-3 py-3
                                       text-sm
                                       text-slate-900
                                       placeholder:text-slate-400
                                       focus:outline-none
                                       focus:ring-0
                                       dark:text-white
                                       dark:placeholder:text-slate-500
                                       sm:px-4 sm:text-base">


                            <button id="sendButton" type="submit"
                                class="inline-flex shrink-0
                                       items-center justify-center
                                       gap-2 rounded-xl
                                       bg-gradient-to-r
                                       from-orange-500
                                       to-amber-500
                                       px-4 py-3
                                       text-sm font-black
                                       text-white
                                       shadow-lg
                                       shadow-orange-500/20
                                       transition
                                       hover:from-orange-600
                                       hover:to-amber-600
                                       active:scale-95
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-orange-500/20
                                       disabled:cursor-not-allowed
                                       disabled:opacity-60
                                       sm:px-6">

                                <span id="sendIcon" aria-hidden="true">
                                    ➤
                                </span>

                                <span class="hidden sm:inline">
                                    {{ $labels['send'] }}
                                </span>

                            </button>

                        </div>


                        <p
                            class="mt-2 text-center
                                   text-[10px]
                                   text-slate-400
                                   dark:text-slate-500">
                            {{ $labels['help_text'] }}
                        </p>

                    </form>

                </div>

            </section>

        </main>

    </div>


    {{-- ============================================================= --}}
    {{-- FOOTER --}}
    {{-- ============================================================= --}}

    <x-main-footer />


    {{-- ============================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ============================================================= --}}

    <script>
        (() => {
            'use strict';

            const IS_ARABIC = @json($isArabic);

            const TEXT = {
                typing: @json($labels['typing']),
                error: @json($labels['error']),
                fallback: @json($labels['fallback']),
                connectionError: @json($labels['connection_error']),
            };

            const CHAT_ENDPOINT = @json(url('/bot/chat'));

            let isSending = false;


            /*
            |--------------------------------------------------------------------------
            | DOM Ready
            |--------------------------------------------------------------------------
            */

            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('chatForm');
                const input = document.getElementById('message');

                if (form) {
                    form.addEventListener('submit', (event) => {
                        event.preventDefault();
                        send();
                    });
                }

                if (input) {
                    input.focus();
                }
            });


            /*
            |--------------------------------------------------------------------------
            | Escape HTML
            |--------------------------------------------------------------------------
            */

            function escapeHTML(value) {
                return String(value ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }


            /*
            |--------------------------------------------------------------------------
            | Format AI Text
            |--------------------------------------------------------------------------
            */

            function formatAIText(value) {
                return escapeHTML(value)
                    .replace(/\r\n/g, '\n')
                    .replace(/\r/g, '\n')
                    .replace(/\n/g, '<br>');
            }


            /*
            |--------------------------------------------------------------------------
            | Scroll Chat
            |--------------------------------------------------------------------------
            */

            function scrollChat() {
                const chat = document.getElementById('chat');

                if (!chat) {
                    return;
                }

                requestAnimationFrame(() => {
                    chat.scrollTo({
                        top: chat.scrollHeight,
                        behavior: 'smooth'
                    });
                });
            }


            /*
            |--------------------------------------------------------------------------
            | Remove Welcome
            |--------------------------------------------------------------------------
            */

            function removeWelcome() {
                document.getElementById('welcome')?.remove();
            }


            /*
            |--------------------------------------------------------------------------
            | FAQ
            |--------------------------------------------------------------------------
            */

            window.askFAQ = function(question) {
                const input = document.getElementById('message');

                if (!input || !question) {
                    return;
                }

                input.value = question;
                input.focus();

                send();
            };


            /*
            |--------------------------------------------------------------------------
            | Add User Message
            |--------------------------------------------------------------------------
            */

            function addUserMessage(text) {
                const chat = document.getElementById('chat');

                if (!chat) {
                    return;
                }

                const wrapper = document.createElement('div');

                wrapper.className = 'mb-5 flex justify-end';

                wrapper.innerHTML = `
                    <div class="max-w-[85%] sm:max-w-md">
                        <div class="
                            rounded-[1.25rem]
                            rounded-br-md
                            bg-gradient-to-r
                            from-orange-500
                            to-amber-500
                            px-4
                            py-3
                            text-sm
                            font-medium
                            leading-6
                            text-white
                            shadow-lg
                            shadow-orange-500/10
                            break-words
                        ">
                            ${escapeHTML(text)}
                        </div>
                    </div>
                `;

                chat.appendChild(wrapper);
            }


            /*
            |--------------------------------------------------------------------------
            | Loading Message
            |--------------------------------------------------------------------------
            */

            function addLoadingMessage(id) {
                const chat = document.getElementById('chat');

                if (!chat) {
                    return;
                }

                const wrapper = document.createElement('div');

                wrapper.id = id;
                wrapper.className = 'mb-5 flex justify-start';

                wrapper.innerHTML = `
                    <div class="max-w-[85%] sm:max-w-md">
                        <div class="
                            rounded-[1.25rem]
                            rounded-bl-md
                            border
                            border-slate-200
                            bg-slate-50
                            px-4
                            py-3
                            text-sm
                            text-slate-600
                            shadow-sm
                            dark:border-white/10
                            dark:bg-white/5
                            dark:text-slate-300
                        ">
                            <div class="flex items-center gap-2">

                                <div class="flex gap-1" aria-hidden="true">

                                    <span class="
                                        h-1.5 w-1.5 rounded-full
                                        bg-orange-500
                                        animate-bounce
                                    "></span>

                                    <span
                                        class="
                                            h-1.5 w-1.5 rounded-full
                                            bg-orange-500
                                            animate-bounce
                                        "
                                        style="animation-delay:.15s"
                                    ></span>

                                    <span
                                        class="
                                            h-1.5 w-1.5 rounded-full
                                            bg-orange-500
                                            animate-bounce
                                        "
                                        style="animation-delay:.3s"
                                    ></span>

                                </div>

                                <span>
                                    ${escapeHTML(TEXT.typing)}
                                </span>

                            </div>
                        </div>
                    </div>
                `;

                chat.appendChild(wrapper);
            }


            /*
            |--------------------------------------------------------------------------
            | Add AI Message
            |--------------------------------------------------------------------------
            */

            function addAIMessage(text) {
                const chat = document.getElementById('chat');

                if (!chat) {
                    return;
                }

                const wrapper = document.createElement('div');

                wrapper.className = 'mb-5 flex justify-start';

                wrapper.innerHTML = `
                    <div class="
                        flex
                        max-w-[90%]
                        items-start
                        gap-3
                        sm:max-w-2xl
                    ">

                        <div class="
                            hidden
                            h-9
                            w-9
                            shrink-0
                            items-center
                            justify-center
                            rounded-xl
                            bg-gradient-to-br
                            from-orange-500
                            to-amber-500
                            text-white
                            shadow-md
                            sm:flex
                        " aria-hidden="true">
                            ✦
                        </div>

                        <div class="min-w-0">

                            <div class="
                                rounded-[1.25rem]
                                rounded-bl-md
                                border
                                border-slate-200
                                bg-slate-50
                                px-4
                                py-3
                                text-sm
                                leading-7
                                text-slate-700
                                shadow-sm
                                break-words
                                dark:border-white/10
                                dark:bg-white/5
                                dark:text-slate-200
                            ">
                                ${formatAIText(text)}
                            </div>

                        </div>

                    </div>
                `;

                chat.appendChild(wrapper);
            }


            /*
            |--------------------------------------------------------------------------
            | Add Error Message
            |--------------------------------------------------------------------------
            */

            function addErrorMessage(message = TEXT.error) {
                const chat = document.getElementById('chat');

                if (!chat) {
                    return;
                }

                const wrapper = document.createElement('div');

                wrapper.className = 'mb-5 flex justify-start';

                wrapper.innerHTML = `
                    <div class="
                        max-w-[90%]
                        rounded-[1.25rem]
                        rounded-bl-md
                        border
                        border-red-200
                        bg-red-50
                        px-4
                        py-3
                        text-sm
                        font-semibold
                        leading-6
                        text-red-700
                        dark:border-red-500/20
                        dark:bg-red-500/10
                        dark:text-red-400
                    ">
                        ${escapeHTML(message)}
                    </div>
                `;

                chat.appendChild(wrapper);
            }


            /*
            |--------------------------------------------------------------------------
            | Send Message
            |--------------------------------------------------------------------------
            */

            async function send() {
                if (isSending) {
                    return;
                }

                const input = document.getElementById('message');
                const sendButton = document.getElementById('sendButton');

                if (!input) {
                    return;
                }

                const text = input.value.trim();

                if (!text) {
                    input.focus();
                    return;
                }

                isSending = true;

                removeWelcome();

                input.disabled = true;

                if (sendButton) {
                    sendButton.disabled = true;
                }

                addUserMessage(text);

                input.value = '';

                scrollChat();

                const loadingId = `loading-${Date.now()}`;

                addLoadingMessage(loadingId);

                scrollChat();


                try {
                    const response = await fetch(CHAT_ENDPOINT, {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': @json(csrf_token()),
                            'X-Requested-With': 'XMLHttpRequest'
                        },

                        body: JSON.stringify({
                            message: text,
                            language: IS_ARABIC ? 'ar' : 'en'
                        })
                    });


                    let data = null;

                    try {
                        data = await response.json();
                    } catch {
                        data = null;
                    }


                    document.getElementById(loadingId)?.remove();


                    if (!response.ok) {
                        throw new Error(
                            data?.message ||
                            data?.error ||
                            `Server error: ${response.status}`
                        );
                    }


                    const reply =
                        data?.reply ??
                        data?.message ??
                        data?.response ??
                        TEXT.fallback;


                    addAIMessage(reply);

                } catch (error) {

                    console.error('murwaj AI error:', error);

                    document.getElementById(loadingId)?.remove();

                    addErrorMessage(TEXT.error);

                } finally {

                    isSending = false;

                    input.disabled = false;

                    if (sendButton) {
                        sendButton.disabled = false;
                    }

                    input.focus();

                    scrollChat();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Expose send globally
            |--------------------------------------------------------------------------
            */

            window.send = send;

        })();
    </script>

</x-main-layout>
