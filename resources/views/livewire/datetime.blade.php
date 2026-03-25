@props(['name','label','value'])
<div class="flex flex-col justify-center w-full mb-4">
    <label class="pl-4 capitalize text-xs text-slate-400">{{ $label }}</label>
    {{-- end --}}
    <div class="flex items-center relative">
        <input class='appearance-none bg-transparent w-full text-slate-400 outline-2 outline outline-slate-200 h-10 text-sm border-none overflow-hidden rounded' type="date" name="{{ $name }}" required  id="{{$name}}" value="{{$date}}" />
        {{-- end --}}
        <label class="absolute right-0 p-2 h-full bg-slate-200 text-slate-400" for="{{$name }}"><i class="bi-calendar"></i></label>
    </div>
</div>
