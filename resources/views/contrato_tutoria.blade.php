<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
    <style>
        body {
            font-size: 12px;
            line-height: 1.7;
            margin-top: 0;
        }
        main {
            width: 90%;
            padding: 3%;
            text-align: center;
        }
        header {
            margin-top: 0;
            text-align: center;
        }
        #header-img{
            margin-top: 0;
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
            line-height: 1.5;
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
<body style="font-family: {{ $fonte->nome_font }}; font-size: {{ $tamanhoFonte->tamanho_fonte }}px; line-height: 1.7;">
    <header>
        @php
        $imagePath = public_path('header.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;
         $nivel_representante = "doutor(a)";
            if($representante->id_nivel_contrantante  == 1) {
                if ($representante->id_nivel_contrantante == 1) {
                    $nivel_representante = ($representante->genero_representante == "Feminino") ? "doutora" : "doutor";
                } elseif ($representante->id_nivel_contrantante == 2) {
                    $nivel_representante = "mestre";
                } elseif ($representante->id_nivel_contrantante >= 3) {
                    $nivel_representante = ($representante->genero_representante == "Feminino") ? "Prof. Doutora" : "Prof. Doutor";
                }
                } else {
                    $nivel_representante = "doutor";
                }
             
            
        @endphp
        <img id="header-img" src="{{ $imageSrc }}" width="90%" height="150px" alt="Image">
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

        @php
            if($docente->id_nivel == 1) {
                $nivel = ($docente->genero_docente == "Feminino") ? "doutora" : "doutor";
            } elseif($docente->id_nivel == 2) {
                $nivel = "mestre";
            } elseif($docente->id_nivel == 3) {
                $nivel = ($docente->genero_docente == "Feminino") ? "Prof. Doutora" : "Prof. Doutor";
            }
        @endphp

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
        </br>
      <!-- Renderizar as outras cláusulas -->
        @foreach($outrasClausulas as $clausula)
    </br>
            <div class="doc-title"><b>{{ $clausula->ordem_clausula }}ª {{ $clausula->titulo_clausula }}</b></br></div>
            <div class="doc-title"><b>{{ $clausula->subtitulo_clausula }}</b></div>
            @php
                // Adiciona recuo nas linhas que começam com número e ponto após quebra de linha
                $descricao = preg_replace(
                    '/(^|\r\n|\n|\r)(\d+\.)/',
                    '$1<span style="display:inline-block; margin-left: 50px;">$2',
                    $clausula->descricao_clausula
                );
                // Fecha o span no final da linha
                $descricao = preg_replace('/(<span[^>]*>.*?)(\r\n|\n|\r)/', '$1</span>$2', $descricao);
            @endphp
            <p>{!! nl2br($descricao) !!}</p>
            </br>
        @endforeach

        <section id="data">Maputo,_______de_______________20__</section>
    </main>
    <footer class="footer-section">
        <div class="footer-child" align="left" style="width: 50%;float: left;">
            <label style="font-weight: bold; padding-left:20px">O Contratante</label><br><br>
            <label>______________________________________</label><br>
            <small style="margin:10%;width:100%">( {{$nivel_representante}} {{$representante->nome_representante }})</small>
        </div>
        <div class="footer-child" align="left" style="width: 50%;float: left;">
            <label style="font-weight: bold;padding-left:20px">O Contratado</label><br><br>
            <label>____________________________________</label><br>
            <small style="margin:10%;width:100%;">({{ $nivel }} {{$docente->nome_docente}})</small>
        </div>
    </footer>
</body>
</html>