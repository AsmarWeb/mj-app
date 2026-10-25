<?php

namespace App\Services\Catalog;

use App\Models\Listing;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Builder;

class PublicCatalog
{
    public const RELATIONS = ['shop.section', 'shop.country', 'shop.state', 'shop.city',
        'category', 'section', 'brand', 'subcategory'];

    public function shops(): Builder
    {
        return Shop::query()->publicCatalog();
    }

    public function visibleListings(): Builder
    {
        return Listing::query()->active();
    }

    public function listings(): Builder
    {
        return $this->visibleListings()->with(self::RELATIONS)
            ->withAvg(['reviews as catalog_rating' => fn ($q) => $q->where('approved', true)], 'rating');
    }

    public function listingFilters(Builder $query, array $input): Builder
    {
        if (isset($input['q']) && $input['q'] !== '') {
            $like = $this->literalLike($input['q']);
            $query->where(fn ($q) => $q->whereRaw("title LIKE ? ESCAPE '!'", [$like])
                ->orWhereRaw("title_ar LIKE ? ESCAPE '!'", [$like]));
        }
        foreach (['shop_id', 'category_id', 'section_id'] as $field) {
            if (isset($input[$field])) {
                $query->where('listings.'.$field, $input[$field]);
            }
        }
        foreach (['state_id', 'city_id'] as $field) {
            if (isset($input[$field])) {
                $query->whereHas('shop', fn ($q) => $q->where($field, $input[$field]));
            }
        }
        if (isset($input['currency'])) {
            $query->whereHas('shop', fn ($q) => $q->where('currency', $input['currency']));
        }
        if (isset($input['in_stock']) && (bool) $input['in_stock']) {
            $query->where('quantity', '>', 0);
        }
        if (isset($input['min_price'])) {
            $query->whereRaw('CAST(listings.price AS DECIMAL(12,2)) >= ?', [$input['min_price']]);
        }
        if (isset($input['max_price'])) {
            $query->whereRaw('CAST(listings.price AS DECIMAL(12,2)) <= ?', [$input['max_price']]);
        }

        return match ($input['sort'] ?? 'newest') {
            'oldest' => $query->orderBy('listings.id'),
            'price_asc' => $query->orderByRaw('CAST(listings.price AS DECIMAL(12,2)) ASC')->orderBy('listings.id'),
            'price_desc' => $query->orderByRaw('CAST(listings.price AS DECIMAL(12,2)) DESC')->orderBy('listings.id'),
            default => $query->orderByDesc('listings.id'),
        };
    }

    public function shopFilters(Builder $query, array $input): Builder
    {
        if (isset($input['q']) && $input['q'] !== '') {
            $like = $this->literalLike($input['q']);
            $query->where(fn ($q) => $q->whereRaw("name LIKE ? ESCAPE '!'", [$like])
                ->orWhereRaw("name_ar LIKE ? ESCAPE '!'", [$like]));
        }
        foreach (['section_id', 'country_id', 'state_id', 'city_id'] as $field) {
            if (isset($input[$field])) {
                $query->where($field, $input[$field]);
            }
        }
        if (isset($input['verified']) && (bool) $input['verified']) {
            $query->where('verified', true);
        }

        return ($input['sort'] ?? 'newest') === 'oldest' ? $query->orderBy('id') : $query->orderByDesc('id');
    }

    private function literalLike(string $value): string
    {
        return '%'.str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $value).'%';
    }
}
