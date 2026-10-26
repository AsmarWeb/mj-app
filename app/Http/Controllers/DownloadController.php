<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Services\Digital\DigitalFiles;

class DownloadController extends Controller
{
    public function download($token)
    {
        $download = Download::with('product')
            ->where('token', $token)
            ->firstOrFail();

        abort_unless((int) $download->user_id === (int) auth()->id() && $download->paid, 403);

        $product = $download->product;

        if (! $product) {
            abort(404);
        }

        $product->increment('downloads');

        return app(DigitalFiles::class)->download($product);
    }
}
