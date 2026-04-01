@extends('layouts.App')
@section('content')
    <div class="mt-20 space-y-10">
        {{-- first --}}
        <x-bladewind::card>
            <div class="flex justify-between items-center">
                <h1 class="uppercase text-gray-500"><i class="bi-collection-fill"></i> turmas</h1>
                <x-bladewind::button onclick="showModal('turma')">criar novo</x-bladewind::button>
            </div>
        </x-bladewind::card>
        {{-- end title section --}}
        <x-bladewind::card>
            <x-bladewind::table has_border=true searchable=true>
                <x-slot name='header'>
                    <tr class="text-center">
                        <th>Code</th>
                        <th>Nome</th>
                        <th>quantidade Alunos</th>
                        <th>Curso</th>
                        <th>estatus</th>
                        <th>Opções</th>
                    </tr>
                </x-slot>
                {{-- end --}}
                @isset($turmas)
                    @forelse ($turmas as $turma)
                        <tr>
                            <td>{{$turma->id}}</td>
                            <td>{{$turma->nome}}</td>
                            <td>{{$turma->alunos->count()}}/{{$turma->qtd_aluno}}</td>
                            <td>{{$turma->curso->nome}}</td>
                            <td>{{$turma->estatus}}</td>
                            <td>
                                <div class="flex gap-2">

                                    @if(session()->get('acesso') == 'admin')
                                        <x-bladewind::button color="red" onclick="showModal('{{ $turma->id }}')"><i
                                                class="bi-trash"></i></x-bladewind::button>
                                        {{-- end --}}
                                        <x-bladewind::button color='green' onclick="showModal('{{ $turma->id }}edit')"><i
                                                class="bi-pencil"></i></x-bladewind::button>
                                        {{-- end --}}
                                    @endif
                                    <x-bladewind::button color='blue' tag='a' href='/turmas/alunos/{{ $turma->id }}'><i
                                            class="bi-person-add"></i></x-bladewind::button>
                                </div>
                            </td>
                        </tr>
                        {{-- end --}}
                        <x-bladewind::modal name="{{ $turma->id }}" show_action_buttons=false>
                            <div class="flex flex-col items-center justify-center">
                                <form action="/turmas/deletar/{{ $turma->id }}" method="get">
                                    @csrf
                                    <i
                                        class="bi-trash text-4xl size-12 flex justify-center items-center bg-red-500/50 text-red-500 rounded-full mb-2"></i>
                                    <h1>quer eliminar o turma</h1>
                                    <h2>{{ $turma->nome }} ?</h2>
                                    <div class="flex gap-4 mt-4">
                                        <x-bladewind::button type="secondary"
                                            onclick="hideModal('{{ $turma->id }}')">não</x-bladewind::button>
                                        <x-bladewind::button can_submit=true>sim</x-bladewind::button>
                                    </div>
                                </form>
                            </div>
                        </x-bladewind::modal>
                        {{-- end modal delete --}}
                        <x-bladewind::modal name="{{ $turma->id }}edit" show_action_buttons=false size='large'>
                            <x-bladewind::card>
                                <div>
                                    <form action="/turmas/atualizar" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $turma->id }}">
                                        {{-- id element --}}
                                        <div class="flex flex-col justify-center items-center text-gray-600 mb-4">
                                            <i class="bi-collection-fill text-4xl"></i>
                                            <h1>Editar turma</h1>
                                        </div>
                                        {{-- end --}}
                                        <x-bladewind::input type="text" label='Nome' name='nome' required
                                            value="{{ $turma->nome }}" />
                                        <x-bladewind::input numeric=true label='numero maximo de alunos' name='qtd_aluno' min=8
                                            value="{{ $turma->qtd_aluno}}" />
                                        {{-- end --}}
                                        <x-bladewind::card>
                                            <h1 class="">Cursos</h1>
                                            <div class="flex flex-wrap p-2">
                                                @foreach($cursos as $item)
                                                    @if($item->id == $turma->curso_id)
                                                        <x-bladewind::radio label="{{ $item->nome }}" value="{{$item->id}}" name='curso'
                                                            checked=true />
                                                    @else
                                                        <x-bladewind::radio label="{{ $item->nome }}" value="{{$item->id}}" name='curso' />
                                                    @endif
                                                @endforeach
                                            </div>
                                        </x-bladewind::card>
                                        <div class="flex justify-end gap-4 mt-2">
                                            <x-bladewind::button type='secondary'
                                                onclick="hideModal('{{ $turma->id }}edit')">cancelar</x-bladewind::button>
                                            <x-bladewind::button can_submit=true>confirmar</x-bladewind::button>
                                        </div>
                                    </form>
                                </div>
                            </x-bladewind::card>
                        </x-bladewind::modal>
                        {{-- end modal edit --}}
                    @empty


                        <tr class="w-full">

                            <td colspan="6">
                                <x-empty-state />
                            </td>

                        </tr>




                    @endforelse




                @endisset
                {{-- end --}}
                <x-bladewind::modal name="turma" show_action_buttons=false size='large'>
                    <x-bladewind::card>
                        <div>
                            <form action="/turmas/criar" method="post">
                                @csrf
                                <div class="flex flex-col justify-center items-center text-gray-600 mb-4">
                                    <i class="bi-people-fill text-4xl"></i>
                                    <h1>Registrar turma</h1>
                                </div>
                                {{-- end --}}
                                <x-bladewind::input type="text" label='Nome' name='nome' required />
                                <x-bladewind::input numeric=true label='numero maximo de alunos' name='qtd_aluno' min=8 />
                                {{-- end --}}
                                <x-bladewind::card>
                                    <h1 class="">Cursos</h1>
                                    <div class="flex flex-wrap p-2">
                                        @foreach($cursos as $item)
                                            <x-bladewind::radio label="{{ $item->nome }}" value="{{$item->id}}" name='curso' />
                                        @endforeach
                                    </div>
                                </x-bladewind::card>
                                <div class="flex justify-end gap-4 mt-2">
                                    <x-bladewind::button type='secondary'
                                        onclick="hideModal('turma')">cancelar</x-bladewind::button>
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