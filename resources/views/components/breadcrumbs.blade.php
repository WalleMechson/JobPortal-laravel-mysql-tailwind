<nav {{$attributes}}>
    <ul class="flex space-x-4 text-slate-500 text-sm">
        @foreach($links as $index => $value)
            @if($loop->last)
                <li><a href="{{ $value }}">{{$index}}</a></li>
            @else
                <li><a href="{{ $value }}">{{$index}}</a></li>
                <li>&rarr;</li>
            @endif
        @endforeach
    </ul>
</nav>