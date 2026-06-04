<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(protected ArticleRepositoryInterface $articles) {}

    public function index(): View
    {
        $articles = Article::latest()->paginate(15);

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        return view('admin.articles.form', [
            'article' => new Article,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateArticle($request);
        $data = $this->prepareArticleData($request, $data);
        $data['author_id'] = $request->user()->id;

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $this->articles->create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Insight saved successfully.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.form', [
            'article' => $article,
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $this->validateArticle($request);
        $data = $this->prepareArticleData($request, $data);

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $this->articles->update($article, $data);

        return redirect()->route('admin.articles.index')->with('success', 'Insight updated successfully.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->authorize('delete', $article);
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }
        $this->articles->delete($article);

        return redirect()->route('admin.articles.index')->with('success', 'Insight deleted.');
    }

    protected function validateArticle(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    protected function prepareArticleData(Request $request, array $data): array
    {
        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);
        $data['is_published'] = $data['status'] === 'published';
        $data['meta_title'] = $data['title'];
        $data['meta_description'] = Str::limit(strip_tags($data['content']), 160);
        $data['excerpt'] = Str::limit(strip_tags($data['content']), 200);

        if ($data['is_published']) {
            $data['published_at'] = ! empty($data['published_at'])
                ? Carbon::parse($data['published_at'])->startOfDay()
                : now();
        } else {
            $data['published_at'] = null;
        }

        unset($data['status']);

        return $data;
    }
}
