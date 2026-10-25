<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShopIndexRequest;
use App\Http\Resources\ShopResource;
use App\Services\Catalog\PublicCatalog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class ShopController extends Controller
{
    public function index(ShopIndexRequest $request, PublicCatalog $catalog): AnonymousResourceCollection
    {
        $input = $request->validated();

        return ShopResource::collection($catalog->shopFilters($catalog->shops()->with(['section', 'country', 'state', 'city']), $input)
            ->paginate($input['per_page'] ?? 20)->appends(Arr::except($input, ['page'])));
    }

    public function show(string $slug, PublicCatalog $catalog): ShopResource
    {
        $shop = $catalog->shops()->with(['section', 'country', 'state', 'city'])->where('slug', $slug)->firstOrFail();
        // Preserve a bounded preview for existing consumers. Full results have a paginated endpoint.
        $preview = $catalog->listings()->where('shop_id', $shop->id)->latest('id')->limit(10)->get();
        $shop->setRelation('listings', $preview);

        return new ShopResource($shop);
    }
}
