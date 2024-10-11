<div class="relative" x-data>
    {{-- onclick="document.querySelector('input[name={{$name}}]').value = '';
    document.querySelector('input[name={{$name}}]').closest('form').submit()" --}}
    @if('textarea' !== $type)
        @if($formRef)
            <button @click="$refs['input-{{$name}}'].value = ''; $refs['{{$formRef}}'].submit()" type="button"
                class="absolute top-0 right-0 h-full flex items-center pr-2 text-slate-500 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        @endif

        <input type="{{$type}}" x-ref="input-{{$name}}" placeholder="{{ $placeholder }}" value="{{ $value }}"
            value="{{ old($name, $value) }}" name="{{$name}}" @class([
            "w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1  placeholder:text-slate-400 focus:ring-2",
            "pr-8" => $formRef,
            "ring-slate-300" => !$errors->has($name),
            "ring-red-700" => $errors->has($name),
        ]) />
    @else

        <textarea placeholder="{{ $placeholder }}" id="{{$name}}" name="{{$name}}" @class([
            "w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2",
            "pr-8" => $formRef,
            "ring-slate-300" => !$errors->has($name),
            "ring-red-700" => $errors->has($name),
        ])>{{ old($name, $value) }}</textarea>
    @endif

    @error($name)
        <span class="mt-1 text-sm text-red-700">{{$message}}</span>
    @enderror

</div>