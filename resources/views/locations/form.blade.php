<x-input
    label="Location Name"
    name="name"
    :value="old('name', $location->name ?? '')"
/>

<div class="mt-5">

    <x-textarea
        label="Address"
        name="address">{{ old('address', $location->address ?? '') }}</x-textarea>

</div>

<div class="mt-5">

    <x-input
        label="Open Shop"
        name="open_shop"
        :value="old('open_shop', $location->open_shop ?? '')"
    />

</div>

<div class="mt-5">

    <x-input
        label="Kota"
        name="kota"
        :value="old('kota', $location->kota ?? '')"
    />

</div>

<div class="mt-5">

    <x-input
        label="Daerah"
        name="daerah"
        :value="old('daerah', $location->daerah ?? '')"
    />

</div>

<div class="mt-5">

    <x-input
        label="Google Maps URL"
        name="google_maps_url"
        :value="old('google_maps_url', $location->google_maps_url ?? '')"
    />

</div>

<div class="mt-5">

    <x-input
        label="Phone"
        name="phone"
        :value="old('phone', $location->phone ?? '')"
    />

</div>

<div class="mt-5">

    <x-textarea
        label="Description"
        name="description">{{ old('description', $location->description ?? '') }}</x-textarea>

</div>

<div class="mt-5">

    <label class="block mb-2 font-medium">
        Image
    </label>

    <input
        type="file"
        name="image"
        data-preview-target="location-image-preview"
        class="w-full border rounded-xl p-3">

</div>

<img
    id="location-image-preview"
    src="{{ isset($location) && $location->image ? Storage::url($location->image) : '' }}"
    alt="Location image preview"
    class="w-40 h-40 object-cover rounded-xl border {{ isset($location) && $location->image ? '' : 'hidden' }}">
