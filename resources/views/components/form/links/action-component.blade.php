<a href="{{$href}}" 
   @if($target) target="{{$target}}" @endif
   class="text-green-600 hover:text-green-500 {{$class}}">
    @if($label){{$label}}@else{{$slot}}@endif
</a>
