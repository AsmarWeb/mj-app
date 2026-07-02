<x-main-layout>
    @section('title', 'Ai | murwaj')
    @section('description', "$description")
    @section('keywords', "$keywords")

    <x-slot name="header">
        <x-main-header></x-main-header>
    </x-slot>

    <div class="max-w-3xl mx-auto h-screen flex flex-col">
        <div class="flex-1 overflow-y-auto p-4" id="chat" style="scroll-behavior: smooth;">
            <div class="flex justify-center mb-4">
                <div id="hint" class="bg-slate-700 text-white p-3 rounded-xl max-w-md">
                    Hello! I am an AI bot. How can I assist you today?
                </div>
            </div>
        </div>

        <div class="p-4 border-t border-gray-300">
            <form onsubmit="event.preventDefault(); send();">
                <div class="flex">
                    <input type="text" id="message" placeholder="Ask me anything..."
                        class="flex-1 p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring focus:border-orange-300">
                    <button type="submit"
                        class="bg-orange-600 text-white p-2 rounded-r-md hover:bg-orange-700">Send</button>
                </div>
            </form>
        </div>


        <x-main-footer></x-main-footer>
</x-main-layout>

<script>
    const message = document.getElementById('message');
    const hint = document.getElementById('hint');

    message.addEventListener('input', function() {
        hint.style.display = this.value.length ? 'none' : 'block';
    });

    async function send() {

        let input = document.getElementById("message");

        let text = input.value;

        if (text == "") return;

        let chat = document.getElementById("chat");

        chat.innerHTML += `
<div class="flex justify-end">
<div class="bg-orange-600 text-white p-3 rounded-xl max-w-md">
${text}
</div>
</div>`;

        input.value = "";

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

        let data = await res.json();

        chat.innerHTML += `
<div class="flex">
<div class="bg-slate-700 text-white p-3 rounded-xl max-w-md">
${data.reply}
</div>
</div>`;

        chat.scrollTop = chat.scrollHeight;

    }
</script>
