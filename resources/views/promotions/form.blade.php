<x-input
    label="Name"
    name="name"
    :value="old('name', $promotion->name ?? '')"
/>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">Active</label>
    <select
        name="active"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        <option value="1" {{ old('active', $promotion->active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('active', $promotion->active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">Datetime</label>
    <input
        type="datetime-local"
        name="datetime"
        value="{{ old('datetime', isset($promotion->datetime) && $promotion->datetime ? $promotion->datetime->format('Y-m-d\TH:i') : '') }}"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
</div>

<div class="form-group">
    <label class="block mb-2 text-sm font-medium text-gray-900">Images</label>
    <p class="text-base text-gray-500">Gunakan format 1:1 (persegi), size maksimal 2MB</p>
    <input
        type="file"
        name="images[]"
        multiple
        accept="image/*"
        data-preview-target="promotion-images-preview"
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
</div>

<div
    id="promotion-images-preview"
    class="flex gap-3 flex-wrap {{ !empty($promotion->images ?? []) ? '' : 'hidden' }}">
    @foreach(($promotion->images ?? []) as $image)
        <img
            src="{{ Storage::url($image) }}"
            alt="Promotion image preview"
            class="w-32 h-32 object-cover rounded-xl border border-gray-200">
    @endforeach
</div>
