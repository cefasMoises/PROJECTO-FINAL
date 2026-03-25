@extends('layouts.App')

@section('content')
    @php
        $class_input =
            'apaerence-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp

    <div class="mt-20 space-y-10">

        <div class="space-y-6">
            {{-- title section --}}

            {{-- first --}}
            <x-Title-app title='Usuarios > Criar' icon='bi bi-people-fill' action='/usuarios' text_action='voltar'
                type='secondary' />
            {{-- end title section --}}

            <x-bladewind::alert type="warning">
                Obs: Uma vez criado um novo usuario, Não é possivel editar o Email nem o nivel de acesso do usuario!
            </x-bladewind::alert>

            <div class="ui-form">

                <form action="/usuarios/criar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf


                    <x-bladewind::input name="email" required label="email" />
                    <!-- Nome -->
                    <div>
                        <x-bladewind::input type="text" name="nome" label="Nome" required placeholder="Nome Completo" />
                    </div>


                    <!-- acesso -->
                    <div>
                        <x-bladewind::select name="acesso" label="acesso" placeholder="Selecione o Acesso" required
                            :data="$acessos" />
                    </div>

                    {{-- senha --}}
                    <div>
                        <x-bladewind::input label="senha" name="senha" required min="6" />
                    </div>

                    {{-- confirmar senha --}}
                    <div>
                        <x-bladewind::input label="confirmar senha" name="senha_confirmation" required min="6" />
                    </div>



                    <!-- Ações -->
                    <div class="flex justify-end gap-4 mt-4">
                        <x-bladewind::button can_submit='true' hasSpinner="true">confirmar</x-bladewind::button>
                    </div>

                </form>

            </div>

        </div>
@endsection