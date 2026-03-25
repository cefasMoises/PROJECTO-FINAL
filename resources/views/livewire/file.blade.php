@props(['name','label'])
<div class='flex flex-col text-base text-gray-500 gap-1 p-2'>
    <label for="x{{ $name }}" class="capitalize">{{ $label}}</label>
    <div class="flex bg-red-100 relative rounded-md overflow-hidden h-32 border-gray-300 border border-solid">
        <input class="opacity-0 h-full w-full  z-10  grow rounded-md text-base text-blue-500 border-gray-300 bg-gray-100" type='file' {{ $attributes->merge(['placeholder'=>'']) }} name="{{$name}}" id="x{{ $name }}" />
        {{-- input file type --}}
        <i class="bi-file-image flex flex-col items-center justify-center absolute w-full h-full bg-gray-100  text-4xl "></i>
    </div>
</div>
