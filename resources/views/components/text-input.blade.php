@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-md shadow-sm text-sm px-3 py-2']) }}>
