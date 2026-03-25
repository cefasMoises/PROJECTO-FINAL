@props(['name','label'])

<div class='flex flex-col text-base text-gray-500 gap-1 p-2 w-full'>
    <label for="x{{ $name }}" class="capitalize">{{ $label}}</label>
    <input class="appearance-none p-2 h-12 rounded-md text-base text-blue-500 border-gray-300 bg-gray-100" {{ $attributes->merge(['type'=>'text','placeholder'=>'']) }} name="{{$name}}" id="x{{ $name }}"/>
</div>
