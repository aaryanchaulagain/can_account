<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'slug', 'designation', 'photo', 'qualifications', 'biography',
        'linkedin_url', 'email', 'phone', 'is_featured', 'is_leadership',
        'sort_order', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_leadership' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (TeamMember $member) {
            if (empty($member->slug)) {
                $member->slug = Str::slug($member->name);
            }
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
