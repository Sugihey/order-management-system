@php
$baseClasses = 'flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2';
$colorScheme = 'text-white bg-red-600 hover:bg-red-700 focus:ring-red-500';
@endphp

<button type="{{$type}}" 
    {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorScheme . $userClass]) }}
    @if($onClick) onClick="{{$onClick}}" @endif
    >{{$slot}}</button>