@props(['action', 'icon', 'text_action', 'type','title'])

<x-bladewind::card>
    <div class="flex justify-between items-center">
        <h1 class="uppercase text-gray-500"><i class="bi {{ $icon }}"></i> {{ $title }}</h1>
        <x-bladewind::button type='{{ $type }}' tag='a'
            href='{{ $action }}'>{{ $text_action }}</x-bladewind::button>
    </div>
</x-bladewind::card>
