<x-input
    label="Product Name"
    name="name"
    :value="old('name',$product->name ?? '')"
/>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">
        Category
    </label>
    <select
        name="category_id"
        id="category_id"
        @change="loadSubCategories"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <option value="">-- Select Category --</option>
        @foreach($categories ?? [] as $category)
            <option value="{{ $category->id }}" {{ old('category_id',$product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">
        Sub-Category
    </label>
    <select
        name="sub_category_id"
        id="sub_category_id"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <option value="">-- Select Sub-Category --</option>
        @foreach($subCategories ?? [] as $subCategory)
            <option value="{{ $subCategory->id }}" {{ old('sub_category_id',$product->sub_category_id ?? '') == $subCategory->id ? 'selected' : '' }}>
                {{ $subCategory->name }}
            </option>
        @endforeach
    </select>
</div>

<x-textarea
    label="Description"
    name="description">
{{ old('description',$product->description ?? '') }}
</x-textarea>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">
        Product Image
    </label>
    <input
        type="file"
        name="image"
        accept="image/*"
        data-preview-target="product-image-preview"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
</div>

<img
    id="product-image-preview"
    src="{{ isset($product) && $product->image ? Storage::url($product->image) : '' }}"
    alt="Product image preview"
    class="w-40 h-40 object-cover rounded-xl border border-gray-200 {{ isset($product) && $product->image ? '' : 'hidden' }}">

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">
        Status
    </label>
    <select
        name="status"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <option value="1" {{ old('status',$product->status ?? 0) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status',$product->status ?? 0) == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
