<?php

namespace App\Livewire;

use App\Models\Listing;
use App\Models\DigitalProduct;
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
        $this->search = request('search', '');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        /*
        |--------------------------------------------------------------------------
        | Marketplace Listings
        |--------------------------------------------------------------------------
        */

        $listings = Listing::query()
            ->where('status', 'published')
            ->when($this->search, function ($query) {

                $query->where(function ($q) {

                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('title_ar', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
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

                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');

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
            !empty($this->search)
        ) {

            $this->globalSearchUrl =
                'https://www.google.com/search?q=' .
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