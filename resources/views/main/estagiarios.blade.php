@extends('layouts.App')

@section('content')
    <div class="mt-20 space-y-10">

        {{-- Title Section --}}
        <x-Title-app title="Estagiários" icon="bi-people-fill" action="/estagiarios/form" />

        {{-- Table Section --}}
        <x-bladewind::card>
            <x-bladewind::table has_border=true searchable=true>
                <x-slot name="header">
                    <tr class="text-center">
                        <th>Nº de Processo</th>
                        <th>Nome</th>
                        <th>Instituto</th>
                        <th>Plano de Estágio</th>
                        <th>Data de Emissão</th>
                        <th>Opções</th>
                    </tr>
                </x-slot>

                @php
                    $count = 1;
                @endphp
                {{-- Table Rows --}}
                @forelse ($estagiarios as $estagiario)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $estagiario->nome }}</td>
                        <td>{{ $estagiario->instituto->nome ?? 'individual' }}</td>
                        <td>{{ $estagiario->plano->nome ?? '' }}</td>
                        <td>{{ $estagiario->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="flex gap-2">
                                {{-- Delete Button --}}
                                <x-bladewind::button title="deletar" color="red" onclick="showModal('{{ $estagiario->id }}')">
                                    <i class="bi-trash"></i>
                                </x-bladewind::button>

                                {{-- Edit Button --}}
                                <x-bladewind::button title="editar" tag="a" color="green"
                                    href="/estagiarios/{{ $estagiario->id }}">
                                    <i class="bi-pencil"></i>
                                </x-bladewind::button>
                            </div>
                        </td>
                    </tr>

                    {{-- Delete Modal --}}
                    <x-bladewind::modal name="{{ $estagiario->id }}" show_action_buttons=false>
                        <div class="flex flex-col items-center justify-center">
                            <form action="/estagiarios/deletar" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $estagiario->id }}">
                                <i
                                    class="bi-trash text-4xl size-12 flex justify-center items-center bg-red-500/50 text-red-500 rounded-full mb-2"></i>
                                <h1>Deseja excluir o estagiário?</h1>
                                <h2>{{ $estagiario->nome }} ?</h2>
                                <div class="flex gap-4 mt-4">
                                    <x-bladewind::button type="secondary"
                                        onclick="hideModal('{{ $estagiario->id }}')">Não</x-bladewind::button>
                                    <x-bladewind::button can_submit=true>Sim</x-bladewind::button>
                                </div>
                            </form>
                        </div>
                    </x-bladewind::modal>

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