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
                                    <div
                                        class="w-24 h-24 rounded overflow-hidden border cursor-pointer transition-all delay-75 ease-linear hover:scale-150 hover:p-0 bg-white p-4 hover:shadow-md">
                                        <img src="{{ asset('storage/' . $pagamento->estagiario->foto) }}"
                                            alt="Foto do estagiario-" class="w-full h-full object-cover">
                                    </div>
                                </div>

                                <!-- Informações do estagiario- -->
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p><strong>Nome do estagiario-:</strong><br>{{ $pagamento->estagiario->nome }}</p>
                                    </div>
                                    <div>
                                        <p><strong>Email do
                                                estagiario:</strong>
                                            @if($pagamento->estagiario->email)
                                                {{ $pagamento->estagiario->email }}
                                            @else
                                                {!! voidStatus() !!}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Informações do pagamento -->
                                <div class="grid grid-cols-2 gap-4 mb-6">

                                    <div>
                                        <p><strong>Método de Pagamento:</strong><br>{{ $pagamento->metodo }}</p>
                                    </div>

                                    <div>
                                        <p><strong>Descrição:</strong><br> {{ $pagamento->sumarios }}</p>
                                    </div>
                                </div>

                                <!-- Link para comprovativo -->
                                <div class="mt-4">
                                    <strong>Comprovativo</strong><br>


                                    <a href="{{ asset('storage/' . $pagamento->comprovativo) }}" target="_blank"
                                        class="flex items-center gap-1 text-indigo-500 hover:underline p-4">

                                        <i class="bi bi-file-earmark-break"></i>
                                        <span>ver o documento</span>
                                    </a>


                                </div>

                                {{-- gerar recibo --}}

                                <div class="flex items-center justify-end mt-4">
                                    @if($pagamento->fatura)

                                        <form action="/pagamentos/{{ $pagamento->id }}" action="get" target="_blank">
                                            <x-bladewind::button can_submit='true'>gerar fatura</x-bladewind::button>
                                        </form>

                                    @else
                                        <a href="{{asset($pagamento->fatura) }}">
                                            <i class="bi bi-view"></i>
                                            ver a fatura
                                        </a>
                                    @endif
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