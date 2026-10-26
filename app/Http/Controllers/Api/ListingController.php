<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListingIndexRequest;
use App\Http\Resources\ListingResource;
use App\Services\Catalog\PublicCatalog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class ListingController extends Controller
{
    public function index(ListingIndexRequest $request, PublicCatalog $catalog): AnonymousResourceCollection
    {
        $input = $request->validated();

        return ListingResource::collection($catalog->listingFilters($catalog->listings(), $input)
            ->paginate($input['per_page'] ?? 20)->appends(Arr::except($input, ['page'])));
    }

    public function show(string $slug, PublicCatalog $catalog): ListingResource
    {
        return new ListingResource($catalog->listings()->where('slug', $slug)->firstOrFail());
    }

    public function forShop(ListingIndexRequest $request, string $slug, PublicCatalog $catalog): AnonymousResourceCollection
    {
        $shop = $catalog->shops()->where('slug', $slug)->firstOrFail();
        $input = $request->validated();
        // The URL binds the store; a caller-supplied shop_id cannot broaden the query.
        $input['shop_id'] = $shop->id;

        return ListingResource::collection($catalog->listingFilters($catalog->listings(), $input)
            ->paginate($input['per_page'] ?? 20)->appends(Arr::except($input, ['page', 'shop_id'])));
    }
}
