<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class SearchResults extends Component
{
    use WithPagination;

    public $search = '';

    public $globalSearchUrl;

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
        $listings = Listing::query()

            ->where('status', 'published')

            ->where(function ($query) {

                if ($this->search) {

                    $query->where('title', 'like', "%{$this->search}%")
                        ->orWhere('title_ar', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%")
                        ->orWhereJsonContains('keywords', $this->search);

                }

            })

            ->with([
                'brand',
                'category',
                'shop',
            ])

            ->latest()

            ->paginate(20);

        // Create global search link
        if ($listings->total() == 0 && $this->search) {

            $this->globalSearchUrl =
                'https://www.google.com/search?q='
                .urlencode($this->search);

        } else {

            $this->globalSearchUrl = null;

        }

        return view('livewire.search-results', [

            'listings' => $listings,

        ]);
    }
}
