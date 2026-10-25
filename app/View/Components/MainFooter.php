<?php

namespace App\View\Components;

use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainFooter extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $setting = Setting::find(1) ?? new Setting;

        return view('components.main-footer', ['setting' => $setting]);
    }
}
