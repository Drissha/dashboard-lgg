<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->when(request('search'), function ($query) {
                $query->where(
                    'name',
                    'like',
                    '%' . request('search') . '%'
                );
            })
            ->latest()
            ->paginate(10);

        return view(
            'products.index',
            compact('products')
        );
    }

    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('products.create', compact('categories', 'subCategories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view(
            'products.edit',
            compact('product', 'categories', 'subCategories')
        );
    }

    public function update(
        UpdateProductRequest $request,
        Product $product
    ) {

        $data = $request->validated();

        if ($request->hasFile('image')) {

            if ($product->image) {

                Storage::disk('public')
                    ->delete($product->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {

            Storage::disk('public')
                ->delete($product->image);
        }

        $product->delete();

        return back()
            ->with('success', 'Deleted');
    }
}