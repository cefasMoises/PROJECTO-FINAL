@extends('layouts.App')

@section('content')
    @php
        $class_input =
            'apaerence-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp
    <div class="mt-20 space-y-10">


        <x-Title-App title="alunos > registrar" icon="bi bi-person" type='secondary' action="/alunos" text-action='voltar' />


        @if (sizeof($cursos) > 0)
            <x-bladewind::card>
                <form action="/alunos/criar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-slate-600 mb-1">Nome <x-obr /> </label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-person-fill text-slate-400 p-2"></i>
                            <input type="text" id="any-text" name="nome" maxlength="50" required
                                pattern="^[A-Za-zÀ-ÿ\s]{3,50}$" class="{{ $class_input }}"
                                placeholder="Domingos Nosso..(no máximo 50 caracteres)">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-600 mb-1">Email</label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-envelope-fill text-slate-400 p-2"></i>
                            <input type="email" id="any-email" name="email"
                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" class="{{ $class_input }}"
                                placeholder="example@email.com">
                        </div>
                    </div>

                    <!-- Telefones e BI -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tel" class="block text-sm font-medium text-slate-600 mb-1">Telefone</label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-telephone-fill text-slate-400 p-2"></i>
                                <input type="text" id="any-tel" name="tel" maxlength="9" pattern="^9\d{8}$"
                                    class="{{ $class_input }}" placeholder="9 dígitos começando por 9">
                            </div>
                        </div>

                        <div>
                            <label for="bi" class="block text-sm font-medium text-slate-600 mb-1">Número de
                                BI<x-obr /> </label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-card-text text-slate-400 p-2"></i>
                                <input type="text"  name="bi" required maxlength="14"
                                    class="{{ $class_input }}"
                                    placeholder="006984317LA098 (14 caracteres)">
                            </div>
                        </div>
                    </div>

                    <!-- Data de Nascimento -->
                    <div>
                        <label for="dt_nascimento" class="block text-sm font-medium text-slate-600 mb-1">Data de
                            Nascimento<x-obr /></label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-calendar-fill text-slate-400 p-2"></i>
                            <input type="date" id="dt_nascimento" name="dt_nascimento" required
                                class="{{ $class_input }}" min="1980-01-01" max="2015-01-01">
                        </div>
                    </div>

                    <!-- Curso -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="curso"
                                class="block text-sm font-medium text-slate-600 mb-1">Curso<x-obr /></label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-book-fill text-slate-400 p-2"></i>
                                <select id="curso" name="curso" required class="{{ $class_input }}">
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Gênero -->
                        <div>
                            <label for="sexo"
                                class="block text-sm font-medium text-slate-600 mb-1">Gênero<x-obr /></label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-gender-ambiguous text-slate-400 p-2"></i>
                                <select id="sexo" name="sexo" required class="{{ $class_input }}">
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-slate-600 mb-1">Foto
                            (Passe)<x-obr /></label>
                        <x-bladewind::filepicker name="foto" accepted_file_types='image/*' max_file_size='10mb'
                            placeholder="Foto passe" required />
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

                    <x-bladewind::tag color='red' label='sem cursos disponiveis não é possivel adicionar alunos!' />



                    <img src="{{ asset('vendor/bladewind/images/empty-state.svg') }}" alt="" class="size-96">
                </div>
            </x-bladewind::card>
        @endif

    </div>
@endsection
