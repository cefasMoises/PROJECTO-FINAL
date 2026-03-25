<div class="flex flex-col    grow bg-gray-200 p-2 overflow-y-auto gap-8">
   
    @isset($slot)
        {{ $slot }}
    @endisset
</div>