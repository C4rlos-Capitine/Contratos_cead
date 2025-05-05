<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
    <style>
        body {
            font-family: Garamond;
            font-size: 12px;
            line-height: 1.7;
        }
        main {
            width: 90%;
            padding: 3%;
            text-align: center;
        }
        header {
            text-align: center;
        }
        footer {
            text-align: center;
        }
        .doc-title {
            width: 100%;
            text-align: center;
        }
        p {
            text-align: justify;
            line-height: 1.2;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 0.5px solid #000;
            text-align: center;
            vertical-align: middle;
            padding: 5px;
        }
        .alineas {
            margin-left: 50px;
            line-height: 1.0;
        }
        .alineas p {
            line-height: 1.0;
        }
        .footer-section {
            width: 100%;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 10%;
        }
        .footer-child {
            text-align: center;
        }
        #data {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        @php
        $imagePath = public_path('header.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;
        @endphp
        <img src="{{ $imageSrc }}" width="90%" height="150px" alt="Image">
    </header>
    <main>
    @php
            $remuneracao = 0;
            $nivel = "";
            $nivel_contratado = "";
            $hcontacto = 0;
        @endphp

        @if($docente->id_nivel == 1)
            @php
                $remuneracao = 800;
                $nivel = "Dr";
                $nivel_contratado = "licenciado"
            @endphp
        @elseif($docente->id_nivel == 2)
            @php
                $remuneracao = 1000;
                $nivel = "MSc";
                $nivel_contratado = "Mestre"
            @endphp
        @elseif($docente->id_nivel >= 3)
            @php
                $remuneracao = 1200;
                $nivel = "Prof(a) Doutor(a)";
                $nivel_contratado = "Doutor";
            @endphp
        @endif
        @php
            $remuneracao = 0;
            $nivel = "";
            $nivel_contratado = "";
            $hcontacto = 0;

            // Obter a cláusula com ordem 0
            $clausulaIntroducao = $clausulas->firstWhere('ordem_clausula', 0);

            // Filtrar as outras cláusulas
            $outrasClausulas = $clausulas->where('ordem_clausula', '!=', 0);
        @endphp

        @if($docente->id_nivel == 1)
            @php
                $remuneracao = 800;
                $nivel = "Dr";
                $nivel_contratado = "licenciado";
            @endphp
        @elseif($docente->id_nivel == 2)
            @php
                $remuneracao = 1000;
                $nivel = "MSc";
                $nivel_contratado = "Mestre";
            @endphp
        @elseif($docente->id_nivel == 3)
            @php
                $remuneracao = 1200;
                $nivel = "Prof(a) Doutor(a)";
                $nivel_contratado = "Doutor";
            @endphp
        @endif

        <div class="doc-title"><h2>TERMO DO CONTRATO</h2></div>

        <!-- Renderizar a cláusula de introdução -->
        @if($clausulaIntroducao)
            <p>{!! nl2br($clausulaIntroducao->descricao_clausula) !!}</p>
        @endif

        <div class="doc-title"><b>Primeira</b></div>
        <div class="doc-title"><b>(Objecto do contrato)</b></div>
        <p>
        O presente Contrato tem por objecto a prestação de serviços a tempo parcial como Tutor de Especialidade, no âmbito da actividade do Centro de Educação Aberta e à Distância (CEAD), nos seguintes módulos:
        </p>
        <div class="table">
        <table>

            <tr>
                <th class="modulos-col">Módulo</th>
                <th class="outros-col">Hora de contacto</th>
                <th class="outros-col">Curso</th>
                <th class="outros-col">Ano</th>
                <th class="outros-col">Semestre</th>
                <th class="outros-col">Centro de Recursos</th>
            </tr>
            @php
                $contador = 1;
            @endphp
            @foreach($disciplinas as $disciplina)
            @php
                $hcontacto += $disciplina->horas_contacto;
                $smestre = 1;
            @endphp

            @if($disciplina->semestre == 2)
                $smestre = 2;
            @endif
                <tr>
                    <td class="modulos-col">{{ $disciplina->nome_disciplina }}</td>
                    <td class="outros-col">{{ $disciplina->horas_contacto }} hs</td>
                    <td class="outros-col">{{ $disciplina->designacao_curso }}</td>
                    <td class="outros-col">{{ $disciplina->ano }}º</td>
                    <td class="outros-col">{{ $smestre }} Semestre</td>
                    <td class="outros-col">{{ $disciplina->nome_centro}}</td>
                </tr>
            @endforeach
        </table>
        </div>

        <!-- Renderizar as outras cláusulas -->
        @foreach($outrasClausulas as $clausula)
            <div class="doc-title"><b>{{ $clausula->ordem_clausula }}ª ({{ $clausula->titulo_clausula }})</b></div>
            <p>{!! nl2br($clausula->descricao_clausula) !!}</p>
        @endforeach

        <section id="data">Maputo,_______de_______________20__</section>
    </main>
    <footer class="footer-section">
        <div class="footer-child" align="left" style="width: 50%;float: left;">
            <label style="font-weight: bold; padding-left:20px">O Contratante</label><br><br>
            <label>______________________________________</label><br>
            <small style="margin:10%;width:100%">(Profª. Doutora Marisa Guião de Mendonça)</small>
        </div>
        <div class="footer-child" align="left" style="width: 50%;float: left;">
            <label style="font-weight: bold;padding-left:20px">O Contratado</label><br><br>
            <label>____________________________________</label><br>
            <small style="margin:10%;width:100%">({{ $nivel }} {{$docente->nome_docente}})</small>
        </div>
    </footer>
</body>
</html>