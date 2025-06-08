@php
   $baseClass = match($scheme) {
      'scraft' => $button ? 'bg-indigo-500 text-white px-4 py-1 rounded hover:bg-indigo-600 ' : 'text-indigo-600 hover:text-indigo-700 ',
      'artisan' => $button ? 'bg-sky-500 text-white px-4 py-1 rounded hover:bg-sky-600 ' : 'text-green-600 hover:text-sky-700 ',
      'danger' => $button ? 'bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 ' : 'text-green-600 hover:text-red-700 ',
      'action' => $button ? 'bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600 ' : 'text-green-600 hover:text-green-700 ',
      default => $button ? 'bg-gray-400 text-white px-4 py-1 rounded hover:bg-gray-500 ' : 'text-green-600 hover:text-gray-600 ',
   };
@endphp
<a href="{{$href}}" 
   @if($target) target="{{$target}}" @endif
   class="{{$baseClass.$class}}">
   @if($label){{$label}}@else{{$slot}}@endif
</a>
