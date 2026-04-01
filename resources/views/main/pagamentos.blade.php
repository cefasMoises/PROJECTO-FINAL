@extends('layouts.App')
@section('content')
    @php
        $class_input =
            'apaerence-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp
    <div class="mt-20 space-y-10">
        <x-Title-app title='pagamentos' icon='bi-credit-card' action='/pagamentos/form' />
        {{-- end --}}

        <x-bladewind::card>
            <x-bladewind::table searchable='true'>

                <x-slot name="header">
                    <tr>
                        <th>Indice</th>
                        <th>Cliente</th>
                        <th>Plano/estagio</th>
                        <th>Sumarios</th>
                        <th>valor/total</th>
                        <th>data de emição</th>
                        <th>opções</th>
                    </tr>
                </x-slot>

                @php
                    $count = 1;
                @endphp
                @forelse ($pagamentos as $pagamento)
                    <tr>

                        <td>{{ $count++ }}</td>
                        <td>{{ $pagamento->estagiario->nome }}</td>
                        <td>{{ $pagamento->estagiario->plano->nome }}</td>
                        <td>{{ $pagamento->sumarios}}</td>
                        <td>{{ $pagamento->valor . ' kz' }}</td>
                        <td>{{ $pagamento->created_at->format('d-m-Y') }}</td>
                     

                        <td><x-bladewind::button onclick="showModal('{{ $pagamento->id }}')"><i
                                    class="bi bi-file-text"></i></x-bladewind::button></td>


                        <x-bladewind::modal size="large" name="{{ $pagamento->id }}" show_action_buttons='false'>
                            <div class="p-6 text-gray-800 text-sm font-sans">
                                <!-- Cabeçalho com dados e foto -->
                                <div class="flex items-center justify-between mb-6 border-b pb-4">
                                    <div>
                                        <h2 class="text-xl font-semibold text-gray-900 mb-1">Comprovante de Pagamento
                                        </h2>
                                        <p><strong>Emitido em:</strong>
                                            {{ $pagamento->created_at->format('d/m/Y H:i') }}</p>
                                        <p><strong>Agente:</strong> #{{ $pagamento->usuario->nome }}</p>
                                    </div>
                                    <div class="w-24 h-24 rounded overflow-hidden border">
                                        <img src="{{ asset('uploads/' . $pagamento->estagiario->foto) }}"
                                            alt="Foto do estagiario-" class="w-full h-full object-cover">
                                    </div>
                                </div>

                                <!-- Informações do estagiario- -->
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p><strong>Nome do estagiario-:</strong><br>{{ $pagamento->estagiario->nome }}</p>
                                    </div>
                                    <div>
                                        <p><strong>Email do estagiario-:</strong><br>{{ $pagamento->estagiario->email }}</p>
                                    </div>
                                </div>

                                <!-- Informações do pagamento -->
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p><strong>Valor
                                                Pago:</strong><br>{{ number_format($pagamento->valor, 2, ',', '.') }}
                                            KZ</p>
                                    </div>
                                    <div>
                                        <p><strong>Método de Pagamento:</strong><br>{{ $pagamento->m_pagamento }}</p>
                                    </div>
                                    <div>
                                        <p><strong>Referência:</strong><br>{{ $pagamento->referencia }}</p>
                                    </div>
                                    <div>
                                        <p><strong>Descrição:</strong><br>{{ $pagamento->descricao }}</p>
                                    </div>
                                </div>

                                <!-- Link para comprovativo -->
                                <div class="mt-4">
                                    <strong>Comprovativo de Pagamento:</strong><br>
                                    <a href="{{ asset('../store/' . $pagamento->comprovativo) }}" target="_blank"
                                        class="text-blue-600 underline hover:text-blue-800">
                                        Visualizar Comprovativo
                                    </a>
                                </div>

                                {{-- gerar recibo --}}
                                <div class="flex items-center justify-end mt-4">

                                    <form action="/pagamentos/{{ $pagamento->id }}" action="get" target="_blank">
                                        <x-bladewind::button can_submit='true'>gerar fatura</x-bladewind::button>
                                    </form>
                                </div>
                            </div>
                        </x-bladewind::modal>


                    </tr>

                @empty

                    <tr>
                        <td colspan="6">

                            <x-empty-state />
                        </td>
                    </tr>



                @endforelse

            </x-bladewind::table>
        </x-bladewind::card>

    </div>
@endsection