@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Products</h1>
    <a href="{{ route('products.create') }}" class="btn">
        + Add Product
    </a>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search products..."
                class="flex-1">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>
</div>

<div class="card overflow-hidden">

    <table class="w-full">

        <thead>

        <tr class="border-b">

            <th class="p-4 text-left">
                Image
            </th>

            <th class="p-4 text-left">
                Name
            </th>
            
            <th class="p-4 text-left">
                Category
            </th>

            <th class="p-4 text-left">
                Sub Category
            </th>

            <th class="p-4 text-left">
                Price
            </th>

            <th class="p-4 text-left">
                Status
            </th>

            <th class="p-4">
                Action
            </th>

        </tr>

        </thead>

        <tbody>

        @foreach($products as $product)

            <tr class="border-b">

                <td class="p-4">

                    @if($product->image)

                        <img
                            src="{{ Storage::url($product->image) }}"
                            class="w-14 h-14 object-cover rounded-lg">

                    @endif

                </td>

                <td class="p-4">
                    {{ $product->name }}
                </td>
                
                <td class="p-4">
                    {{ $product->category->name ?? '-' }}
                </td>

                <td class="p-4">
                    {{ $product->subCategory->name ?? '-' }}
                </td>

                <td class="p-4">
                    Rp {{ number_format($product->price) }}
                </td>

                <td class="p-4">

                    @if($product->status)

                        Active

                    @else

                        Inactive

                    @endif

                </td>

                <td class="p-4">

                    <div class="flex gap-2">

                        <a
                            href="{{ route('products.edit',$product) }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg">

                            Edit

                        </a>

                        <form
                            action="{{ route('products.destroy',$product) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete ?')"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg">

                                Delete

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

<div class="mt-6">

    {{ $products->links() }}

</div>

@endsection