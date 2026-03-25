@extends('layouts.App')

@section('content')
    @php
        $class_input =
            'appearance-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp

    <div class="mt-20 space-y-10">
        <x-Title-App title="Instrutor > Editar" icon="bi bi-person" type='secondary' action="/instrutores" text-action='voltar' />

        @if (sizeof($cursos) > 0)
            <x-bladewind::card>
                <form action="/instrutores/atualizar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                  
                    <!-- Nome -->
                    <input type="hidden" value="{{$instrutor->id}}" name='id'>
                    <div>
                        <label for="nome" class="block text-sm font-medium text-slate-600 mb-1">Nome</label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-person-fill text-slate-400 p-2"></i>
                            <input type="text" name="nome" maxlength="50" required
                                pattern="^[A-Za-zÀ-ÿ\s]{3,50}$" class="{{ $class_input }}"
                                value="{{ $instrutor->nome }}"
                                placeholder="Domingos Nosso..(no máximo 50 caracteres)">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-600 mb-1">Email</label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-envelope-fill text-slate-400 p-2"></i>
                            <input type="email" name="email"
                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$"
                                class="{{ $class_input }}" value="{{ $instrutor->email }}"
                                placeholder="example@email.com">
                        </div>
                    </div>

                    <!-- Telefones e BI -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tel" class="block text-sm font-medium text-slate-600 mb-1">Telefone</label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-telephone-fill text-slate-400 p-2"></i>
                                <input type="text" name="tel" maxlength="9" required
                                    pattern="^9\d{8}$" class="{{ $class_input }}"
                                    placeholder="9 dígitos começando por 9"
                                    value="{{ $instrutor->tel }}">
                            </div>
                        </div>

                        <div>
                            <label for="bi" class="block text-sm font-medium text-slate-600 mb-1">Número de BI</label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-card-text text-slate-400 p-2"></i>
                                <input type="text" name="bi" required maxlength="14"
                                    pattern="^\d{9}[A-Z]{2}\d{3}$" class="{{ $class_input }}"
                                    placeholder="006984317LA098 (14 caracteres)"
                                    value="{{ $instrutor->bi }}">
                            </div>
                        </div>
                    </div>

     

                    <!-- Curso e Gênero -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="curso" class="block text-sm font-medium text-slate-600 mb-1">Curso</label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-book-fill text-slate-400 p-2"></i>
                                <select name="curso" required class="{{ $class_input }}">
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}"
                                            {{ $instrutor->cursos->contains($curso->id) ? 'selected' : '' }}>
                                            {{ $curso->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="sexo" class="block text-sm font-medium text-slate-600 mb-1">Gênero</label>
                            <div class="flex items-center border border-slate-300 rounded">
                                <i class="bi-gender-ambiguous text-slate-400 p-2"></i>
                                <select name="sexo" required class="{{ $class_input }}">
                                    <option value="M" {{ $instrutor->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ $instrutor->sexo == 'F' ? 'selected' : '' }}>Feminino</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Especialidade -->
               

                    <div>
                        <label for="especialidade" class="block text-sm font-medium text-slate-600 mb-1">Especialidade</label>
                        <x-bladewind::textarea name='especialidade' placeholder="especialidade" selected_value='{{$instrutor->especialidade}}' />
                    
                    </div>

                    <!-- Foto -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-slate-600 mb-1">Foto (Passe)</label>
                        <x-bladewind::filepicker name="foto" accepted_file_types='image/*' max_file_size='10mb'
                            placeholder="Foto passe" selected_value="{{asset('uploads/'.$instrutor->foto)}}" />
                     
                    </div>

                    <!-- Documentos -->
                    <div>
                        <label for="documentos" class="block text-sm font-medium text-slate-600 mb-1">Documentos (Currículo)</label>
                        <x-bladewind::filepicker name="documentos" accepted_file_types='image/*,.pdf' max_file_size='10mb'
                            placeholder="Currículo ou documentos" selected_value="{{asset('uploads/'.$instrutor->documentos)}}" />
                        @if ($instrutor->documentos)
                            <small class="text-sm text-slate-500 mt-1">Documento atual: {{ $instrutor->documentos }}</small>
                        @endif
                    </div>

                    <!-- Botões -->
                    <div class="flex justify-end gap-4 mt-4">
                        <x-bladewind::button can_submit='true'>Confirmar</x-bladewind::button>
                    </div>
                </form>
            </x-bladewind::card>
        @else
            <x-bladewind::card>
                <div class="flex flex-col items-center gap-4">
                    <x-bladewind::tag color='red' label='Sem cursos disponíveis. Não é possível editar o instrutor!' />
                    <img src="{{ asset('vendor/bladewind/images/empty-state.svg') }}" alt="" class="size-96">
                </div>
            </x-bladewind::card>
        @endif
    </div>
@endsection
