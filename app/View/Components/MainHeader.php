<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainHeader extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $setting = Setting::find(1);
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 'active')->inRandomOrder()->get()->take(12);
        return view('components.main-header', ['setting' => $setting, 'categories' => $categories]);
    }
}
