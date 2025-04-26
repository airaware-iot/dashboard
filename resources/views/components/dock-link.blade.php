<a class="group inline-block gap-0.5" href="{!! $href !!}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8 mx-auto group-hover:opacity-70 transition-opacity {{$color}}">
        {{$slot}}
    </svg>
    <p class="group-hover:opacity-70 transition-opacity {{$color}}">{{$title}}</p>
</a>