<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainCategory extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 'active')->inRandomOrder()->get()->take(12);

        return view('components.main-category', ['categories' => $categories]);
    }
}
