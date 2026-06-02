<x-input
    label="Page Name"
    name="page_name"
    :value="old('page_name',$content_page->page_name ?? '')"
/>

<x-input
    id="title"
    label="Title"
    name="title"
    :value="old('title',$content_page->title ?? '')"
/>

<x-input
    id="slug"
    label="Slug"
    name="slug"
    :value="old('slug',$content_page->slug ?? '')"
/>

<x-input
    label="Subtitle"
    name="subtitle"
    :value="old('subtitle',$content_page->subtitle ?? '')"
/>

<x-textarea
    label="Description"
    name="description">
{{ old('description',$content_page->description ?? '') }}
</x-textarea>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">
        Featured Image
    </label>
    <input
        type="file"
        name="featured_image"
        accept="image/*"
        data-preview-target="content-page-featured-image-preview"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
</div>

<img
    id="content-page-featured-image-preview"
    src="{{ isset($content_page) && $content_page->featured_image ? Storage::url($content_page->featured_image) : '' }}"
    alt="Featured image preview"
    class="w-40 h-40 object-cover rounded-xl border border-gray-200 {{ isset($content_page) && $content_page->featured_image ? '' : 'hidden' }}">

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">
        Content
    </label>
    <textarea
        id="content"
        name="content"
        rows="10"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{ old('content',$content_page->content ?? '') }}</textarea>
</div>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">
        Status
    </label>
    <select
        name="status"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <option value="1" {{ old('status',$content_page->status ?? 0) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status',$content_page->status ?? 0) == 0 ? 'selected' : '' }}>Draft</option>
    </select>
</div>

<script>
document
    .getElementById('title')
    .addEventListener('keyup', function(){
        let slug = this.value
            .toLowerCase()
            .replaceAll(' ','-')
            .replace(/[^\w-]+/g,'');
        document.getElementById('slug').value = slug;
    });
</script>
