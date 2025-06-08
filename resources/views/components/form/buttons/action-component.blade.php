@php
$baseClasses = 'flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2';
$colorScheme = 'text-white bg-green-600 hover:bg-green-700 focus:ring-green-500';
@endphp

<button type="{{$type}}" 
    {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorScheme . $userClass]) }}
    @if($onClick) onClick="{{$onClick}}" @endif
    >{{$slot}}</button>