@props([
    'id' => '',
    'class' => '',
])
<div 
    @if($id)id="{{ $id }}" @endif
    {{ $attributes->merge(['class' => 'absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-60 overflow-y-auto ' . $class]) }}
></div>