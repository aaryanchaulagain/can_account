<?php

namespace App\Repositories\Contracts;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ArticleRepositoryInterface
{
    public function paginatePublished(int $perPage = 12, ?string $search = null, ?string $categorySlug = null): LengthAwarePaginator;

    public function findBySlug(string $slug): ?Article;

    public function getRelated(Article $article, int $limit = 3): Collection;

    public function getLatest(int $limit = 3): Collection;

    public function create(array $data): Article;

    public function update(Article $article, array $data): Article;

    public function delete(Article $article): bool;
}
