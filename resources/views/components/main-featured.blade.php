<section>
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">featured
            <span class="underline decoration-orange-500">Products</span>
        </h1>


        <div x-data="swipeCards()" x-init="let isDown = false;
        let startX;
        let scrollLeft;
        $el.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - $el.offsetLeft;
            scrollLeft = $el.scrollLeft;
        });
        $el.addEventListener('mouseleave', () => {
            isDown = false;
        });
        $el.addEventListener('mouseup', () => {
            isDown = false;
        });
        $el.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - $el.offsetLeft;
            const walk = (x - startX) * 1;
            $el.scrollLeft = scrollLeft - walk;
        });"
            class="overflow-x-scroll scrollbar-hide mb-4 relative px-0.5 mt-8" style="overflow-y: hidden;">
            <div class="flex snap-x snap-mandatory gap-4" style="width: max-content;">
                <template x-for="card in cards" :key="card.id">
                    <div class="flex-none w-64 snap-center">
                        <div class="bg-white border-1 border border-gray-200 rounded-lg overflow-hidden mb-4">
                            <img :src="card.image" alt="" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" x-text="card.title"></h3>
                                <p class="text-gray-600 mt-2 text-sm" x-text="card.description"></p>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-2xl font-extrabold text-gray-900"
                                        x-text="'$' + card.price.toFixed(2)"></span>
                                    <a :href="card.link"
                                        class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <script>
            function swipeCards() {
                return {
                    cards: [{
                            id: 1,
                            image: `https://loremflickr.com/300/200/${encodeURIComponent('grape')}`,
                            title: 'Cocktail',
                            description: 'Tropical mix of flavors, perfect for parties.',
                            price: 8.99,
                            link: 'https://lqrs.com'
                        },
                        {
                            id: 2,
                            image: `https://loremflickr.com/300/200/${encodeURIComponent('apple')}`,
                            title: 'Smoothie',
                            description: 'Refreshing blend of fruits and yogurt.',
                            price: 5.49,
                            link: 'https://lqrs.com'
                        },
                        {
                            id: 3,
                            image: `https://loremflickr.com/300/200/${encodeURIComponent('banana')}`,
                            title: 'Iced Coffee',
                            description: 'Cold brewed coffee with a hint of vanilla.',
                            price: 4.99,
                            link: 'https://lqrs.com'
                        },
                        {
                            id: 4,
                            image: `https://loremflickr.com/300/200/${encodeURIComponent('berry')}`,
                            title: 'Mojito',
                            description: 'Classic Cuban cocktail with mint and lime.',
                            price: 7.99,
                            link: 'https://lqrs.com'
                        },
                        {
                            id: 5,
                            image: `https://loremflickr.com/300/200/${encodeURIComponent('orange')}`,
                            title: 'Matcha Latte',
                            description: 'Creamy green tea latte, rich in antioxidants.',
                            price: 6.49,
                            link: 'https://lqrs.com'
                        },
                        {
                            id: 6,
                            image: `https://loremflickr.com/300/200/${encodeURIComponent('peach')}`,
                            title: 'Fruit Punch',
                            description: 'Sweet and tangy punch, bursting with fruity flavors.',
                            price: 3.99,
                            link: 'https://lqrs.com'
                        },
                        {
                            id: 7,
                            image: `https://loremflickr.com/300/200/${encodeURIComponent('cherry')}`,
                            title: 'Bubble Tea',
                            description: 'Chewy tapioca pearls in a sweet milk tea base.',
                            price: 4.99,
                            link: 'https://lqrs.com'
                        }
                    ],
                    addToCart(product) {
                        // Implement your add to cart logic here
                        console.log('Adding to cart:', product);
                    }
                };
            }
        </script>
        <!-- Grid card on mobile screen -->
        {{-- <div class="gap-8 mt-8 xl:mt-12 xl:gap-12 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-5 md:hidden">

        </div> --}}
    </div>
</section>
