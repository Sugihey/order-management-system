@props([
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'readonly' => false,
    'disabled' => false,
    'onChange' => '',
    'onClick' => '',
    'name' => '',
    'id' => '',
    'autocomplete' => '',
])

@php
$baseClasses = 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500';
$errorClasses = $name && $errors->has($name) ? ' border-red-500' : '';
@endphp

<input 
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id }}"
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($value) value="{{ $value }}" @endif
    @if($readonly) readonly @endif
    @if($disabled) disabled @endif
    @if($onChange) onchange="{{ $onChange }}" @endif
    @if($onClick) onclick="{{ $onClick }}" @endif
    @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
    {{ $attributes->merge(['class' => $baseClasses . $errorClasses]) }}
/>
