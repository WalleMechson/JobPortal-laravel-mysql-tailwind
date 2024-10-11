<a href={{$href}} @if($onclick) onclick="{{ $onclick }}" @endif {{$attributes->class(["rounded-md px-2.5 py-1.5 border border-slate-300 hover:bg-slate-100 text-black font-semibold cursor-pointer select-none text-sm text-center shadow-sm"])}}>
    {{$slot}}
</a>