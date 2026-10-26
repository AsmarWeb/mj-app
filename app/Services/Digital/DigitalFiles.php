<?php

namespace App\Services\Digital;

use App\Models\DigitalProduct;
use Illuminate\Support\Facades\Storage;

class DigitalFiles
{
    public function validPath(mixed $path): bool
    {
        return is_string($path) && $path !== '' && ! str_starts_with($path, '/')
            && ! str_contains($path, '\\') && ! str_contains($path, ':') && ! str_contains($path, "\0")
            && ! in_array('..', explode('/', $path), true);
    }

    public function download(DigitalProduct $product)
    {
        abort_unless($this->validPath($product->file) && Storage::disk('digital')->exists($product->file), 404);

        return Storage::disk('digital')->download($product->file, basename($product->file), [
            'Cache-Control' => 'private, no-store', 'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function secure(DigitalProduct $product): void
    {
        $path = $product->file;
        if (! $this->validPath($path)) {
            throw new \RuntimeException('Invalid file path');
        }
        $public = Storage::disk('public');
        $private = Storage::disk('digital');
        if (! $public->exists($path)) {
            if (! $private->exists($path)) {
                throw new \RuntimeException('File missing');
            }

            return;
        }
        // Do not remove the public copy until a byte-identical private copy exists.
        if (! $private->exists($path)) {
            $stream = $public->readStream($path);
            try {
                if (! is_resource($stream) || ! $private->put($path, $stream)) {
                    throw new \RuntimeException('Copy failed');
                }
            } finally {
                if (is_resource($stream)) {
                    fclose($stream);
                }
            }
        }
        $sourceHash = hash_file('sha256', $public->path($path));
        $privateHash = hash_file('sha256', $private->path($path));
        if (! is_string($sourceHash) || ! is_string($privateHash) || ! hash_equals($sourceHash, $privateHash)) {
            throw new \RuntimeException('Private copy differs; original retained');
        }
        if (! $public->delete($path)) {
            throw new \RuntimeException('Public copy could not be removed');
        }
    }
}
