@extends('layouts.App')
@section('content')
    @php
        $class_input =
            'appearance-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp

    <div class="mt-20 space-y-10">
        <x-Title-app title='pagamentos > registrar' icon='bi-credit-card' action='/pagamentos' text_action='voltar'
            type='secondary' />


        <x-bladewind::card>
            <form method="get">
                @csrf
                <label for="aluno_id" class="block text-sm font-medium text-slate-600 mb-1">Pesquisar Codigo Aluno</label>
                <div class="flex items-center border border-slate-300 rounded">

                    <input type="number" step="1" name="aluno_id" id="aluno_id" min="1"
                        class="{{ $class_input }}" placeholder="pesquisar aluno por codigo">
                    <x-bladewind::button can_submit='true' class="m-0 rounded-none"> <i
                            class="bi-search"></i></x-bladewind::button>
                </div>
            </form>

            @if ($aluno != null)
                <div class="mt-4">

                    <x-bladewind::card title="resultado da pesquisa">

                        <div class="flex">



                            <div class="text-slate-500">
                                <img class="size-16 object-cover rounded-full mb-4"
                                    src="{{ asset('uploads/' . $aluno->foto) }}" alt="Foto de {{ $aluno->nome }}">

                                <h2 class="text-xl font-bold mb-2">{{ $aluno->nome }}</h2>

                                <ul class="text-sm space-y-1">
                                    <li><strong>ID:</strong> {{ $aluno->id }}</li>
                                    <li><strong>BI:</strong> {{ $aluno->bi }}</li>
                                    <li><strong>Email:</strong> {{ $aluno->email ?: 'Não informado' }}</li>
                                    <li><strong>Telefone:</strong> {{ $aluno->tel ?: 'Não informado' }}</li>
                                    <li><strong>Sexo:</strong> {{ $aluno->sexo }}</li>
                                    <li><strong>Data de nascimento:</strong>
                                        {{ \Carbon\Carbon::parse($aluno->dt_nascimento)->format('d/m/Y') }}</li>
                                    <li><strong>Status:</strong>
                                        <x-bladewind::tag color="{{ $aluno->estatus === 'ON' ? 'green' : 'red' }}"
                                            label='{{ $aluno->estatus }}' />

                                    </li>
                                    <li><strong>Criado em:</strong> {{ $aluno->created_at->format('d/m/Y H:i') }}</li>
                                </ul>
                            </div>


                        </div>


                    </x-bladewind::card>

                </div>
            @endif

        </x-bladewind::card>

        <x-bladewind::card>
            <form action="/pagamentos/criar" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf

                <!-- Aluno -->
                <div>
                    <label for="aluno_id" class="block text-sm font-medium text-slate-600 mb-1">Codigo Aluno<x-obr/></label>
                    <div class="flex items-center border border-slate-300 rounded">
                        <i class="bi-person text-slate-400 p-2"></i>
                        <input type="number" step="0.01" name="aluno_id" id="aluno_id" required min="0"
                            class="{{ $class_input }}" placeholder="1">
                    </div>
                </div>

                <!-- Valor -->
                <div>
                    <label for="valor" class="block text-sm font-medium text-slate-600 mb-1">Valor (KZ)<x-obr/> </label>
                    <div class="flex items-center border border-slate-300 rounded">
                        <i class="bi-cash-coin text-slate-400 p-2"></i>
                        <input type="number" step="0.01" name="valor" id="valor" max="900000" required
                            class="{{ $class_input }}" placeholder="Ex: 15000.00">
                    </div>
                </div>

                <!-- Método de Pagamento -->
                <div>
                    <label for="m_pagamento" class="block text-sm font-medium text-slate-600 mb-1">Método de
                        Pagamento <x-obr/> </label>
                    <div class="flex items-center border border-slate-300 rounded">
                        <i class="bi-wallet2 text-slate-400 p-2"></i>
                        <select name="m_pagamento" id="m_pagamento" required class="{{ $class_input }}">
                            <option value="Transferência">Transferência</option>
                            <option value="Tpa">TPA</option>
                            <option value="dinheiro">dinheiro</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                </div>

                <!-- Referência -->
                <div id='referencia_pagamento'>
                    <label for="referencia" class="block text-sm font-medium text-slate-600 mb-1">Referência<x-obr/> </label>
                    <div class="flex items-center border border-slate-300 rounded">
                        <i class="bi-hash text-slate-400 p-2"></i>
                        <input type="number" name="referencia" id="referencia" step="1" required
                            class="{{ $class_input }}" placeholder="Ex: 20250401001">
                    </div>
                </div>

                <!-- Descrição -->
                <div>
                    <label for="descricao" class="block text-sm font-medium text-slate-600 mb-1">Descrição <x-obr/> </label>
                    <div class="border border-slate-300 rounded">
                        <textarea name="descricao" id="descricao" rows="3" class="w-full p-2 text-slate-500 outline-none resize-none"
                            placeholder="Observações ou detalhes do pagamento..." required></textarea>
                    </div>
                </div>

                <!-- Comprovativo -->
                <div>
                    <label for="comprovativo" class="block text-sm font-medium text-slate-600 mb-1">Comprovativo (PDF ou
                        imagem) <x-obr/> </label>
                    <x-bladewind::filepicker name="comprovativo" accepted_file_types="application/pdf,image/*"
                        max_file_size="5mb" placeholder="Selecione o comprovativo" required />
                </div>

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
