@extends('layouts.App')
@section('content')
    <div class="mt-20 space-y-10">
        {{-- first --}}
        <x-Title-App title="Planos de estagio > registrar" icon="bi bi-journal" action="/planos/form" />
        {{-- end title section --}}
        <x-bladewind::card>
            <x-bladewind::table has_border=true searchable=true>
                <x-slot name='header'>
                    <tr class="text-center">
                        <th>Code</th>
                        <th>Nome</th>
                        <th>curso</th>
                        <th>Duraçao/M</th>
                        <th>Opções</th>
                    </tr>
                </x-slot>
                {{-- end --}}
                @if ($planos != null)
                    @foreach ($planos as $plano)
                        <tr>
                            <td>{{ $plano->id }}</td>
                            <td>{{ $plano->nome }}</td>
                            <td>{{ $plano->curso->nome }}</td>
                            <td>{{ $plano->duracao }}/mes</td>


                            <td>
                                <div class="flex gap-2">
                                    <x-bladewind::button color="slate" onclick="showModal('{{ $plano->id }}')"><i
                                            class="bi-trash"></i></x-bladewind::button>
                                    {{-- end --}}
                                    <x-bladewind::button tag='a' href="/planos/{{ $plano->id }}"><i
                                            class="bi-pencil"></i></x-bladewind::button>

                                    {{-- end --}}
                                </div>
                            </td>
                        </tr>
                        {{-- end --}}
                        <x-bladewind::modal name="{{ $plano->id }}" show_action_buttons=false>
                            <div class="flex flex-col items-center justify-center">
                                <form action="/planos/deletar/" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $plano->id }}">
                                    <i
                                        class="bi-trash text-4xl size-12 flex justify-center items-center bg-red-500/50 text-red-500 rounded-full mb-2"></i>
                                    <h1>quer eliminar o plano</h1>
                                    <h2>{{ $plano->nome }} ?</h2>
                                    <div class="flex gap-4 mt-4">
                                        <x-bladewind::button type="secondary"
                                            onclick="hideModal('{{ $plano->id }}')">não</x-bladewind::button>
                                        <x-bladewind::button can_submit=true>sim</x-bladewind::button>
                                    </div>
                                </form>
                            </div>
                        </x-bladewind::modal>
                        {{-- end modal delete --}}
                        <x-bladewind::modal name="{{ $plano->id }}edit" show_action_buttons=false size='large'>
                            <x-bladewind::card>
                                <div>
                                    <form action="/planos/atualizar" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $plano->id }}">
                                        {{-- id element --}}
                                        <div class="flex flex-col justify-center items-center text-gray-600 mb-4">
                                            <i class="bi-collection-fill text-4xl"></i>
                                            <h1>Editar plano</h1>
                                        </div>
                                        {{-- end --}}
                                        <x-bladewind::input type="text" label='Nome' name='nome' required
                                            value="{{ $plano->nome }}" />
                                        {{-- end --}}
                                        <textarea label='Descrição' name='descricao'
                                            class="resize-none min-h-32 border-slate-200 border-2 rounded-md text-slate-500 text-justify">{{ $plano->descricao }}
                            </textarea>
                                        {{-- end select radius --}}
                                        <div class="flex justify-end gap-4 mt-2">
                                            <x-bladewind::button type='secondary'
                                                onclick="hideModal('{{ $plano->id }}edit')">cancelar</x-bladewind::button>
                                            <x-bladewind::button can_submit=true>confirmar</x-bladewind::button>
                                        </div>
                                    </form>
                                </div>
                            </x-bladewind::card>
                        </x-bladewind::modal>
                        {{-- end modal edit --}}
                    @endforeach
                @endif
                {{-- end --}}

            </x-bladewind::table>
        </x-bladewind::card>
    </div>
@endsection
