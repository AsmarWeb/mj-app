<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AIController extends Controller
{
    public function shopDescription(Request $request)
    {
        $validated = $request->validate([
            'section' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'locale' => ['nullable', 'in:ar,en'],
        ]);

        $locale = $validated['locale'] ?? app()->getLocale();

        if ($locale === 'ar') {
            $description = $this->arabicDescription(
                $validated['section'],
                $validated['city'],
                $validated['state'],
                $validated['country']
            );
        } else {
            $description = $this->englishDescription(
                $validated['section'],
                $validated['city'],
                $validated['state'],
                $validated['country']
            );
        }

        return response()->json([
            'description' => $description,
        ]);
    }

    private function englishDescription(
        string $section,
        string $city,
        string $state,
        string $country
    ): string {
        return "Welcome to our {$section} shop in {$city}, {$state}, {$country}. "
            . "We offer quality products, competitive prices, and reliable service. "
            . "Our goal is to provide you with a smooth and enjoyable shopping experience. "
            . "Discover our products and contact us today to find exactly what you need.";
    }

    private function arabicDescription(
        string $section,
        string $city,
        string $state,
        string $country
    ): string {
        return "مرحباً بكم في متجرنا المتخصص في {$section} في {$city}، {$state}، {$country}. "
            . "نقدم لكم منتجات عالية الجودة، وأسعاراً تنافسية، وخدمة موثوقة. "
            . "نحرص على توفير تجربة تسوق سهلة ومميزة تلبي احتياجاتكم. "
            . "اكتشفوا منتجاتنا وتواصلوا معنا اليوم للعثور على ما تحتاجونه.";
    }
}