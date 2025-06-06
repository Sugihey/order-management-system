@props([
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'readonly' => false,
    'disabled' => false,
    'onChange' => '',
    'onClick' => '',
    'name' => '',
    'id' => ''
])

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
    {{ $attributes->merge(['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500']) }}
/>
