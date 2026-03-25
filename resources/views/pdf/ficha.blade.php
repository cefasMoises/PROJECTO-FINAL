<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Recibo de Pagamento</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid #ccc;
        }

        .no-border {
            border: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .header {
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Dados da Escola -->
    <table class="no-border">
        <tr>
            <td class="no-border">
                <div class="header">
                    <h1>instituto medio politecnico do Bengo </h1>
                    <p>NIF: 123456789 | Luanda – Angola</p>
                    <p>Email: bengo@escola.com | Tel: +244 999 999 999</p>
                </div>

            </td>
            <td class="no-border text-right">
                <strong>Recibo Nº:</strong> {{ $pagamento->id }}<br>
                <strong>Data:</strong> {{ $pagamento->created_at->format('d/m/Y') }}
            </td>
        </tr>
    </table>

    <hr>

    <!-- Dados do Aluno -->
    <table>
        <tr>
            <th colspan="3">Dados do Aluno</th>
        </tr>
        <tr>
            <td><strong>Nome:</strong> {{ $pagamento->aluno->nome }}</td>
            <td><strong>Email:</strong> {{ $pagamento->aluno->email ?? "sem email"}}</td>
            <td><strong>Telefone:</strong> {{ $pagamento->aluno->tel }}</td>

        </tr>
        <tr>
            <td><strong>Curso:</strong> {{ $pagamento->aluno->cursos()->get()[0]->nome }}</td>


        </tr>

    </table>

    <!-- Detalhes do Pagamento -->
    <table>
        <tr>
            <th colspan="2">Detalhes do Pagamento</th>
        </tr>
        <tr>
            <td><strong>Valor:</strong></td>
            <td>{{ number_format($pagamento->valor, 2, ',', '.') }} KZ</td>
        </tr>
        <tr>
            <td><strong>Método de Pagamento:</strong></td>
            <td>{{ $pagamento->m_pagamento }}</td>
        </tr>
        <tr>
            <td><strong>Referência:</strong></td>
            <td>{{ $pagamento->referencia }}</td>
        </tr>
        <tr>
            <td><strong>Descrição:</strong></td>
            <td>{{ $pagamento->descricao }}</td>
        </tr>
        <tr>
            <td><strong>Usuário Responsável:</strong></td>
            <td>{{ $pagamento->usuario->nome ?? 'N/A' }}</td>
        </tr>
    </table>


    <!-- Rodapé -->
    <table class="no-border">
        <tr>
            <td class="no-border text-center">
                <small>Documento gerado automaticamente em {{ now()->format('d/m/Y H:i') }}.</small>
            </td>
        </tr>
    </table>

</body>

</html>