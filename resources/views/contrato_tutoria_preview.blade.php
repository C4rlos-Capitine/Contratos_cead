
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
            font-family:{{$fonte->nome_font}}
        }
        span{
            font-family:{{$fonte->nome_font}}
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
    <header style="font-family:{{$fonte->nome_fonte}}">
        @php
        $imagePath = public_path('header.png');
        $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
        $imageSrc = $imageData ? 'data:image/png;base64,' . $imageData : '';
         $clausulaIntroducao = $clausulas->firstWhere('ordem_clausula', 0);
          // Filtrar as outras cláusulas
            $outrasClausulas = $clausulas->where('ordem_clausula', '!=', 0);

            $nivel_representante = "doutor(a)";
            if($representante->id_nivel_contrantante  == 1) {
                if($representante->genero_representante == "Feminino") {
                    $nivel_representante = "doutora";
                } else {
                    $nivel_representante = "doutor";
                }
                $nivel_representante = "doutor(a)";
            } elseif($representante->id_nivel_contrantante  == 2) {
                if($representante->genero_representante == "Feminino") {
                    $nivel_representante = "mestre";
                } else {
                    $nivel_representante = "mestre";
                }
                $nivel_representante = "mestre(a)";
            } elseif($representante->id_nivel_contrantante  >= 3) {
                if($representante->genero_representante == "Feminino") {
                    $nivel_representante = "Prof. Doutora";
                } else {
                    $nivel_representante = "Prof. Doutor";
                }
                $nivel_representante = "Prof. Doutor(a)";
            }
        @endphp
        @if($imageSrc)
            <img src="{{ $imageSrc }}" width="90%" height="150px" alt="Image">
        @else
            <div style="height:150px;line-height:150px;background:#eee;">[LOGO]</div>
        @endif
    </header>
    <main>
   
    <div class="doc-title"><h2>TERMO DO CONTRATO</h2></div>

    <!-- Renderizar a cláusula de introdução -->

    @if($clausulaIntroducao)
        <p>{!! nl2br($clausulaIntroducao->descricao_clausula) !!}</p>
    @endif

    <div class="doc-title" style="font-family:{{$fonte->nome_fonte}}"><b>Primeira</b></div>
    <div class="doc-title" style="font-family:{{$fonte->nome_fonte}}"><b>(Objecto do contrato)</b></div>
    <p>
        O presente Contrato tem por objecto a prestação de serviços a tempo parcial como Tutor de Especialidade, no âmbito da actividade do Centro de Educação Aberta e à Distância (CEAD), nos seguintes módulos:
    </p>
    <div class="table" style="font-family:{{$fonte->nome_fonte}}">
        <table>
            <tr>
                <th class="modulos-col">Módulo</th>
                <th class="outros-col">Hora de contacto</th>
                <th class="outros-col">Curso</th>
                <th class="outros-col">Ano</th>
                <th class="outros-col">Semestre</th>
                <th class="outros-col">Centro de Recursos</th>
            </tr>
            @foreach($disciplinas as $disciplina)
         
                <tr>
                    <td class="modulos-col">{{ $disciplina->nome_disciplina }}</td>
                    <td class="outros-col">{{ $disciplina->horas_contacto }} hs</td>
                    <td class="outros-col">{{ $disciplina->designacao_curso }}</td>
                    <td class="outros-col">{{ $disciplina->ano }}º</td>
                    <td class="outros-col">1 Semestre</td>
                    <td class="outros-col">Lhanguene</td>
                </tr>
            @endforeach
        </table>
    </div>


<!-- Renderizar as outras cláusulas -->
@foreach($outrasClausulas as $clausula)
    <div class="doc-title" style="font-family:{{$fonte->nome_fonte}}"><b>{{ $clausula->ordem_clausula }}ª ({{ $clausula->titulo_clausula }})</b></div>
    @php
        // Adiciona recuo nas linhas que começam com número e ponto após quebra de linha
        $descricao = preg_replace(
            '/(^|\r\n|\n|\r)(\d+\.)/',
            '$1<span style="display:inline-block; margin-left: 30px; padding:30px; font-family:{{$fonte->nome_fonte}}">$2',
            $clausula->descricao_clausula
        );
        // Fecha o span no final da linha
        $descricao = preg_replace('/(<span[^>]*>.*?)(\r\n|\n|\r)/', '$1</span>$2', $descricao);
    @endphp
    <p>{!! nl2br($descricao) !!}</p>
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
            <small style="margin:10%;width:100%">( {{ $docente->nome_docente }})</small>
        </div>
    </footer>
</body>
</html>