@php
$baseClasses = 'flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2';
$colorScheme = 'text-black bg-gray-300 hover:bg-gray-400 focus:ring-gray-200';
@endphp

<button type="{{$type}}" 
    {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorScheme . $userClass]) }}
    @if($onClick) onClick="{{$onClick}}" @endif
    >{{$slot}}</button>