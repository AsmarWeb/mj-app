<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceSection extends Component
{
    public function render()
    {
        $services = Service::inRandomOrder()->with('shop')->get()->take(3);

        return view('livewire.service.service-section', ['services' => $services]);
    }
}
