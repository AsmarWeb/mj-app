<x-main-layout>

    @section('title', 'Ai | murwaj')
    @section('description', "$description")
    @section('keywords', "$keywords")


    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>



    <div class="max-w-3xl mx-auto h-screen flex flex-col">


        {{-- CHAT AREA --}}
        <div class="
            flex-1
            overflow-y-auto
            p-4
            space-y-4
            "
            id="chat" style="scroll-behavior:smooth;">



            {{-- Welcome --}}
            <div class="flex justify-center mb-4">

                <div id="hint"
                    class="
                    bg-slate-700
                    text-white
                    p-4
                    rounded-2xl
                    max-w-md
                    shadow-lg
                    ">

                    👋 Hello! I am murwaj AI.
                    How can I help you today?

                </div>

            </div>


        </div>





        {{-- FAQ SECTION --}}
        <div
            class="
            px-4
            pb-3
            border-t
            border-gray-200
            dark:border-white/10
            ">


            <h3
                class="
                text-sm
                font-bold
                text-gray-600
                dark:text-gray-300
                mb-3
                ">

                Frequently Asked Questions

            </h3>



            <div
                class="
                flex
                gap-2
                overflow-x-auto
                scrollbar-hide
                ">


                <button onclick="askFAQ('How can I create a shop?')"
                    class="
                    shrink-0
                    px-4
                    py-2
                    rounded-full
                    bg-gray-100
                    dark:bg-neutral-800
                    hover:bg-orange-500
                    hover:text-white
                    transition
                    text-sm
                    ">

                    🏪 Create Shop

                </button>



                <button onclick="askFAQ('How can I sell products on Murwaj?')"
                    class="
                    shrink-0
                    px-4
                    py-2
                    rounded-full
                    bg-gray-100
                    dark:bg-neutral-800
                    hover:bg-orange-500
                    hover:text-white
                    transition
                    text-sm
                    ">

                    🛒 Sell Products

                </button>



                <button onclick="askFAQ('How can I buy a product?')"
                    class="
                    shrink-0
                    px-4
                    py-2
                    rounded-full
                    bg-gray-100
                    dark:bg-neutral-800
                    hover:bg-orange-500
                    hover:text-white
                    transition
                    text-sm
                    ">

                    💳 Buy Product

                </button>



                <button onclick="askFAQ('How does delivery work?')"
                    class="
                    shrink-0
                    px-4
                    py-2
                    rounded-full
                    bg-gray-100
                    dark:bg-neutral-800
                    hover:bg-orange-500
                    hover:text-white
                    transition
                    text-sm
                    ">

                    🚚 Delivery

                </button>



                <button onclick="askFAQ('How can I contact seller?')"
                    class="
                    shrink-0
                    px-4
                    py-2
                    rounded-full
                    bg-gray-100
                    dark:bg-neutral-800
                    hover:bg-orange-500
                    hover:text-white
                    transition
                    text-sm
                    ">

                    👤 Contact Seller

                </button>


            </div>


        </div>





        {{-- INPUT --}}
        <div
            class="
            p-4
            border-t
            border-gray-300
            dark:border-white/10
            ">


            <form onsubmit="event.preventDefault(); send();">


                <div class="flex">


                    <input type="text" id="message" placeholder="Ask murwaj AI..."
                        class="
                        flex-1
                        p-3
                        rounded-l-xl
                        border
                        border-gray-300
                        dark:bg-neutral-900
                        dark:border-white/10
                        focus:outline-none
                        focus:ring-2
                        focus:ring-orange-500
                        ">


                    <button type="submit"
                        class="
                        px-6
                        bg-orange-600
                        text-white
                        rounded-r-xl
                        hover:bg-orange-700
                        transition
                        ">

                        Send

                    </button>


                </div>


            </form>


        </div>



        <x-main-footer></x-main-footer>


    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {


            const message = document.getElementById('message');
            const hint = document.getElementById('hint');


            if (message && hint) {

                message.addEventListener('input', function() {

                    hint.style.display = this.value.length ? 'none' : 'block';

                });

            }


        });





        function escapeHTML(text) {

            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");

        }





        function askFAQ(question) {

            let input = document.getElementById("message");

            input.value = question;

            send();

        }






        async function send() {


            const input = document.getElementById("message");

            const chat = document.getElementById("chat");


            let text = input.value.trim();



            if (!text) return;



            // USER MESSAGE

            chat.innerHTML += `

    <div class="flex justify-end mb-3">

        <div class="
            bg-orange-600
            text-white
            px-4
            py-3
            rounded-2xl
            max-w-md
            shadow">

            ${escapeHTML(text)}

        </div>

    </div>

    `;



            input.value = "";


            chat.scrollTo({

                top: chat.scrollHeight,

                behavior: "smooth"

            });




            // LOADING MESSAGE

            let loadingId = "loading-" + Date.now();


            chat.innerHTML += `

    <div id="${loadingId}" class="flex mb-3">

        <div class="
            bg-slate-700
            text-white
            px-4
            py-3
            rounded-2xl">

            <span class="animate-pulse">
                Murwaj AI is typing...
            </span>

        </div>

    </div>

    `;



            chat.scrollTop = chat.scrollHeight;



            try {


                let res = await fetch("/bot/chat", {


                    method: "POST",


                    headers: {


                        "Content-Type": "application/json",

                        "X-CSRF-TOKEN": "{{ csrf_token() }}"


                    },


                    body: JSON.stringify({

                        message: text

                    })


                });




                if (!res.ok) {

                    throw new Error("Server error");

                }




                let data = await res.json();




                document.getElementById(loadingId)?.remove();





                chat.innerHTML += `


        <div class="flex mb-3">


            <div class="

                bg-slate-700

                dark:bg-neutral-800

                text-white

                px-4

                py-3

                rounded-2xl

                max-w-md

                shadow">


                ${escapeHTML(data.reply ?? "Sorry, I could not answer.")}


            </div>


        </div>


        `;




            } catch (error) {



                document.getElementById(loadingId)?.remove();



                chat.innerHTML += `


        <div class="flex mb-3">


            <div class="

            bg-red-600

            text-white

            px-4

            py-3

            rounded-2xl">


            ⚠️ Unable to connect to AI.


            </div>


        </div>


        `;



                console.error(error);


            }





            chat.scrollTo({

                top: chat.scrollHeight,

                behavior: "smooth"

            });



        }
    </script>
</x-main-layout>
