@extends('layouts.App')
@section('content')
<div class="mt-20 space-y-10">
    <x-bladewind::card>
        <div class="flex justify-between items-center">
            <h1 class="uppercase text-gray-500"><i class="bi-collection-fill"></i> cursos = {{ $curso->nome }} = Alunos</h1>
            <x-bladewind::button tag='a' type="secondary" href='/cursos/'>voltar</x-bladewind::button>
        </div>
    </x-bladewind::card>
    {{-- end --}}
    <x-bladewind::card>
        <x-bladewind::table searchable=true>
            <thead>
                <tr>
                    <th>code</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>tel</th>
                    <th>Genero</th>
                    <th>estatus</th>
                    <th>total alunos: {{ $alunos->count()}}</th>
                </tr>
            </thead>
            {{-- end --}}
            <tbody>
                @foreach ($alunos as $aluno)
                <tr>
                    <td>{{$aluno->id}}</td>
                    <td>{{$aluno->nome}}</td>
                    <td>{{$aluno->email}}</td>
                    <td>{{$aluno->tel}}</td>
                    <td>{{$aluno->sexo}}</td>
                    <td>
                        <x-bladewind::tag color="green" label="{{$aluno->estatus}}" />
                    </td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </x-bladewind::table>
    </x-bladewind::card>
</div>
@endsection
