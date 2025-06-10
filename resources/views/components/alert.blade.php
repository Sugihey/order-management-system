@php
    $baseClasses = 'border px-4 py-3 rounded mb-4 ';
    $colorScheme = match($scheme) {
      'info' => 'text-blue-700 bg-blue-100 border-blue-400',
      'success' => 'text-green-700 bg-green-100 border-green-400',
      'danger' => 'text-red-700 bg-red-100 border-red-400',
      'warning' => 'text-yellow-700 bg-yellow-100 border-yellow-400',
      default => 'text-gray-700 bg-gray-100 border-gray-400',
   };
@endphp
<div {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorScheme]) }}>
    {{ $slot }}
</div>
