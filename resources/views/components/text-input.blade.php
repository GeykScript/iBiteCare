@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-100 border-gray-100 focus:border-gray-500 focus:bg-gray-50 focus:ring-gray-500 rounded-md shadow-sm']) }}>