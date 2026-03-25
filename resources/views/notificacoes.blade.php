@extends('layouts.App')

@section('content')
    <div class="mt-20 space-y-8">

        {{-- Header --}}
        <x-bladewind::card>
            <div class="flex justify-between items-center">
                <h1 class="uppercase text-gray-600 text-xl font-semibold flex items-center gap-2">
                    <i class="bi bi-bell-fill "></i> Notificações
                </h1>
                <x-bladewind::button type="secondary" tag="a" href="/back" class="px-4 py-2">
                    Voltar
                </x-bladewind::button>
            </div>
        </x-bladewind::card>

        {{-- Notificações --}}
        <div class="flex flex-col gap-4">
            @forelse ($notifications as $notification)
                <x-bladewind::card type="info" showCloseIcon="false" class="shadow-sm">

                    <div>
                        <span class="font-semibold text-gray-700">{{ ucfirst($notification->tipo) }}</span>
                        <p class="mt-1 text-gray-600">{{ $notification->descricao }}</p>
                    </div>
                    <time class="text-xs text-gray-400 whitespace-nowrap" datetime="{{ $notification->created_at }}">
                        {{ $notification->created_at->format('d/m/Y H:i') }}
                    </time>

                </x-bladewind::card>
            @empty
                <x-bladewind::card type="warning" showCloseIcon="false" class="text-center">
                    Nenhuma notificação encontrada.
                </x-bladewind::card>
            @endforelse
        </div>

    </div>
@endsection
