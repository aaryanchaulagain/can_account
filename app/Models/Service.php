<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title', 'slug', 'short_description', 'icon', 'hero_image', 'overview',
        'benefits', 'process_steps', 'faqs', 'meta_title', 'meta_description',
        'sort_order', 'is_published', 'show_in_nav',
    ];

    protected function casts(): array
    {
        return [
            'benefits' => 'array',
            'process_steps' => 'array',
            'faqs' => 'array',
            'is_published' => 'boolean',
            'show_in_nav' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeInNav(Builder $query): Builder
    {
        return $query->where('show_in_nav', true);
    }

    public function getHeroImageUrlAttribute(): ?string
    {
        return $this->hero_image ? Storage::url($this->hero_image) : null;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
