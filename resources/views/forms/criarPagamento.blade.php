@extends('layouts.App')
@section('content')


    <div class="flex flex-col mt-20 space-y-10">

        <x-Title-app title='pagamentos > registrar' icon='bi-credit-card' action='/pagamentos' text_action='voltar'
            type='secondary' />


        <x-bladewind::card>
            <form method="get" class="flex items-center">
                @csrf

                <x-bladewind::input type="search" name="estagiario_id" id="aluno_id" placeholder="codigo-nome"
                    transparent_suffix="false" prefix="Pesquisar" prefixIsIcon="search" list="lista-estagiarios" />

                <datalist id="lista-estagiarios">

                    @foreach ($estagiarios as $_estagiario)
                        <option value="{{ $_estagiario->id }}">
                            {{ $_estagiario->nome . "----------" . $_estagiario->plano->nome . "-----" . $_estagiario->bi }}
                        </option>
                    @endforeach

                </datalist>

            </form>
        </x-bladewind::card>

        @if ($estagiario)
            <div class="">
                <x-bladewind::card>
                    <div class="flex items-center justify-center w-full bg-yellow-100 p-4 gap-8">


                        <div class="size-32 rounded-full overflow-hidden">
                            <img src="{{ asset("storage/" . $estagiario->foto) }}" alt="foto-aluno"
                                class="transition-transform hover:scale-110 object-cover ease-in-out cursor-pointer ">
                        </div>
                        {{-- end --}}



                        <div class="flex flex-col text-slate-700 max-w-lg">

                            <ul class="flex flex-wrap gap-4">
                                <li class="flex items-center gap-1 font-bold">Nome:<span
                                        class="font-normal  bg-yellow-200 p-1 rounded-md">{{ $estagiario->nome }}</span></li>
                                <li class="flex items-center gap-1 font-bold">Nif/numero de bi:<span
                                        class="font-normal  bg-yellow-200 p-1 rounded-md">{{ $estagiario->bi }}</span></li>
                                <li class="flex items-center gap-1 font-bold">Email:<span
                                        class="font-normal  bg-yellow-200 p-1 rounded-md">{{ $estagiario->email ?? "sem email" }}</span>
                                </li>
                                <li class="flex items-center gap-1 font-bold">telefone:<span
                                        class="font-normal  bg-yellow-200 p-1 rounded-md">{{ $estagiario->tel }}</span></li>
                                <li class="flex items-center gap-1 font-bold">Genero:<span
                                        class="font-normal  bg-yellow-200 p-1 rounded-md">{{ $estagiario->sexo }}</span></li>
                                <li class="flex items-center gap-1 font-bold">instituto de origem:<span
                                        class="font-normal  bg-yellow-200 p-1 rounded-md">{{ $estagiario->instituto_id }}</span>
                                </li>

                                <li class="flex items-center gap-1 font-bold">Idade:<span
                                        class="font-normal  bg-yellow-200 p-1 rounded-md">{{ date('Y') - date('Y', strtotime($estagiario->dt_nascimento)) }}</span>
                                </li>

                                <li class="flex items-center gap-1 font-bold">outro documento:<span
                                        class="font-normal  bg-yellow-200 p-1 rounded-md">{{ $estagiario->documentos }}</span>
                                </li>

                                <li class="flex items-center gap-1 font-bold">codigo do estagiario:<span id="copy-data"
                                        title="copiar"
                                        class="font-normal cursor-pointer  bg-green-200 p-1 rounded-md">{{$estagiario->id}}</span>
                                </li>

                            </ul>

                        </div>

                    </div>
                </x-bladewind::card>
            </div>
        @endif

    </div>

    <x-bladewind::card title="assuntos / pagamentos">

        <form action="/pagamentos/sumarios/criar" method="post" class="ui-form">

            @csrf

            <x-bladewind::input label="Sumario" name="label" required="true" />
            <x-bladewind::input label="Quantia" name="value" required="true" numeric="true" />

            <x-bladewind::button canSubmit="true" title="adicionar">add</x-bladewind::button>


        </form>
    </x-bladewind::card>
    {{-- end --}}

    <x-bladewind::card>
        <form action="/pagamentos/criar" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 ui-form">
            @csrf

            <!-- Aluno -->
            <x-bladewind::input label="Codigo do Estagiario" name="estagiario_id" required="true" type="text" />

            <!-- Método de Pagamento -->
            <x-bladewind::select label="Metodo de Pagamento" name="metodo" required="true" :data="[['label' => 'Trasnferencia', 'value' => 'ATM'], ['label' => 'Multicaixa', 'value' => 'TPA']]" />

            <!-- Método de Pagamento -->
            <x-bladewind::select label="Sumario" multiple="true"  name="sumarios" required="true" max_selectable="10"
                data="{{ json_encode($summary_payments) }}" />



            <!-- Comprovativo -->

            <x-bladewind::filepicker name="comprovativo" accepted_file_types="application/pdf,image/*"
                placeholder_line1="Comprovativo escaneado (pdf)" max_file_size="5mb" placeholder="Selecione o comprovativo"
                required />

            <!-- Usuário logado (hidden ou dropdown se admin) -->
            <input type="hidden" name="usuario_id" value="{{ session()->get('user_id') }}" />

            <!-- Ação -->
            <div class="flex justify-end">
                <x-bladewind::button can_submit="true">Registrar Pagamento</x-bladewind::button>
            </div>
        </form>
    </x-bladewind::card>


    </div>
@endsection