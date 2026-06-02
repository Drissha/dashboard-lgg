<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::query()
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10);

        return view('promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('promotions.create');
    }

    public function store(StorePromotionRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('images')) {
            $data['images'] = collect($request->file('images'))
                ->map(fn ($image) => $image->store('promotions', 'public'))
                ->values()
                ->all();
        }

        Promotion::create($data);

        return redirect()
            ->route('promotions.index')
            ->with('success', 'Promotion created');
    }

    public function edit(Promotion $promotion)
    {
        return view('promotions.edit', compact('promotion'));
    }

    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $data = $request->validated();

        if ($request->hasFile('images')) {
            if (! empty($promotion->images)) {
                foreach ($promotion->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $data['images'] = collect($request->file('images'))
                ->map(fn ($image) => $image->store('promotions', 'public'))
                ->values()
                ->all();
        } else {
            unset($data['images']);
        }

        $promotion->update($data);

        return redirect()
            ->route('promotions.index')
            ->with('success', 'Promotion updated');
    }

    public function destroy(Promotion $promotion)
    {
        if (! empty($promotion->images)) {
            foreach ($promotion->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $promotion->delete();

        return back()
            ->with('success', 'Deleted');
    }
}
