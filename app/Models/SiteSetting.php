<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type'];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("site_setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting?->value ?? $default;
        });
    }

    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'type' => $type]
        );
        Cache::forget("site_setting.{$key}");
        Cache::forget('site_settings.all');
    }

    public static function allCached(): array
    {
        return Cache::remember('site_settings.all', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }
}
