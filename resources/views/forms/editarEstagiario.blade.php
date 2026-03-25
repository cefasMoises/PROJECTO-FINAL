@extends('layouts.App')

@section('content')

    <div class="mt-20 space-y-10">

        <x-Title-app title="Estagiários > Editar" icon="bi bi-people-fill" action="/estagiarios" type="secondary"
            text-action="Voltar" />

        {{-- Check for available planos --}}
        @if (!empty($select_planos))
            <div class="ui-form">

                <form action="/estagiarios/atualizar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf


                    <input type="hidden" name="id" value="{{ $estagiario->id }}">
                    <!-- Nome -->
                    <x-bladewind::input label="Nome" name="nome" value="{{ $estagiario->nome }}" required />

                    <!-- Email -->
                    <x-bladewind::input type="email" label="Email" name="email" error_message="email invalido!"
                        value="{{ $estagiario->email }}" />

                    <!-- Telefone -->
                    <x-bladewind::input numeric="true" label="telefone" name="telefone" value="{{ $estagiario->tel }}"
                        required />

                    <!-- Bi -->
                    <x-bladewind::input label="Número de bilhete de identidade/Nif" name="bi" required
                        value="{{ $estagiario->bi }}" />

                    {{-- data de nascimento --}}
                    <x-bladewind::datepicker name="dt_nascimento" label="data de nascimento" required="true" format="dd-mm-yy"
                        minDate="1-1-1999" maxDate="1-1-2015" selectedValue="{{ $estagiario->dt_nascimento }}" />

                    {{-- plano --}}
                    <x-bladewind::select name="plano" label="planos de estagio" :data="$select_planos" required
                        selectedValue="{{ $estagiario->plano_estagio_id }}" />

                    <!-- Gênero -->
                    <x-bladewind::select name="genero" label="genero" :data="[['label' => 'masculino', 'value' => 'M'], ['label' => 'femenino', 'value' => 'F']]" required selectedValue="{{ $estagiario->sexo }}" />

                    <!-- institutos -->
                    <x-bladewind::select name="institutos" label="instituto" :data="$select_institutos"
                        selectedValue="{{ $estagiario->instituto }}" required />

                    <!-- Foto -->

                    <x-bladewind::filepicker name="foto" accepted_file_types='image/*' max_file_size='10mb'
                        placeholder_line1="Carregue a foto passe" cceptedFileTypes=".png" required
                        selectedValue="{{ asset('storage/' . $estagiario->foto) }}" />


                    <!-- Documentos -->

                    <x-bladewind::filepicker name="documentos" placeholder_line1="outro documentos"
                        accepted_file_types="application/pdf,image/*" max_file_size="10mb"
                        :selectedValue="$estagiario->documentos ? asset('storage/' . $estagiario->documentos) : ''" />


                    <!-- Ações -->
                    <div class="flex justify-end gap-4 mt-4">

                        <x-bladewind::button can_submit='true'>confirmar</x-bladewind::button>
                    </div>

                </form>
            </div>
        @else
            <x-bladewind::card>
                <div class="flex flex-col items-center gap-4">
                    <x-bladewind::tag color="red" label="Não há plano de estágio disponível" />
                    <img src="{{ asset('vendor/bladewind/images/empty-state.svg') }}" alt="Empty State" class="size-96" />
                </div>
            </x-bladewind::card>
        @endif

    </div>
@endsection