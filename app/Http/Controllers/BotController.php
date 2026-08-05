<?php

namespace App\Http\Controllers;

use App\Models\Knowledge;
use Illuminate\Http\Request;

class BotController extends Controller
{
    // Show bot page
    public function index()
    {
        $title = 'murwaj';
        $description = 'murwaj is an advertising group, to help your business grow through digital marketing.';
        $keywords = 'murwaj.com. buy electronics, computers, apparel, fashion accessories, shoes, watches, furniture, home and kitchen goods, beauty, personal care, grocery, gourmet food.';

        return view('bot.ai')->with(compact('title', 'description', 'keywords'));
    }

    // Handle chat message
    public function chat(Request $request)
    {
        $input = strtolower($request->message);

        $items = Knowledge::all();

        $best = null;
        $score = 0;

        foreach ($items as $item) {

            similar_text(
                $input,
                strtolower($item->question),
                $percent
            );

            if ($percent > $score) {

                $score = $percent;
                $best = $item;

            }
        }

        if ($best && $score > 40) {

            return response()->json([
                'reply' => $best->answer,
            ]);

        }

        return response()->json([
            'reply' => "Sorry, I couldn't find an answer.",
        ]);
    }
}
