<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Certificado de Conclusão</title>
    <style>
        @page {
            size: A4;
            margin: 30mm 20mm 25mm 20mm; /* top, right, bottom, left */
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
            color: #000;
            margin: 0;
        }

        .container {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 20mm;
        }

        .header h1 {
            font-size: 18pt;
            margin: 0;
        }

        .header p {
            font-size: 10pt;
            margin: 2px 0;
        }

        .title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 15mm;
            text-transform: uppercase;
        }

        .content {
            text-align: justify;
            font-size: 12pt;
            line-height: 1.6;
        }

        .highlight {
            font-weight: bold;
            text-transform: uppercase;
        }

        .issue-date {
            text-align: right;
            margin-top: 20mm;
            font-style: italic;
        }

        .footer {
            margin-top: 25mm;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            width: 45%;
            text-align: center;
            font-size: 10pt;
        }

        .signature-line {
            margin-top: 40px;
            border-top: 1px solid #000;
            width: 100%;
        }

        .signature-label {
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Cabeçalho -->
        <div class="header">
            <h1>instituto medio politecnico do Bengo </h1>
            <p>NIF: 123456789 | Luanda – Angola</p>
            <p>Email: bengo@escola.com | Tel: +244 999 999 999</p>
        </div>

        <!-- Título -->
        <div class="title">Certificado de Conclusão</div>

        <!-- Corpo -->
        <div class="content">
            Certificamos que o(a) aluno(a) <span class="highlight">{{ $aluno->nome }}</span>,
            portador(a) do número de processo <span class="highlight">{{ $aluno->id }}</span>,
            concluiu com aproveitamento o curso de
            <span class="highlight">{{ $aluno->cursos()->first()->nome ?? 'N/A' }}</span>,
            ministrado nesta instituição, tendo alcançado a média final de
            <span class="highlight">
                {{ number_format($aluno->notas()->get()->sum('valor') / max(1, $aluno->notas()->count()), 1) }}
            </span>.
            <br><br>
            Emitimos o presente certificado para os devidos fins legais.
        </div>

        <!-- Data -->
        <div class="issue-date">
            Luanda, {{ now()->format('d') }} de {{ now()->translatedFormat('F') }} de {{ now()->format('Y') }}.
        </div>

        <!-- Assinaturas -->
        <div class="footer">
            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-label">Diretor Geral</div>
            </div>

        </div>

    </div>

</body>

</html>
