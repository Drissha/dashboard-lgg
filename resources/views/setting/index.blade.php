@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Website Settings</h1>
</div>

<div class="card max-w-4xl">
    <form
        action="{{ route('settings.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="card-body space-y-6">

        @csrf
        @method('PUT')

        <x-input
            label="Website Name"
            name="website_name"
            :value="$setting->website_name ?? ''"
        />

        <x-input
            label="Email"
            name="email"
            type="email"
            :value="$setting->email ?? ''"
        />

        <x-input
            label="Phone"
            name="phone"
            type="tel"
            :value="$setting->phone ?? ''"
        />

        <x-textarea
            label="Address"
            name="address">
{{ $setting->address ?? '' }}
        </x-textarea>

        <x-textarea
            label="Footer Text"
            name="footer_text">
{{ $setting->footer_text ?? '' }}
        </x-textarea>

        <div class="form-group">
            <label class="block mb-2 text-sm font-medium text-gray-900">
                Logo
            </label>
            <input
                type="file"
                name="logo"
                accept="image/*"
                data-preview-target="setting-logo-preview"
                class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <img
            id="setting-logo-preview"
            src="{{ isset($setting) && $setting->logo ? Storage::url($setting->logo) : '' }}"
            alt="Logo preview"
            class="w-40 h-40 object-cover rounded-xl border border-gray-200 {{ isset($setting) && $setting->logo ? '' : 'hidden' }}">

        <div class="flex gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="btn">Save Settings</button>
        </div>

    </form>
</div>

@endsection
