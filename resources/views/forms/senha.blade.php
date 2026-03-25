@extends('layouts.App')
@section('content')
    <div class="mt-20 space-y-10">
        {{-- first --}}
        <x-Title-app title='usuarios/editar/senha' action='/usuarios/' icon='bi bi-people-fill' text_action="voltar" />
        {{-- end title section --}}

        <div class="ui-form">
            
            <form action="/usuarios/senha/update/{{ $usuario->id }}" class="flex flex-col gap-4" method="POST">
                @csrf
                <x-bladewind.input label="senha nova" name="nova_senha" required="true" viewable="true" />

                <x-bladewind.input label="confirmar nova" name="nova_senha2" required="true" />


                <x-bladewind.alert type="warning" show_close_icon="false">
                    confirme a senha atual para salvar as alterações
                </x-bladewind.alert>

                <x-bladewind.input label="senha atual " name="senha" required="true" />


                <div class="flex justify-end">
                    <x-bladewind.button canSubmit="true">
                        salvar
                    </x-bladewind.button>
                </div>

            </form>

        </div>
    </div>
@endsection