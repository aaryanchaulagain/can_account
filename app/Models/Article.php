<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'article_category_id', 'author_id', 'title', 'slug', 'excerpt', 'content',
        'featured_image', 'meta_title', 'meta_description', 'published_at',
        'is_published', 'is_featured', 'views_count',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });

        static::saving(function (Article $article) {
            if ($article->is_published && empty($article->published_at)) {
                $article->published_at = now();
            }
            if (! $article->is_published) {
                $article->published_at = null;
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ArticleTag::class, 'article_article_tag');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where(function (Builder $q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? Storage::url($this->featured_image) : null;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
