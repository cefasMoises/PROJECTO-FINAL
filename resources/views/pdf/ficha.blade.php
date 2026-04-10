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

        .header-col {
            background-color: #EEEEEE;

        }
    </style>
</head>

<body>

    <!-- Dados da Escola -->
    <table class="no-border">
        <tr>
            <td class="no-border">
                <div class="header">
                    <h2>Instituto Politecnico Médio do Bengo </h2>
                    <h3>Recibo de cliente </h3>
                    <p>NIF: 003456789 | Bengo – Angola</p>
                    <p>Email: bengo@escola.com | Tel: +244 939 929 499</p>
                </div>

            </td>
            <td class="no-border text-right">
                <strong>Recibo Nº:</strong> {{ $pagamento->id }}<br>
                <strong>Data:</strong> {{ $pagamento->created_at->format('d/m/Y') }}
            </td>
        </tr>
    </table>


    <!-- Dados do estagiario -->
    <table>
        <tr class="header-col">
            <th colspan="3">Dados do estagiario</th>
        </tr>
        <tr>
            <td><strong>Nome:</strong> {{ $pagamento->estagiario->nome }}</td>
            <td><strong>Email:</strong> {{ $pagamento->estagiario->email ?? "N/A"}}</td>
            <td><strong>Telefone:</strong> {{ $pagamento->estagiario->tel }}</td>

        </tr>
        <tr>
            <td><strong>Curso:</strong> {{ $pagamento->estagiario->plano->get()[0]->nome }}</td>

            <td><strong>Codigo:</strong> {{$pagamento->estagiario->id}}</td>

            <td><strong>Outos:</strong> N/A</td>
        </tr>

    </table>

    <!-- Detalhes do Pagamento -->
    <table>
        <tr class="header-col">
            <th colspan="2">Detalhes do Pagamento</th>
        </tr>

        <tr>
            @php

                $sumarios = explode("KWZ", $pagamento->sumarios);
                $total = 0.00;

                foreach ($sumarios as $sum) {


                    $array = explode("----", $sum);
                    $array = array_last($array);

                    $valor = floatval(str_replace(['.', ','], ['', '.'], $array));

                    $total += (float) $valor;
                }
                
            @endphp

            <td><strong>Valor:</strong></td>
            <td>{{ number_format($total, 2, ',', '.') }} KZ</td>
        </tr>
        <tr>
            <td><strong>Método de Pagamento:</strong></td>
            <td>{{ $pagamento->metodo }}</td>
        </tr>
        {{-- <tr>
            <td><strong>Referência:</strong></td>
            <td>{{ $pagamento->referencia }}</td>
        </tr> --}}
        <tr>
            <td><strong>Descrição:</strong></td>
            <td>{{ $pagamento->sumarios }}</td>
        </tr>
        <tr>
            <td><strong>Atendimento Responsável:</strong></td>
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