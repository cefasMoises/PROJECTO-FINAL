@extends('layouts.App')
@section('content')
    <div class="mt-20 space-y-10">
        {{-- first --}}
        <x-Title-App title="Instrutores" icon="bi bi-person" action="/instrutores/form" />

        {{-- end title section --}}
        <x-bladewind::card>
            <x-bladewind::table has_border=true searchable=true>
                <x-slot name='header'>
                    <tr class="text-center">
                        <th>nº de processo</th>
                        <th>Nome</th>
                        <th>curso</th>
                        <th>data emi</th>
                        <th>Opções</th>
                    </tr>
                </x-slot>
                {{-- end --}}
                @isset($instrutores)
                    @foreach ($instrutores as $instrutor)
                        <tr>
    
                            <td>{{ $instrutor->id }}</td>
                            <td>{{ $instrutor->nome }}</td>
                            <td>{{ $instrutor->cursos()->get()[0]->nome }}</td>
                            <td>{{ $instrutor->created_at }}</td>
                            <td>
                                <div class="flex gap-2">
                                    <x-bladewind::button color="red" onclick="showModal('{{ $instrutor->id }}')"><i
                                            class="bi-trash"></i></x-bladewind::button>
                                    {{-- end --}}
                                    <x-bladewind::button tag='a' color='green' href="/instrutores/{{ $instrutor->id }}"><i
                                            class="bi-pencil"></i></x-bladewind::button>
                                    {{-- end --}}

                                </div>
                            </td>
                        </tr>
                        {{-- end --}}
                        <x-bladewind::modal name="{{ $instrutor->id }}" show_action_buttons=false>
                            <div class="flex flex-col items-center justify-center">
                                <form action="/instrutores/deletar/{{ $instrutor->id }}" method="get">
                                    @csrf
                                    <i
                                        class="bi-trash text-4xl size-12 flex justify-center items-center bg-red-500/50 text-red-500 rounded-full mb-2"></i>
                                    <h1>quer eliminar o instrutor</h1>
                                    <h2>{{ $instrutor->nome }} ?</h2>
                                    <div class="flex gap-4 mt-4">
                                        <x-bladewind::button type="secondary"
                                            onclick="hideModal('{{ $instrutor->id }}')">não</x-bladewind::button>
                                        <x-bladewind::button can_submit=true>sim</x-bladewind::button>
                                    </div>
                                </form>
                            </div>
                        </x-bladewind::modal>
                        {{-- end modal delete --}}
                    @endforeach
                @endisset
                {{-- end --}}

                {{-- end modal form --}}
            </x-bladewind::table>
        </x-bladewind::card>
    </div>
@endsection
