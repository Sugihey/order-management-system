<a href="{{$href}}" 
   @if($target) target="{{$target}}" @endif
   class="text-indigo-600 hover:text-indigo-500 {{$class}}">
    @if($label){{$label}}@else{{$slot}}@endif
</a>
