@extends('layouts.App')

@section('content')
    <div class="mt-20 space-y-10">

        <x-Title-app 
            title="Lista de Certificados"
            icon="bi-card-text"
            text_action="Voltar"
            action="/desempenho"
            type="secondary" 
        />

        @foreach ($turmas as $turma)
            <x-bladewind::card title="{{ $turma->nome }} / {{ $turma->curso->nome }}">

                <x-bladewind::table has_border="true">
                    <x-slot name="header">
                        <tr>
                            <th>Nº</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Média</th>
                            <th>Opções</th>
                        </tr>
                    </x-slot>

                    @foreach ($turma->alunos()->with('notas')->get() as $index => $aluno)
                        @php
                            $media = $aluno->notas->count() > 0 
                                ? $aluno->notas->avg('valor') 
                                : 0;
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->tel }}</td>
                            <td>{{ number_format($media, 1) }}</td>
                            <td>
                                @if ($media > 0)
                                    <x-bladewind::button 
                                        tag="a"
                                        href="/certificados/{{ $aluno->id }}" 
                                        target="_blank"
                                    >
                                        Gerar
                                    </x-bladewind::button>
                                    @else
                                    <x-bladewind::tag label='indisponivel'/>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </x-bladewind::table>
            </x-bladewind::card>
        @endforeach

    </div>
@endsection
