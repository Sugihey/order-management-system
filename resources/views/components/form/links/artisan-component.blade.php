<a href="{{$href}}" 
   @if($target) target="{{$target}}" @endif
   class="text-sky-600 hover:text-sky-500 {{$class}}">
    @if($label){{$label}}@else{{$slot}}@endif
</a>
