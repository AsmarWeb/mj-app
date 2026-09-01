<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Models\Shop;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShopController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $shops = Shop::query()
            ->with([
                'section',
                'country',
                'state',
                'city',
            ])
            ->where('is_active', true)
            ->published()
            ->get();

        return ShopResource::collection($shops);
    }

    public function show(string $slug): ShopResource
    {
        $shop = Shop::query()
            ->with([
                'section',
                'country',
                'state',
                'city',
                'listings',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->published()
            ->firstOrFail();

        return new ShopResource($shop);
    }
}
