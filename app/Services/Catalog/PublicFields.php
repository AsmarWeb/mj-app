<?php

namespace App\Services\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PublicFields
{
    public static function reference(Model $model, string $name = 'name', string $arabicName = 'name_ar'): array
    {
        return ['id' => $model->getKey(), 'name' => $model->getAttribute($name),
            'name_ar' => $model->getAttribute($arabicName), 'slug' => $model->getAttribute('slug')];
    }

    public static function path(mixed $value): ?string
    {
        if (! is_string($value) || $value === '' || strlen($value) > 1024 || str_starts_with($value, '/')
            || preg_match('/[\\\\:%?#\x00-\x1F\x7F]/', $value)) {
            return null;
        }
        foreach (explode('/', $value) as $segment) {
            if (in_array($segment, ['', '.', '..'], true)) {
                return null;
            }
        }

        return $value;
    }

    public static function media(mixed $value, string $directory = ''): ?string
    {
        $path = self::path($value);

        return $path === null ? null : Storage::disk('public')->url(implode('/', array_map('rawurlencode', explode('/', $directory.$path))));
    }

    public static function strings(mixed $values, int $count, int $length): array
    {
        return array_values(array_map(fn ($v) => mb_substr($v, 0, $length),
            array_slice(array_filter(is_array($values) ? $values : [], 'is_string'), 0, $count)));
    }
}
