<div>

    @auth

        @if (auth()->id() != $shop->user_id)
            <div class="bg-white rounded-xl shadow p-6 mb-8">

                <h2 class="font-bold text-xl mb-4">

                    Rate this shop

                </h2>

                <div class="flex gap-2 mb-4">

                    @for ($i = 1; $i <= 5; $i++)
                        <button wire:click="$set('rating',{{ $i }})" type="button" class="text-3xl">

                            {{ $rating >= $i ? '⭐' : '☆' }}

                        </button>
                    @endfor

                </div>

                <textarea wire:model="review" rows="4" class="w-full rounded-xl border" placeholder="Share your experience"></textarea>

                <button wire:click="save" class="mt-4 bg-orange-500 text-white px-6 py-3 rounded-xl">

                    Submit Review

                </button>

            </div>
        @endif

    @endauth

    <div class="space-y-6">

        @forelse($reviews as $review)

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex justify-between">

                    <div>

                        <h3 class="font-bold">

                            {{ $review->user->name }}

                        </h3>

                        <div>

                            @for ($i = 1; $i <= 5; $i++)
                                {{ $review->rating >= $i ? '⭐' : '☆' }}
                            @endfor

                        </div>

                    </div>

                    <small>

                        {{ $review->created_at->diffForHumans() }}

                    </small>

                </div>

                @if ($review->review)
                    <p class="mt-4">

                        {{ $review->review }}

                    </p>
                @endif

            </div>

        @empty

            <div class="bg-white rounded-xl shadow p-10 text-center">

                No reviews yet.

            </div>

        @endforelse

    </div>

    <div class="mt-6">

        {{ $reviews->links() }}

    </div>

</div>
