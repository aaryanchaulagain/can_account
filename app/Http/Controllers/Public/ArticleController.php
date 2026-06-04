<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleRepositoryInterface $articles,
        protected SeoService $seo
    ) {}

    public function index(Request $request): View
    {
        $search = $request->get('q');
        $category = $request->get('category');

        return view('public.articles.index', [
            'seo' => $this->seo->meta('Insights & Articles', 'Expert insights on taxation, accounting, SMSF and business advisory from Canberra Accountants.'),
            'articles' => $this->articles->paginatePublished(12, $search, $category),
            'categories' => ArticleCategory::withCount('articles')->get(),
            'search' => $search,
            'activeCategory' => $category,
        ]);
    }

    public function show(string $slug): View
    {
        $article = $this->articles->findBySlug($slug);
        abort_unless($article, 404);

        $article->increment('views_count');

        return view('public.articles.show', [
            'seo' => $this->seo->meta(
                $article->meta_title ?? $article->title,
                $article->meta_description ?? $article->excerpt,
                $article->featured_image_url,
                route('articles.show', $article->slug),
                'article'
            ),
            'article' => $article,
            'related' => $this->articles->getRelated($article),
        ]);
    }
}
