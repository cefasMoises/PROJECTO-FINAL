@extends('layouts.App')

@section('content')
    <div class="mt-20 space-y-10">

        <x-bladewind::card>
            <div class="flex justify-between items-center">
                <h1 class="uppercase text-gray-500"><i class="bi bi-graph-down"></i> Desempenho</h1>
                <x-bladewind::button type='secondary' tag='a' href='/'>voltar</x-bladewind::button>
            </div>
        </x-bladewind::card>

        <x-bladewind::card class="rounded-none">
            @forelse ($cursos as $curso)
                <x-bladewind::card>
                    <h1 class="text-slate-500 text-center bi bi-collection-fill"> {{ $curso->nome }}</h1>

                    @foreach ($curso->turmas as $turma)
                        <a class="flex items-center justify-between gap-2 m-2 rounded p-2 text-blue-500 bg-slate-500/10"
                            href="/desempenho/{{ $turma->id }}">
                            <h1 class="capitalize mr-auto bi bi-door-closed-fill">{{ $turma->nome }}</h1>

                            <x-bladewind::progress-circle
                                size="tiny"
                                percentage="{{ $turma->alunos->count() }}"
                                color="green"
                                show_label="true"
                            />
                        </a>
                    @endforeach
                </x-bladewind::card>
            @empty
                <x-bladewind::card>
                    <p class="text-center text-slate-400">Nenhum curso disponível.</p>
                </x-bladewind::card>
            @endforelse
        </x-bladewind::card>

    </div>
@endsection
