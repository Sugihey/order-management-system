<a href="{{$href}}" 
   @if($target) target="{{$target}}" @endif
   class="text-red-600 hover:text-red-500 {{$class}}">
    @if($label){{$label}}@else{{$slot}}@endif
</a>
