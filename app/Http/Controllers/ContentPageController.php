<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreContentPageRequest;
use App\Http\Requests\UpdateContentPageRequest;

class ContentPageController extends Controller
{
    public function index()
    {
        $pages = ContentPage::query()
            ->when(request('search'), function ($query) {

                $query->where(
                    'title',
                    'like',
                    '%' . request('search') . '%'
                );
            })
            ->latest()
            ->paginate(10);

        return view(
            'content-pages.index',
            compact('pages')
        );
    }

    public function create()
    {
        return view('content-pages.create');
    }

    public function store(
        StoreContentPageRequest $request
    ) {

        $data = $request->validated();

        if ($request->hasFile('featured_image')) {

            $data['featured_image'] = $request
                ->file('featured_image')
                ->store('pages', 'public');
        }

        ContentPage::create($data);

        return redirect()
            ->route('content-pages.index');
    }

    public function edit(ContentPage $content_page)
    {
        return view(
            'content-pages.edit',
            compact('content_page')
        );
    }

    public function update(
        UpdateContentPageRequest $request,
        ContentPage $content_page
    ) {

        $data = $request->validated();

        if ($request->hasFile('featured_image')) {

            if ($content_page->featured_image) {

                Storage::disk('public')
                    ->delete(
                        $content_page->featured_image
                    );
            }

            $data['featured_image'] = $request
                ->file('featured_image')
                ->store('pages', 'public');
        }

        $content_page->update($data);

        return redirect()
            ->route('content-pages.index');
    }

    public function destroy(ContentPage $content_page)
    {
        $content_page->delete();

        return back();
    }
}