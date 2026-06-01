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
        class="w-full border rounded-xl p-3">

</div>

@if(isset($location) && $location->image)

<div class="mt-5">

    <img
        src="{{ Storage::url($location->image) }}"
        class="w-40 rounded-xl border">

</div>

@endif