<x-input
    label="Title"
    name="title"
    :value="old('title', $blog->title ?? '')"
/>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">Category</label>
    <select
        name="category_id"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <option value="">-- Select Category --</option>
        @foreach($categories ?? [] as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<x-input
    label="Tags"
    name="tags"
    :value="old('tags', $blog->tags ?? '')"
/>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">Published At</label>
    <input
        type="datetime-local"
        name="published_at"
        value="{{ old('published_at', isset($blog->published_at) && $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
</div>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">Featured Image</label>
    <input
        type="file"
        name="featured_image"
        accept="image/*"
        data-preview-target="blog-featured-image-preview"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
</div>

<img
    id="blog-featured-image-preview"
    src="{{ isset($blog) && $blog->featured_image ? Storage::url($blog->featured_image) : '' }}"
    alt="Blog featured image preview"
    class="w-40 h-40 object-cover rounded-xl border border-gray-200 {{ isset($blog) && $blog->featured_image ? '' : 'hidden' }}">

<x-textarea
    label="Content"
    name="content">
{{ old('content', $blog->content ?? '') }}
</x-textarea>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
    <select
        name="status"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <option value="1" {{ old('status', $blog->status ?? 0) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status', $blog->status ?? 0) == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
