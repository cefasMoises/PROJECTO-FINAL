@extends('layouts.App')
@section('content')
<div class="mt-20 space-y-10">
    {{-- first --}}
    <x-bladewind::card>
        <div class="flex justify-between items-center">
            <h1 class="uppercase text-gray-500"><i class="bi-collection-fill"></i> cursos</h1>
            <x-bladewind::button onclick="showModal('curso')">criar novo</x-bladewind::button>
        </div>
    </x-bladewind::card>
    {{-- end title section --}}
    <x-bladewind::card>
        <x-bladewind::table has_border=true searchable=true>
            <x-slot name='header'>
                <tr class="text-center">
                    <th>Code</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Opções</th>
                </tr>
            </x-slot>
            {{-- end --}}
            @isset($cursos)
            @foreach ($cursos as $curso)
            <tr>
                <td>{{$curso->id}}</td>
                <td>{{$curso->nome}}</td>
                <td>{{$curso->descricao}}</td>
                <td>
                    <div class="flex gap-2">
                        <x-bladewind::button color="red" onclick="showModal('{{ $curso->id }}')"><i class="bi-trash"></i></x-bladewind::button>
                        {{-- end --}}
                        <x-bladewind::button color='green' onclick="showModal('{{ $curso->id }}edit')"><i class="bi-pencil"></i></x-bladewind::button>
                        <x-bladewind::button color="blue" tag='a' href="/cursos/alunos/{{ $curso->id }}"><i class="bi-people"></i></x-bladewind::button>
                        {{-- end --}}
                    </div>
                </td>
            </tr>
            {{-- end --}}
            <x-bladewind::modal name="{{ $curso->id }}" show_action_buttons=false>
                <div class="flex flex-col items-center justify-center">
                    <form action="/cursos/deletar/{{ $curso->id }}" method="get">
                        @csrf
                        <i class="bi-trash text-4xl size-12 flex justify-center items-center bg-red-500/50 text-red-500 rounded-full mb-2"></i>
                        <h1>quer eliminar o curso</h1>
                        <h2>{{ $curso->nome }} ?</h2>
                        <div class="flex gap-4 mt-4">
                            <x-bladewind::button type="secondary" onclick="hideModal('{{ $curso->id }}')">não</x-bladewind::button>
                            <x-bladewind::button can_submit=true>sim</x-bladewind::button>
                        </div>
                    </form>
                </div>
            </x-bladewind::modal>
            {{-- end modal delete --}}
            <x-bladewind::modal name="{{ $curso->id }}edit" show_action_buttons=false size='large'>
                <x-bladewind::card>
                    <div>
                        <form action="/cursos/atualizar" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $curso->id }}">
                            {{-- id element --}}
                            <div class="flex flex-col justify-center items-center text-gray-600 mb-4">
                                <i class="bi-collection-fill text-4xl"></i>
                                <h1>Editar curso</h1>
                            </div>
                            {{-- end --}}
                            <x-bladewind::input type="text" label='Nome' name='nome' required value="{{ $curso->nome }}" />
                                {{-- end --}}
                            <textarea label='Descrição' name='descricao' class="resize-none min-h-32 border-slate-200 border-2 rounded-md text-slate-500 text-justify">{{$curso->descricao}} 
                            </textarea>
                            {{-- end select radius --}}
                            <div class="flex justify-end gap-4 mt-2">
                                <x-bladewind::button type='secondary' onclick="hideModal('{{ $curso->id }}edit')">cancelar</x-bladewind::button>
                                <x-bladewind::button can_submit=true>confirmar</x-bladewind::button>
                            </div>
                        </form>
                    </div>
                </x-bladewind::card>
            </x-bladewind::modal>
            {{-- end modal edit --}}
            @endforeach
            @endisset
            {{-- end --}}
            <x-bladewind::modal name="curso" show_action_buttons=false size='large'>
                <x-bladewind::card>
                    <div>
                        <form action="/cursos/criar" method="post">
                            @csrf
                            <div class="flex flex-col justify-center items-center text-gray-600 mb-4">
                                <i class="bi-people-fill text-4xl"></i>
                                <h1>Registrar curso</h1>
                            </div>
                            {{-- end --}}
                            <x-bladewind::input type="text" label='Nome' name='nome' required />
                            <x-bladewind::textarea label='Descrição' name='descricao' />
                            <div class="flex justify-end gap-4 mt-2">
                                <x-bladewind::button type='secondary' onclick="hideModal('curso')">cancelar</x-bladewind::button>
                                <x-bladewind::button can_submit=true>confirmar</x-bladewind::button>
                            </div>
                        </form>
                    </div>
                </x-bladewind::card>
            </x-bladewind::modal>
            {{-- end modal form --}}
        </x-bladewind::table>
    </x-bladewind::card>
</div>
@endsection
