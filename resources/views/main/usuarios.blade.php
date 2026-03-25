@extends('layouts.App')
@section('content')
    <div class="mt-20 space-y-10">
        {{-- first --}}
        <x-Title-app title='usuarios' action='/usuarios/form' icon='bi bi-people-fill' />


        {{-- end title section --}}
        <x-bladewind::card>
            <x-bladewind::table has_border=true searchable=true>
                <x-slot name='header'>
                    <tr class="text-center">
                        <th>email</th>
                        <th>Nome</th>
                        <th>acesso</th>
                        <th>estatus</th>
                        <th>Opções</th>
                        <th>senha</th>

                    </tr>
                </x-slot>
                {{-- end --}}
                @isset($usuarios)
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->nome }}</td>
                            <td>{{ $usuario->acesso }}</td>

                            @if ($usuario->estatus == 'ON')
                                <td><x-bladewind::tag color='green' label="{{ $usuario->estatus }}" /></td>
                            @else
                                <td><x-bladewind::tag color='red' label="{{ $usuario->estatus }}" /></td>
                            @endif
                            <td>
                                <div class="flex gap-2">

                                    <x-bladewind::button title="deletar" color="slate" onclick="showModal('{{ $usuario->id }}')"><i
                                            class="bi-trash"></i></x-bladewind::button>

                                    {{-- end --}}
                                    <x-bladewind::button title="editar" tag='a' color='blue'
                                        href="/usuarios/editar/{{ $usuario->id }}"><i class="bi-pencil"></i></x-bladewind::button>

                                    <x-bladewind::button title="alterar a senha" tag="a" href="/usuarios/senha/{{ $usuario->id }}" color="green"><i
                                            class="bi-lock"></i></x-bladewind::button>

                                </div>
                            </td>

                        </tr>
                        {{-- end --}}
                        <x-bladewind::modal name="{{ $usuario->id }}" show_action_buttons=false>
                            <div class="flex flex-col items-center justify-center">
                                <form action="/usuarios/deletar/{{ $usuario->id }}" method="get">
                                    @csrf
                                    <i
                                        class="bi-trash text-4xl size-12 flex justify-center items-center bg-red-500/50 text-red-500 rounded-full mb-2"></i>
                                    <h1>quer eliminar o usuario</h1>
                                    <h2>{{ $usuario->nome }} ?</h2>
                                    <div class="flex gap-4 mt-4">
                                        <x-bladewind::button type="secondary"
                                            onclick="hideModal('{{ $usuario->id }}')">não</x-bladewind::button>
                                        <x-bladewind::button can_submit=true>sim</x-bladewind::button>
                                    </div>
                                </form>
                            </div>
                        </x-bladewind::modal>
                        {{-- end modal delete --}}
                    @endforeach
                @endisset
                {{-- end --}}

            </x-bladewind::table>
        </x-bladewind::card>
    </div>
@endsection