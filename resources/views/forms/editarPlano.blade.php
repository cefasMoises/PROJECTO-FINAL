@extends('layouts.App')

@section('content')
    @php
        $class_input =
            'apaerence-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp
    <div class="mt-20 space-y-10">


        <x-Title-App title="planos > editar" icon="bi bi-journal" type='secondary' action="/planos/" text-action='voltar' />


        @if (sizeof($cursos) > 0)
            <x-bladewind::card>
                <form action="/planos/atualizar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <input type="hidden" name="id" value="{{$plano->id}}">
                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-slate-600 mb-1">Nome</label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-journal text-slate-400 p-2"></i>
                            <input type="text" id="any-text" name="nome" maxlength="50" required value="{{$plano->nome}}"
                                class="{{ $class_input }}" placeholder="programação web..(no máximo 50 caracteres)">
                        </div>
                    </div>

                    <!-- duracao -->
                    <div>
                        <label for="duracao" class="block text-sm font-medium text-slate-600 mb-1">Duração/meses</label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-clock-fill text-slate-400 p-2"></i>
                            <input type="number" name="duracao" min="1" max="12" class="{{ $class_input }}" required value="{{$plano->duracao}}"
                                placeholder="4 (meses)">
                        </div>
                    </div>




                    <!-- Curso -->
                 
                        <div>
                            <label for="curso" class="block text-sm font-medium text-slate-600 mb-1">Curso</label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-book-fill text-slate-400 p-2"></i>
                                <select id="curso" name="curso" required class="{{ $class_input }}">
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                     




                        <!-- Ações -->
                        <div class="flex justify-end gap-4 mt-4">

                            <x-bladewind::button can_submit='true'>confirmar</x-bladewind::button>
                        </div>
                </form>
            </x-bladewind::card>
        @else
            <x-bladewind::card>
                <div class="flex flex-col items-center gap-4">

                    <x-bladewind::tag color='red' label='sem cursos disponiveis não é possivel adicionar planos!' />



                    <img src="{{ asset('vendor/bladewind/images/empty-state.svg') }}" alt="" class="size-96">
                </div>
            </x-bladewind::card>
        @endif

    </div>
@endsection
