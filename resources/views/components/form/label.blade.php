@props([
    'for' => '',
    'label' => '',
    'required' => false,
])
<label for="{{$for}}" class="block text-sm font-medium text-gray-700">
    {{$label}}@if($required) <span class="text-red-500">*</span>@endif
</label>
