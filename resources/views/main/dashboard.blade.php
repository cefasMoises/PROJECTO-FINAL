@extends('layouts.App')

@section('content')
<div class="mt-20 space-y-10">

    {{-- Estatísticas principais --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <x-bladewind::card has_shadow="true" class="flex flex-col items-center justify-center p-6">
            <x-bladewind::statistic number="{{ $alunos }}" label="Total Alunos">
                <x-slot name="icon">
                    <i class="bi bi-people-fill text-3xl text-gray-600"></i>
                </x-slot>
            </x-bladewind::statistic>
        </x-bladewind::card>

        <x-bladewind::card has_shadow="true" class="flex flex-col items-center justify-center p-6">
            <x-bladewind::statistic number="{{ $cursos }}" label="Total Cursos">
                <x-slot name="icon">
                    <i class="bi bi-collection-fill text-3xl text-gray-600"></i>
                </x-slot>
            </x-bladewind::statistic>
        </x-bladewind::card>

        <x-bladewind::card has_shadow="true" class="flex flex-col items-center justify-center p-6">
            <x-bladewind::statistic number="{{ $turmas }}" label="Total Turmas">
                <x-slot name="icon">
                    <i class="bi bi-door-closed-fill text-3xl text-gray-600"></i>
                </x-slot>
            </x-bladewind::statistic>
        </x-bladewind::card>

        <x-bladewind::card has_shadow="true" class="flex flex-col items-center justify-center p-6">
            <x-bladewind::statistic number="{{ $instrutores }}" label="Total Instrutores">
                <x-slot name="icon">
                    <i class="bi bi-person-badge-fill text-3xl text-gray-600"></i>
                </x-slot>
            </x-bladewind::statistic>
        </x-bladewind::card>
    </div>

    {{-- Gráfico de Inscrições --}}
    <x-bladewind::card class="p-6" has_shadow="true">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Inscrições no Ano</h2>
        <x-bladewind::chart :data="$dados" />
    </x-bladewind::card>

</div>
@endsection
