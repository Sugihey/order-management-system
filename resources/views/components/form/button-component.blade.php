@php
    $baseClasses = 'text-center py-1 px-4 border border-transparent rounded shadow-sm text-sm font-medium focus:outline-none';
    $colorScheme = match($scheme) {
      'scraft' => 'text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-indigo-400 ',
      'artisan' => 'text-white bg-sky-500 hover:bg-sky-600 focus:ring-sky-400 ',
      'danger' => 'text-white bg-red-500 hover:bg-red-600 focus:ring-red-400 ',
      'action' => 'text-white bg-green-500 hover:bg-green-600 focus:ring-green-400 ',
      default => 'text-black bg-gray-300 hover:bg-gray-400 focus:ring-gray-500 ',
   };
@endphp

<button type="{{$type}}" 
    {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorScheme . $userClass]) }}
    @if($onClick) onClick="{{$onClick}}" @endif
    >{{$slot}}</button>