@extends('layouts.App')
@section('content')
    <div class="mt-20 space-y-10">
        {{-- first --}}
        <x-Title-App title="alunos" icon="bi bi-person" action="/alunos/form" />
        {{-- end title section --}}
        <x-bladewind::card>
            <x-bladewind::table has_border=true searchable=true>
                <x-slot name='header'>
                    <tr class="text-center">
                        <th>nº de processo</th>
                        <th>Nome</th>
                        <th>curso</th>
                        <th>estatus</th>
                        <th>data emi</th>
                        <th>Opções</th>
                    </tr>
                </x-slot>
                {{-- end --}}
                @isset($alunos)
                    @foreach ($alunos as $aluno)
                        <tr>

                            <td>{{ $aluno->id }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->cursos()->get()[0]->nome}}</td>


                            <td><x-bladewind::tag label='{{ $aluno->estatus }}'
                                    color="{{ $aluno->estatus == 'ON' ? 'green' : 'red' }}" /></td>

                            <td>{{ $aluno->created_at->format('d/m/y') }}</td>
                            <td>
                                <div class="flex gap-2">
                                    <x-bladewind::button color="slate" onclick="showModal('{{ $aluno->id }}')"><i
                                            class="bi-trash"></i></x-bladewind::button>
                                    {{-- end --}}
                                    <x-bladewind::button tag='a' href="/alunos/{{ $aluno->id }}"><i
                                            class="bi-pencil"></i></x-bladewind::button>
                                    {{-- end --}}

                                </div>
                            </td>
                        </tr>
                        {{-- end --}}
                        <x-bladewind::modal name="{{ $aluno->id }}" show_action_buttons=false>
                            <div class="flex flex-col items-center justify-center">
                                <form action="/alunos/deletar/{{ $aluno->id }}" method="get">
                                    @csrf
                                    <i
                                        class="bi-trash text-4xl size-12 flex justify-center items-center bg-red-500/50 text-red-500 rounded-full mb-2"></i>
                                    <h1>quer eliminar o aluno</h1>
                                    <h2>{{ $aluno->nome }} ?</h2>
                                    <div class="flex gap-4 mt-4">
                                        <x-bladewind::button type="secondary"
                                            onclick="hideModal('{{ $aluno->id }}')">não</x-bladewind::button>
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
        {{-- end --}}


        @if (sizeof($alunos) <= 0)
            <x-Nodata text='sem alunos' />
        @endif
        {{-- end --}}
    </div>
@endsection
