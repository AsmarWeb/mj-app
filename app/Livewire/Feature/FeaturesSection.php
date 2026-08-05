<?php

namespace App\Livewire\Feature;

use App\Models\Feature;
use Livewire\Component;

class FeaturesSection extends Component
{
    public function render()
    {
        $features = Feature::get()->take(3);

        return view('livewire.feature.features-section', ['features' => $features]);
    }
}
