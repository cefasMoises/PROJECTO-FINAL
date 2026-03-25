@extends('layouts.App')

@section('content')
    @php
        $class_input =
            'apaerence-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp
    <div class="mt-20 space-y-10">

        <x-Title-app title="Estagiários > Editar" icon="bi bi-people-fill" action="/estagiarios" type="secondary"
            text-action="Voltar" />

        {{-- Check for available planos --}}
        @if (sizeof($planos) > 0)
            <x-bladewind::card>
                <form action="/estagiarios/atualizar/" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf


                    <!-- Nome -->
                    <input type="hidden" name="id" value="{{ $estagiario->id }}">
                    <div>
                        <label for="nome" class="block text-sm font-medium text-slate-600 mb-1">Nome<x-obr /></label>
                        <div class="flex items-center border border-slate-300 rounded-lg">
                            <i class="bi-person-fill text-slate-400 p-2"></i>
                            <input type="text" id="nome" name="nome" value="{{ $estagiario->nome }}"
                                maxlength="50" required pattern="^[A-Za-zÀ-ÿ\s]{3,50}$" class="{{ $class_input }}"
                                placeholder="Exemplo: João Silva">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-600 mb-1">Email</label>
                        <div class="flex items-center border border-slate-300 rounded-lg">
                            <i class="bi-envelope-fill text-slate-400 p-2"></i>
                            <input type="email" id="email" name="email" value="{{ $estagiario->email }}"
                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" class="{{ $class_input }}"
                                placeholder="Exemplo: email@dominio.com">
                        </div>
                    </div>

                    <!-- Telefones e BI -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tel" class="block text-sm font-medium text-slate-600 mb-1">Telefone</label>
                            <div class="flex items-center border border-slate-300 rounded-lg">
                                <i class="bi-telephone-fill text-slate-400 p-2"></i>
                                <input type="text" id="tel" name="tel" value="{{ $estagiario->tel }}"
                                    maxlength="9" pattern="^9\d{8}$" class="{{ $class_input }}"
                                    placeholder="9 dígitos começando por 9">
                            </div>
                        </div>

                        <div>
                            <label for="bi" class="block text-sm font-medium text-slate-600 mb-1">Número de
                                BI<x-obr /> </label>
                            <div class="flex items-center border border-slate-300 rounded-lg">
                                <i class="bi-card-text text-slate-400 p-2"></i>
                                <input type="text" id="bi" name="bi" value="{{ $estagiario->bi }}"
                                    maxlength="14" required pattern="^\d{9}[A-Z]{2}\d{3}$" class="{{ $class_input }}"
                                    placeholder="006984317LA098">
                            </div>
                        </div>
                    </div>

                    <!-- Data de Nascimento -->
                    <div>
                        <label for="dt_nascimento" class="block text-sm font-medium text-slate-600 mb-1">Data de
                            Nascimento<x-obr /></label>
                        <div class="flex items-center border border-slate-300 rounded-lg">
                            <i class="bi-calendar-fill text-slate-400 p-2"></i>
                            <input type="date" id="dt_nascimento" name="dt_nascimento"
                                value="{{ $estagiario->dt_nascimento }}" required class="{{ $class_input }}"
                                min="1980-01-01" max="2015-01-01">
                        </div>
                    </div>

                    <!-- Plano -->
                    <div>
                        <label for="plano" class="block text-sm font-medium text-slate-600 mb-1">Plano<x-obr /></label>
                        <div class="flex items-center border border-slate-300 rounded-lg">
                            <i class="bi-book-fill text-slate-400 p-2"></i>
                            <select id="plano" name="plano" required class="{{ $class_input }}">
                                @foreach ($planos as $plano)
                                    <option value="{{ $plano->id }}" @if ($estagiario->plano_estagio_id == $plano->id) selected @endif>
                                        {{ $plano->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Gênero -->
                    <div>
                        <label for="sexo" class="block text-sm font-medium text-slate-600 mb-1">Gênero<x-obr /></label>
                        <div class="flex items-center border border-slate-300 rounded-lg">
                            <i class="bi-gender-ambiguous text-slate-400 p-2"></i>
                            <select id="sexo" name="sexo" required class="{{ $class_input }}">
                                <option value="M" @if ($estagiario->sexo == 'M') selected @endif>Masculino</option>
                                <option value="F" @if ($estagiario->sexo == 'F') selected @endif>Feminino</option>
                            </select>
                        </div>
                    </div>

                    <!-- Instituto -->
                    <div>
                        <label for="instituto" class="block text-sm font-medium text-slate-600 mb-1">Instituto de Origem
                            <x-obr /></label>
                        <div class="flex items-center border border-slate-300 rounded-lg">
                            <i class="bi-buildings-fill text-slate-400 p-2"></i>
                            <select id="instituto" name="instituto" class="{{ $class_input }}">
                                @foreach ($institutos as $instituto)
                                    <option value="{{ $instituto->id }}" @if ($estagiario->instituto_id == $instituto->id) selected @endif>
                                        {{ $instituto->nome }}</option>
                                @endforeach
                                <option value="">Estagiário solo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-slate-600 mb-1">Foto (Passe) <x-obr />
                        </label>
                        <x-bladewind::filepicker name="foto" accepted_file_types="image/*" max_file_size="10mb"
                            placeholder="Foto passe" selected_value="{{ asset('uploads/' . $estagiario->foto) }}"
                            required />
                    </div>

                    <!-- Documentos -->
                    <div>
                        <label for="documentos" class="block text-sm font-medium text-slate-600 mb-1">outro Documento
                            (opcional)</label>
                        <x-bladewind::filepicker name="documentos" accepted_file_types="application/pdf,image/*"
                            max_file_size="10mb" placeholder="Documentos"
                            selected_value="{{ asset('uploads/' . $estagiario->documentos ?? '') }}" />

                        <a href="{{ asset('uploads/' . $estagiario->documentos ?? '') }}"
                            class="text-blue-500 text-sm" target="_blank">ver o documento</a>
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-end gap-4 mt-4">
                        <x-bladewind::button can_submit="true">Confirmar</x-bladewind::button>
                    </div>
                </form>
            </x-bladewind::card>
        @else
            <x-bladewind::card>
                <div class="flex flex-col items-center gap-4">
                    <x-bladewind::tag color="red" label="Não há plano de estágio disponível" />
                    <img src="{{ asset('vendor/bladewind/images/empty-state.svg') }}" alt="Empty State"
                        class="size-96" />
                </div>
            </x-bladewind::card>
        @endif

    </div>
@endsection
