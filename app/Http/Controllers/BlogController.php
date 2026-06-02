<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')
            ->when(request('search'), function ($query) {
                $query->where('title', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('blogs.create', compact('categories'));
    }

    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['author_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request
                ->file('featured_image')
                ->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();

        return view('blogs.edit', compact('blog', 'categories'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['title'], $blog->id);

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            $data['featured_image'] = $request
                ->file('featured_image')
                ->store('blogs', 'public');
        } else {
            unset($data['featured_image']);
        }

        $blog->update($data);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return back()
            ->with('success', 'Deleted');
    }

    protected function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Blog::query()
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
