@extends('layouts.App')

@section('content')

    <div class="mt-20 space-y-10">

        <x-Title-app title="estagiarios > registrar" icon='bi bi-people-fill' action='/estagiarios' type='secondary'
            text-action='voltar' />
        {{-- end title section --}}

        @if (!empty($select_planos))

        <x-bladewind::alert>
            preencha cada campo de acordo as normas de validação
        </x-bladewind::alert>
            <div class="ui-form">

                <form action="/estagiarios/criar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Nome -->
                    <x-bladewind::input label="Nome" name="nome" required />

                    <!-- Email -->
                    <x-bladewind::input type="email" label="Email" name="email" error_message="email invalido!" />

                    <!-- Telefone -->
                    <x-bladewind::input numeric="true" label="telefone" name="telefone" required />

                    <!-- Bi -->
                    <x-bladewind::input label="Número de bilhete de identidade/Nif" name="bi" required />

                    {{-- data de nascimento --}}
                    <x-bladewind::datepicker name="dt_nascimento" label="data de nascimento" required="true" format="dd-mm-yy"
                        minDate="1-1-1999" maxDate="1-1-2015" />

                    {{-- plano --}}
                    <x-bladewind::select name="plano" label="planos de estagio" :data="$select_planos" required />

                    <!-- Gênero -->
                    <x-bladewind::select name="genero" label="genero" :data="[['label' => 'masculino', 'value' => 'M'], ['label' => 'femenino', 'value' => 'F']]" required />

                    <!-- institutos -->
                    <x-bladewind::select name="institutos" label="instituto" :data="$select_institutos" required />

                    <!-- Foto -->

                    <x-bladewind::filepicker name="foto" accepted_file_types='image/*' max_file_size='10mb'
                        placeholder_line1="Carregue a foto passe" cceptedFileTypes=".png" required />

                    <!-- Documentos -->

                    <x-bladewind::filepicker name="documentos" placeholder_line1="outro documentos"
                        accepted_file_types="application/pdf,image/*" max_file_size='10mb' />


                    <!-- Ações -->
                    <div class="flex justify-end gap-4 mt-4">

                        <x-bladewind::button can_submit='true'>confirmar</x-bladewind::button>
                    </div>

                </form>
            </div>

        @else
            <x-require-state info="Para registrar um estagiario é necessario registrar primeiro um plano de estagio!"/>
        @endif



    </div>
@endsection