<a href="{{$href}}" 
   @if($target) target="{{$target}}" @endif
   class="text-black hover:text-gray-700 {{$class}}">
    @if($label){{$label}}@else{{$slot}}@endif
</a>
