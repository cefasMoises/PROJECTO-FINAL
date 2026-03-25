@props(['text'])

<x-bladewind::card>
    <x-bladewind::card>
        <div class="flex justify-center items-center">
            <x-bladewind::tag label='{{$text}}' />
            
        </div>
        {{-- end --}}
        <div class="flex items-center justify-center">
            <img class='size-96' src="{{ asset('vendor/bladewind/images/empty-state.svg') }}" alt="image de vazio">
        </div>
    </x-bladewind::card>
</x-bladewind::card>