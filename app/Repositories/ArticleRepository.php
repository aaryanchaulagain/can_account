<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function paginatePublished(int $perPage = 12, ?string $search = null, ?string $categorySlug = null): LengthAwarePaginator
    {
        $query = Article::published()
            ->with(['category', 'author', 'tags'])
            ->latest('published_at');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($categorySlug) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
        }

        return $query->paginate($perPage);
    }

    public function findBySlug(string $slug): ?Article
    {
        return Article::published()
            ->with(['category', 'author', 'tags'])
            ->where('slug', $slug)
            ->first();
    }

    public function getRelated(Article $article, int $limit = 3): Collection
    {
        return Article::published()
            ->where('id', '!=', $article->id)
            ->when($article->article_category_id, fn ($q) => $q->where('article_category_id', $article->article_category_id))
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }

    public function getLatest(int $limit = 3): Collection
    {
        return Article::published()
            ->with('category')
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }

    public function create(array $data): Article
    {
        $article = Article::create($data);
        if (! empty($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return $article->load(['category', 'author', 'tags']);
    }

    public function update(Article $article, array $data): Article
    {
        $article->update($data);
        if (array_key_exists('tags', $data)) {
            $article->tags()->sync($data['tags'] ?? []);
        }

        return $article->fresh(['category', 'author', 'tags']);
    }

    public function delete(Article $article): bool
    {
        $article->tags()->detach();

        return (bool) $article->delete();
    }
}
