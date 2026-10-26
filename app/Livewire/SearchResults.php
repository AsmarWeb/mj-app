<?php

namespace App\Livewire;

use App\Models\DigitalProduct;
use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class SearchResults extends Component
{
    use WithPagination;

    public $search = '';

    public $globalSearchUrl = null;

    protected $paginationTheme = 'tailwind';

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
    ];

    public function mount()
    {
        $search = request('q', request('search', ''));
        $this->search = is_string($search) ? mb_substr($search, 0, 200) : '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->search = is_string($this->search) ? mb_substr($this->search, 0, 200) : '';
        /*
        |--------------------------------------------------------------------------
        | Marketplace Listings
        |--------------------------------------------------------------------------
        */

        $listings = Listing::query()->active()
            ->where('status', 'published')
            ->when($this->search, function ($query) {

                $query->where(function ($q) {

                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('title_ar', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%')
                        ->orWhereJsonContains('keywords', $this->search);
                });
            })
            ->with([
                'brand',
                'category',
                'shop',
            ])
            ->latest()
            ->paginate(12);

        /*
        |--------------------------------------------------------------------------
        | Digital Products
        |--------------------------------------------------------------------------
        */

        $digitalProducts = DigitalProduct::query()
            ->where('status', 'published')
            ->when($this->search, function ($query) {

                $query->where(function ($q) {

                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%');
                });
            })
            ->with([
                'supplier',
            ])
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Global Search
        |--------------------------------------------------------------------------
        */

        if (
            $listings->total() == 0 &&
            $digitalProducts->count() == 0 &&
            ! empty($this->search)
        ) {

            $this->globalSearchUrl =
                'https://www.google.com/search?q='.
                urlencode($this->search);
        } else {

            $this->globalSearchUrl = null;
        }

        return view('livewire.search-results', [

            'listings' => $listings,

            'digitalProducts' => $digitalProducts,

            'globalSearchUrl' => $this->globalSearchUrl,

        ]);
    }
}
