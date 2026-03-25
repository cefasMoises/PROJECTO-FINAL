@extends('layouts.App')

@section('content')
    @php

        use App\rules\UserAccess;


        $acess = [
            ['label' => 'Administrador', 'value' => UserAccess::getAdm()],
            ['label' => 'Finanças', 'value' => UserAccess::getFNC()],
            ['label' => 'Pedagogica', 'value' => UserAccess::getPDG()]

        ];

        $class_input =
            'apaerence-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp
    <div class="mt-20 space-y-10">
        <div class="mt-20 space-y-10">

            {{-- first --}}
            <x-Title-app title='Usuarios > editar' icon='bi bi-people-fill' action='/usuarios' text_action='voltar'
                type='secondary' />
            {{-- end title section --}}
            <x-bladewind::alert type="warning">
                Obs: Uma vez criado um novo usuario, Não é possivel editar o Email nem o nivel de acesso do usuario!
            </x-bladewind::alert>

            <div class="ui-form">

                <form action="/usuarios/atualizar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf


                    <input type="hidden" name='id' value="{{ $usuario->id }}">

                    <x-bladewind::input name="email" required label="email" value="{{ $usuario->email}}" disabled="true" />


                    <x-bladewind::alert type="warning">
                        Obs: usuarios desativados não podem iniciar sessão e acessar o sistema
                    </x-bladewind::alert>

                    @if ($usuario->acesso == "ADM")
                        <x-bladewind::alert type="info">
                            Obs: não é possivel desativar ou habilitar um usuario
                        </x-bladewind::alert>
                    @else

                        <x-bladewind::radio name="estatus" label="ativo" value="ON"
                            checked="{{ $usuario->estatus == 'ON' ? 'true' : 'false' }}" />

                        <x-bladewind::radio name="estatus" value="OFF" label="desativado"
                            checked="{{ $usuario->estatus == 'OFF' ? 'true' : 'false' }}" />
                    @endif




                    <x-bladewind::input name="nome" required label="nome" value="{{ $usuario->nome}}" />


                    <x-bladewind::input name="acesso" label="acesso" required value="{{ $usuario->acesso }}"
                        disabled="true" />


                    <x-bladewind::input name="senha" required label="confirmar senha" viewable="true" />


                    <div class="flex justify-end">
                        <x-bladewind::button canSubmit="true">confirmar</x-bladewind::button>
                    </div>

                </form>

            </div>

        </div>
@endsection