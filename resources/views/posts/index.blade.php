<x-main-layout>

    @section('title', 'Feed | murwaj')


    <x-slot name="header">
        <x-main-header />
    </x-slot>



    <div class="min-h-screen">

        <div class="max-w-7xl mx-auto px-4 py-6">


            <div class="grid grid-cols-12 gap-6">



                {{-- ========================= --}}
                {{-- LEFT SIDEBAR --}}
                {{-- ========================= --}}


                <aside class="hidden lg:block lg:col-span-3">


                    <div class="sticky top-24 space-y-6">



                        <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-6
">


                            <h2 class="text-xl font-black mb-5">
                                Marketplace
                            </h2>



                            <nav class="space-y-3">


                                <a href="#"
                                    class="
flex
items-center
gap-3
bg-orange-500
text-white
px-4
py-3
rounded-2xl
font-bold
">

                                    🛒 Products Feed

                                </a>




                                <a href="{{ route('posts.index') }}"
                                    class="flex items-center gap-3 bg-gray-100 dark:bg-neutral-800 px-4 py-3 rounded-2xl font-bold ">

                                    📦 Requests

                                </a>




                                <a href="{{ route('countries') }}"
                                    class="
flex
items-center
gap-3
bg-gray-100
dark:bg-neutral-800
px-4
py-3
rounded-2xl
font-bold
">

                                    🏪 Nearby Stores

                                </a>


                            </nav>



                        </div>





                        <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-6
">


                            <h2 class="font-black text-lg mb-4">

                                Tips

                            </h2>


                            <ul class="
space-y-3
text-sm
text-gray-600
dark:text-gray-300
">


                                <li>
                                    ✅ Add your location
                                </li>


                                <li>
                                    ✅ Describe what you need
                                </li>


                                <li>
                                    ✅ Sellers can reply
                                </li>


                                <li>
                                    ✅ Add product images
                                </li>


                            </ul>


                        </div>




                    </div>


                </aside>







                {{-- ========================= --}}
                {{-- CENTER FEED --}}
                {{-- ========================= --}}


                <main class="col-span-12 lg:col-span-6">






                    {{-- STORIES --}}


                    <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-5
mb-6
">


                        <div class="
flex
gap-5
overflow-x-auto
">


                            @forelse(($shops ?? []) as $shop)
                                <div class="
shrink-0
text-center
">


                                    @if ($shop->logo)
                                        <img src="{{ Storage::url($shop->logo) }}"
                                            class="
w-16
h-16
rounded-full
border-4
border-orange-500
object-cover
">
                                    @else
                                        <div
                                            class="
w-16
h-16
rounded-full
bg-orange-500
text-white
flex
items-center
justify-center
font-black
text-xl
">

                                            {{ strtoupper(substr($shop->name, 0, 1)) }}

                                        </div>
                                    @endif



                                    <p class="
text-xs
mt-2
w-16
truncate
">

                                        {{ $shop->name }}

                                    </p>



                                </div>



                            @empty


                                <p class="text-gray-500 text-sm">

                                    No stores yet

                                </p>
                            @endforelse



                        </div>


                    </div>










                    {{-- CREATE REQUEST --}}



                    <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-6
mb-8
">



                        <div class="
flex
items-center
gap-4
">


                            <div
                                class="
w-14
h-14
rounded-full
bg-orange-500
text-white
flex
items-center
justify-center
font-black
text-xl
">


                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}


                            </div>



                            <div>

                                <h2 class="
text-2xl
font-black
">

                                    Looking for something?

                                </h2>


                                <p class="text-gray-500 text-sm">

                                    Ask nearby shops or online sellers

                                </p>


                            </div>


                        </div>







                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
                            class="mt-6">

                            @csrf


                            {{-- TEXT AREA --}}
                            <div class="relative">

                                <textarea name="caption" rows="5" required
                                    class="
            w-full
            rounded-3xl
            border
            border-gray-200
            dark:border-neutral-700
            dark:bg-neutral-800
            dark:text-white
            p-5
            text-base
            leading-7
            resize-none
            outline-none
            focus:ring-2
            focus:ring-orange-500
            transition
            "
                                    placeholder="

What are you looking for?

Example:

📱 Looking for iPhone 15 Pro nearby

💻 Need a gaming laptop today

🏠 Searching for furniture shop

🚗 Need a car rental

"></textarea>


                                <div
                                    class="
        absolute
        bottom-4
        right-5
        text-xs
        text-gray-400
        ">
                                    murwaj Request
                                </div>

                            </div>




                            {{-- IMAGE PREVIEW --}}
                            <div id="imagePreview"
                                class="
        grid
        grid-cols-3
        gap-3
        mt-5
        ">
                            </div>





                            {{-- ACTION BAR --}}
                            <div
                                class="
        mt-6
        flex
        items-center
        justify-between
        bg-gray-50
        dark:bg-neutral-800
        rounded-3xl
        p-4
        ">



                                {{-- UPLOAD BUTTON --}}
                                <label
                                    class="
            cursor-pointer
            flex
            items-center
            gap-3
            text-orange-500
            font-bold
            hover:text-orange-600
            transition
            ">


                                    <div
                                        class="
                w-10
                h-10
                rounded-full
                bg-orange-100
                dark:bg-orange-500/20
                flex
                items-center
                justify-center
                text-xl
                ">

                                        📷

                                    </div>


                                    <span>
                                        Add Images
                                    </span>



                                    <input type="file" name="images[]" id="imageInput" multiple accept="image/*"
                                        class="hidden">


                                </label>







                                {{-- POST BUTTON --}}
                                <button type="submit"
                                    class="
            bg-gradient-to-r
            from-orange-500
            to-red-500
            hover:from-orange-600
            hover:to-red-600
            text-white
            px-8
            py-3
            rounded-full
            font-black
            shadow-lg
            hover:shadow-xl
            transition
            ">

                                    🚀 Post Request

                                </button>



                            </div>



                        </form>



                    </div>










                    {{-- CONTINUE FEED CARDS --}}

                    @forelse($posts as $post)

                        <article
                            class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
overflow-hidden
mb-8
border
border-gray-100
dark:border-neutral-800
">


                            {{-- POST HEADER --}}

                            <div class="p-5 flex justify-between items-center">


                                <div class="flex items-center gap-3">


                                    <div
                                        class="
        w-12
        h-12
        rounded-full
        bg-gradient-to-br
        from-orange-500
        to-red-500
        text-white
        flex
        items-center
        justify-center
        font-black
        text-xl
        ">

                                        {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}

                                    </div>



                                    <div>

                                        <h3 class="font-black dark:text-white">

                                            {{ $post->user->name ?? 'User' }}

                                        </h3>


                                        <p class="text-xs text-gray-500">

                                            {{ $post->created_at->diffForHumans() }}

                                        </p>


                                    </div>


                                </div>



                                @if (auth()->id() === $post->user_id)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                        onsubmit="return confirm('Delete this post?');">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-500 text-sm font-bold">

                                            🗑 Delete

                                        </button>

                                    </form>
                                @endif


                            </div>





                            {{-- TEXT --}}

                            @if ($post->caption)
                                <div class="px-5 pb-5">

                                    <p class="
whitespace-pre-line
dark:text-gray-200
">

                                        {{ $post->caption }}

                                    </p>

                                </div>
                            @endif






                            {{-- IMAGE GALLERY --}}

                            @if ($post->media->count())
                                @php
                                    $count = $post->media->count();
                                @endphp



                                @if ($count == 1)
                                    <img src="{{ Storage::url($post->media->first()->file_path) }}"
                                        class="
w-full
max-h-[700px]
object-cover
">
                                @elseif($count == 2)
                                    <div class="grid grid-cols-2 gap-1">

                                        @foreach ($post->media as $media)
                                            <img src="{{ Storage::url($media->file_path) }}"
                                                class="
h-[450px]
w-full
object-cover
">
                                        @endforeach

                                    </div>
                                @elseif($count == 3)
                                    <div class="grid grid-cols-2 gap-1">


                                        <img src="{{ Storage::url($post->media[0]->file_path) }}"
                                            class="
row-span-2
w-full
h-full
object-cover
">


                                        <img src="{{ Storage::url($post->media[1]->file_path) }}"
                                            class="
w-full
h-[250px]
object-cover
">


                                        <img src="{{ Storage::url($post->media[2]->file_path) }}"
                                            class="
w-full
h-[250px]
object-cover
">


                                    </div>
                                @else
                                    <div class="grid grid-cols-2 gap-1">


                                        @foreach ($post->media->take(4) as $media)
                                            <img src="{{ Storage::url($media->file_path) }}"
                                                class="
aspect-square
object-cover
w-full
">
                                        @endforeach


                                    </div>
                                @endif
                            @endif








                            {{-- ACTION BAR --}}

                            <div
                                class="
px-5
py-4
border-t
border-gray-100
dark:border-neutral-800
flex
justify-between
">


                                <button class="
like-btn
flex
gap-2
items-center
hover:text-red-500
"
                                    data-id="{{ $post->id }}">


                                    ❤️

                                    <span id="count-{{ $post->id }}">

                                        {{ $post->likes->count() }}

                                    </span>


                                </button>





                                <button
                                    onclick="
document.getElementById(
'comments-{{ $post->id }}'
).scrollIntoView()
">

                                    💬

                                    {{ $post->comments->count() }}

                                </button>





                                <button>

                                    📤 Share

                                </button>



                            </div>









                            {{-- COMMENTS --}}


                            <div id="comments-{{ $post->id }}" class="
bg-gray-50
dark:bg-black/20
p-5
">


                                <form action="{{ route('comments.store', $post) }}" method="POST"
                                    class="flex gap-2 mb-5">


                                    @csrf


                                    <input name="comment" required
                                        class="
flex-1
rounded-full
border
dark:bg-neutral-900
dark:border-neutral-700
px-5
"
                                        placeholder="Reply with product or store information...">


                                    <button class="
bg-orange-500
text-white
px-6
rounded-full
font-bold
">

                                        Send

                                    </button>


                                </form>





                                <div class="space-y-4">


                                    @forelse($post->comments as $comment)
                                        <div class="flex gap-3">

                                            <div
                                                class="
w-9
h-9
rounded-full
bg-orange-500
text-white
flex
items-center
justify-center
font-bold
">


                                                {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}


                                            </div>





                                            <div
                                                class="
    bg-white
    dark:bg-neutral-900
    rounded-2xl
    px-4
    py-3
    flex-1
    border
    border-gray-100
    dark:border-neutral-800
    ">


                                                <div class="flex items-start justify-between gap-3">


                                                    <div class="flex-1">


                                                        <p class="font-bold text-sm dark:text-white">
                                                            {{ $comment->user->name ?? 'User' }}
                                                        </p>


                                                        <p
                                                            class="
                text-sm
                text-gray-700
                dark:text-gray-300
                mt-1
                break-words
            ">
                                                            {{ $comment->comment }}
                                                        </p>


                                                        <div
                                                            class="
                flex
                items-center
                gap-3
                mt-2
            ">

                                                            <p class="text-xs text-gray-400">
                                                                {{ $comment->created_at->diffForHumans() }}
                                                            </p>


                                                            @if (auth()->id() === $comment->user_id)
                                                                <form
                                                                    action="{{ route('comments.destroy', $comment) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Delete this comment?');">

                                                                    @csrf
                                                                    @method('DELETE')


                                                                    <button
                                                                        class="
                            text-xs
                            text-red-500
                            hover:text-red-700
                            font-semibold
                            transition
                            ">

                                                                        Delete

                                                                    </button>


                                                                </form>
                                                            @endif


                                                        </div>


                                                    </div>


                                                </div>


                                            </div>


                                        </div>



                                    @empty


                                        <p class="text-gray-500 text-sm">

                                            No comments yet.

                                        </p>
                                    @endforelse


                                </div>



                            </div>



                        </article>


                    @empty


                        <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
p-8
text-center
">

                            <h2 class="font-black text-xl">

                                No requests yet

                            </h2>

                            <p class="text-gray-500">

                                Be the first person looking for a product.

                            </p>


                        </div>


                    @endforelse




                    {{ $posts->links() }}



                </main>





                {{-- RIGHT SIDEBAR --}}

                <aside class="hidden xl:block xl:col-span-3">


                    <div class="sticky top-24 space-y-6">



                        {{-- TRENDING PRODUCTS --}}

                        <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-5
">


                            <h2 class="font-black text-xl mb-5">

                                🔥 Trending Products

                            </h2>



                            @forelse($trendingProducts ?? [] as $product)
                                <div class="flex gap-3 mb-5">


                                    @if ($product->image)
                                        <img src="{{ asset('storage/products/' . $product->image) }}"
                                            class="
w-16
h-16
rounded-xl
object-cover
">
                                    @else
                                        <div
                                            class="
w-16
h-16
rounded-xl
bg-gray-200
flex
items-center
justify-center
">

                                            📦

                                        </div>
                                    @endif



                                    <div>

                                        <h3 class="font-bold text-sm">

                                            {{ Str::limit($product->title, 25) }}

                                        </h3>


                                        <p class="text-orange-500 font-bold">

                                            AED {{ number_format($product->price) }}

                                        </p>


                                        @if ($product->shop)
                                            <p class="text-xs text-gray-500">

                                                🏪 {{ $product->shop->name }}

                                            </p>
                                        @endif


                                    </div>


                                </div>


                            @empty


                                <p class="text-gray-500">

                                    No trending products

                                </p>
                            @endforelse


                        </div>

                        {{-- NEARBY STORES --}}

                        <div class="
bg-white
dark:bg-neutral-900
rounded-3xl
shadow-xl
p-5
">

                            <h2 class="font-black text-xl mb-5">

                                📍 Nearby Stores

                            </h2>


                            @forelse($shops ?? [] as $shop)
                                <div class="
flex
items-center
gap-3
mb-5
">


                                    @if ($shop->logo)
                                        <img src="{{ Storage::url($shop->logo) }}"
                                            class="
w-12
h-12
rounded-full
object-cover
">
                                    @else
                                        <div
                                            class="
w-12
h-12
rounded-full
bg-orange-500
text-white
flex
items-center
justify-center
font-black
">

                                            {{ strtoupper(substr($shop->name, 0, 1)) }}

                                        </div>
                                    @endif



                                    <div>

                                        <h3 class="
font-bold
dark:text-white
">

                                            {{ $shop->name }}

                                        </h3>


                                        <p class="
text-xs
text-gray-500
">

                                            Nearby seller

                                        </p>


                                    </div>


                                </div>


                            @empty


                                <p class="text-gray-500 text-sm">

                                    No stores available.

                                </p>
                            @endforelse


                        </div>






                        {{-- SELL CARD --}}

                        <div class="
rounded-3xl
bg-gradient-to-br
from-orange-500
to-red-500
p-6
text-white
">


                            <h2 class="
text-2xl
font-black
">

                                Sell Products

                            </h2>


                            <p class="mt-2">

                                Open your shop and reach more buyers.

                            </p>


                            <a href="{{ route('shop.create', 1) }}"
                                class="
inline-block
mt-5
bg-white
text-black
px-6
py-3
rounded-full
font-bold
">

                                Create Shop

                            </a>


                        </div>



                    </div>


                </aside>




            </div>

        </div>

    </div>






    {{-- LIKE SCRIPT --}}

    <script>
        document.addEventListener("DOMContentLoaded", () => {


            document.querySelectorAll('.like-btn')
                .forEach(button => {


                    button.addEventListener('click', () => {


                        let id = button.dataset.id;



                        fetch(`/posts/${id}/like`, {


                                method: 'POST',


                                headers: {


                                    'X-CSRF-TOKEN': document
                                        .querySelector('meta[name="csrf-token"]')
                                        .content,


                                    'Accept': 'application/json'


                                }


                            })
                            .then(response => response.json())

                            .then(data => {


                                let counter =
                                    document.getElementById(`count-${id}`);



                                if (counter) {

                                    counter.innerHTML = data.count;

                                }


                            });


                    });


                });



        });
    </script>





    <x-main-footer />

</x-main-layout>
