@extends('layouts.App')

@section('content')


    <div class="mt-20 space-y-10">

        {{-- first --}}
        <x-bladewind::card>
            <div class="flex justify-between items-center">
                <h1 class="uppercase text-gray-500"><i class="bi-collection-fill"></i> Institutos</h1>
                <x-bladewind::button tag='a' href='/institutos/form'>criar novo</x-bladewind::button>
            </div>
        </x-bladewind::card>
        {{-- end title section --}}

        <x-bladewind::card>


            <x-bladewind::table>
                <x-slot name='header'>
                    <tr>
                        <th>code</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>nif</th>
                        <th>opções</th>
                    </tr>
                </x-slot>

                @if (sizeof($institutos) > 0 || $institutos != null)
                    @foreach ($institutos as $instituto)
                        <tr>

                            <td>{{ $instituto->id }}</td>
                            <td>{{ $instituto->nome }}</td>
                            <td>{{ $instituto->email }}</td>
                            <td>{{ $instituto->nif }}</td>

                            <td>
                                <div class="flex gap-2">
                                    <x-bladewind::button color="red" onclick="showModal('{{ $instituto->id }}')"><i
                                            class="bi-trash"></i></x-bladewind::button>
                                    {{-- end --}}
                                    <x-bladewind::button tag='a' color='green'
                                        href="/institutos/{{ $instituto->id }}"><i
                                            class="bi-pencil"></i></x-bladewind::button>
                                    {{-- end --}}

                                </div>
                            </td>
                        </tr>



                        <x-bladewind::modal name="{{ $instituto->id }}" show_action_buttons=false>
                            <div class="flex flex-col items-center justify-center">
                                <form action="/institutos/deletar/" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $instituto->id }}">
                                    <i
                                        class="bi-trash text-4xl size-12 flex justify-center items-center bg-red-500/50 text-red-500 rounded-full mb-2"></i>
                                    <h1>quer eliminar o aluno</h1>
                                    <h2>{{ $instituto->nome }} ?</h2>
                                    <div class="flex gap-4 mt-4">
                                        <x-bladewind::button type="secondary"
                                            onclick="hideModal('{{ $instituto->id }}')">não</x-bladewind::button>
                                        <x-bladewind::button can_submit=true>sim</x-bladewind::button>
                                    </div>
                                </form>
                            </div>
                        </x-bladewind::modal>
                        {{-- end modal delete --}}
                    @endforeach
                @endif
            </x-bladewind::table>

        </x-bladewind::card>
    </div>

@endsection
