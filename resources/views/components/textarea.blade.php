@props([
    'label',
    'name'
])

<div class="form-group">

    <label class="block mb-2 text-sm font-medium text-gray-900">
        {{ $label }}
    </label>

    <textarea
        name="{{ $name }}"
        rows="5"
        {{ $attributes }}
        class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{ $slot }}</textarea>

    @error($name)
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
    @enderror

</div>