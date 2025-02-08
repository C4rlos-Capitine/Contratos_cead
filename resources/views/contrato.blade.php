<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family: Garamond;
            font-size: 12px;
            line-height: 1.5;
        }
        main{
            padding: 20px;
            text-align: center;
        }
        header{
 
            text-align: center;
        }
        footer{
            text-align: center;
        }
        .doc-title{
            width: 100%;
            text-align: center;
        }
        p {
            text-align: justify;
            line-height: 1.2;
        }
        .table{
            width: 100%;
            text-align: center;
            
        }
        table {
            border-collapse: collapse;
            border-style: solid;
        }
        th, td {
            border: 1px solid #000; /* Set border to 1px solid black */
            padding: 1px;
            
            text-align: center;
            text-align: justify;
        }
        .alineas{
            margin-left: 50px;
            line-height: 1.0;
        }
        .alineas p{
            line-height: 1.0;
        }

        .modulos-col{
            width: 300px;
        }
        .outros-col{
            text-align: center; 
            padding: 5px;
        }

        .footer-section{
            margin: 80px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            text-align:center;

            /*background-color: #f0f0f0;*/
            padding: 20px;
        }

       
        .footer-child{
            display: inline-block;
            width: 45%; /* Adjust the width as needed */
            vertical-align: top; /* Align elements from the top */
        }
        #data{
            width: 100%;
            text-align:center;
        }
       
    </style>
</head>
<body>
    <header>
    <!--<img src="{{ public_path('header.png') }}" width="90%" height="70px">-->
    @php
    $imagePath = public_path('header.png'); // Path to your image file
    $imageData = base64_encode(file_get_contents($imagePath)); // Encode image data as Base64
    $imageSrc = 'data:image/png;base64,' . $imageData; // Construct the image source
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
        @elseif($docente->id_nivel == 3)
            @php
                $remuneracao = 1200;
                $nivel = "Prof(a) Doutor(a)";
                $nivel_contratado = "Doutor";
            @endphp
        @endif

       
        <div class="doc-title"><h2>TERMO DO CONTRATO</h2></div>
        <p>Entre a Universidade Pedagógica de Maputo, cidade de Maputo, representada pela Profª. Doutora Marisa Guião de Mendonça, 
            no âmbito da Delegação de competências conforme a alínea i), do nº 1, do Despacho nº 03/GR-023.6/UP/2019, de 01 de Abril, doravante designada por "Contratante" e 
            o <b>{{ $nivel }}. {{$docente->nome_docente}}</b>, titular do BI nº. <b>{{$docente->bi}}</b>, NUIT nº. <b>{{$docente->nuit}}</b>, de nacionalidade <b>{{$docente->nacionalidade}}</b>, doravante designado(a) por "Contratado(a)", 
            é celebrado o presente Contrato, nos termos do Decreto nº 89/99 de 28 de Dezembro que se regerá pelas seguintes cláusulas:
        </p>
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
                    <td class="outros-col">{{ $smestre }}</td>
                    <td class="outros-col">Lhangane</td>
                </tr>
            @endforeach
            
           
            
        </table>
        </div>
        @php
            $total_ganho = $hcontacto * $remuneracao;
        @endphp
        <div class="doc-title"><b>Segunda</b></div>
        <div class="doc-title"><b>(Obrigações do/a Contratado/a)</b></div>
        <p>
        O presente Contrato é valido por um período de 1 ano lectivo (II semestre do ano lectivo), produzindo seus efeitos a partir da data do início das actividades.
        </p><p>O Contratado obriga-se a:</p>
        <div class="alineas">
        
        <p>a) Leccionar os módulos para os quais foi contratado;</p>
        <p>b) Realizar com zelo e diligência, lealdade e dedicação a sua atividade, dentro dos preceitos de ética e deontologia profissional e nos termos dos regulamentos internos e das demais normas vigência aplicáveis;</p>
        <p>c) Utilizar os Ambientes Virtuais de Aprendizagem (AVA) institucionais;</p>
        <p>d) Disponibilizar o Guia da disciplina no AVA Institucional, do módulo que tutora até 15 dias contados a partir da data do início da atividade lectiva;</p>
        <p>e) Trabalhar em estreita colaboração com outros intervenientes do curso e realizar todo o processo de avaliação dos estudantes (testes, exames e trabalhos de pesquisa);</p>
        <p>f) Apresentar ao CEAD os relatórios das atividades realizadas e as respetivas pautas devidamente assinadas;</p>
        <p>g) Realizar pelo menos duas sessões mensais de Vídeo Conferência Institucional de acordo com o Calendário do Curso;</p>
        <p>h) Realizar uma Tutoria Presencial correspondente a 3 horas;</p>
        <p>i) Cumprir com as demais obrigações de acordo com o Calendário do Curso.</p>

        </div>
      
        <div class="doc-title"><b> Terceira</b></div>
        <div class="doc-title"><b>(Obrigações do/a Contratado/a)</b></div>
        <p>O Contratado obriga-se a:</p>
        <div class="alineas">
        <p>a) Leccionar os módulos para os quais foi contratado;</p>
        <p>b) Realizar com zelo e diligência, lealdade e dedicação a sua atividade, dentro dos preceitos de ética e deontologia profissional e nos termos dos regulamentos internos e das demais normas vigência aplicáveis;</p>
        <p>c) Utilizar os Ambientes Virtuais de Aprendizagem (AVA) institucionais;</p>
        <p>d) Disponibilizar o Guia da disciplina no AVA Institucional, do módulo que tutora até 15 dias contados a partir da data do início da atividade lectiva;</p>
        <p>e) Trabalhar em estreita colaboração com outros intervenientes do curso e realizar todo o processo de avaliação dos estudantes (testes, exames e trabalhos de pesquisa);</p>
        <p>f) Apresentar ao CEAD os relatórios das atividades realizadas e as respetivas pautas devidamente assinadas;</p>
        <p>g) Realizar pelo menos duas sessões mensais de Vídeo Conferência Institucional de acordo com o Calendário do Curso;</p>
        <p>h) Realizar uma Tutoria Presencial correspondente a 3 horas;</p>
        <p>i) Cumprir com as demais obrigações de acordo com o Calendário do Curso.</p>

    </div>

    <div class="doc-title"><b>Quarta</b></div>
    <div class="doc-title"><b>(Obrigações do Contratante)</b></div>
    <p>O Contratado obriga-se a:</p>
    <div class="alineas">
    <p>A contratante obriga-se a:</p>
    <p>a) Proceder ao pagamento das remunerações a que o(a) contratado(a) tem direito, com observância do exposto na Cláusula Terceira, do presente Contrato;</p>
    <p>b) Criar condições de trabalho para que o Contratado(a) realize as atividades previstas no presente documento (disponibilizar o transporte para a tutoria presencial no Centro de Recurso fora do Campus da Lhanguene).</p>

    </div>

    <div class="doc-title"><b>Quainta</b></div>
    <div class="doc-title"><b>(Remuneração)</b></div>
    <p>O Contratado obriga-se a:</p>
    <div class="alineas">
    <p>1. O Contratado tem direito a uma remuneração de {{$remuneracao}},00 MT/hora, num total de {{$hcontacto}} horas, de acordo com o nível académico e experiência profissional ({{$nivel_contratado}}), paga após o visto do Tribunal Administrativo (TA).</p>
    <p>2. O bónus de conectividade (Internet) será correspondente a 25% das horas totais do semestre.</p>
    <p>3. O último pagamento está condicionado à entrega de relatórios das atividades realizadas e à respetiva pauta assinada.</p>
    <p>4. Da remuneração a pagar serão deduzidos os devidos impostos (IRPS e Emolumentos do TA) de acordo com a legislação em vigor.</p>
    <p>5. Em caso de não se verificar a disponibilização mensal de conteúdos no AVA e interação por videoconferência, o tutor de especialidade estará sujeito aos seguintes descontos:</p>
    <p style="margin-left: 25px;">§ Um: Três (3) horas correspondentes ao Guia de Disciplina;</p>
    <p style="margin-left: 25px;">§ Dois: Três (3) horas correspondentes a Tutoria Presencial;</p>
    <p style="margin-left: 25px;">§ Três: 50% correspondentes a disponibilização dos conteúdos no AVA;</p>
    <p style="margin-left: 25px;">§ Quatro: 50% correspondentes a sessões de Vídeo Conferência de acordo com o calendário do curso.</p>

    </div>

    <div class="doc-title"><b>Sexta</b></div>
    <div class="doc-title"><b>(Abono de deslocação)</b></div>
    <div class="alineas">
    <p>1. A deslocação para os Centros de Recursos, no âmbito da Tutoria de Especialidade, confere ao Tutor de Especialidade o direito ao abono de ajudas de custo.</p>
    <p>2. A deslocação cuja natureza da missão não exija a pernoita, é abonado o valor de 1.800,00MT/dia.</p>
    <p>3. Em caso de pernoita, desde que se justifique, o abono é correspondente a 6000,00MT/dia.</p>
    </div>
    <div class="doc-title"><b>Sétima</b></div>
    <div class="doc-title"><b>(Alterações do Contrato)</b></div>
    <div class="alineas">
    <p>O presente Contrato poderá ser alterado quando for conveniente para qualquer das partes, ou em consequência de alterações que venham a verificar-se no correspondente condicionalismo legal.</p>
    </div>
    <div class="doc-title"><b>Oitava</b></div>
    <div class="alineas">
    <p>1. O presente contrato pode extinguir-se por:</p>
    <p>a) Caducidade, no caso de ter expirado o seu prazo;</p>
    <p>b) Morte do Contratado(a);</p>
    <p>c) Acordo entre as partes;</p>
    <p>d) Rescisão por qualquer das partes contratantes com fundamento em justa causa;</p>
    <p>e) Denúncia do Contrato por parte do Contratado ou da Contratante, com aviso prévio de 60 dias, relativamente ao termo do contrato.</p>
    <p>2. Constitui justa causa para a contratante:</p>
    <p>a) Não cumprimento dos deveres e obrigações pelo contratado, comprovado em processo disciplinar;</p>
    <p>b) Detenção ou prisão por comportamento doloso se, devido à natureza das funções do contratado, prejudicar o normal desempenho da sua atividade;</p>
    <p>c) Manifesta incompetência comprovada;</p>
    <p>d) Ter sido aplicada a pena de demissão ou expulsão, quando se trate de funcionário do aparelho do Estado.</p>
    </div>
    <div class="doc-title">Nona</div>
    <div class="doc-title">(Anti-Corrupção)</div>
    <p>As partes e/ou os seus representantes declaram que durante o processo de selecção, vigência ou após o termo do presente Contrato, não serão oferecidos, directa ou indirectamente, vantagens a terceiros e nem solicitados, prometidos ou aceites para benefícios próprios ou de outrem, ofertas com o propósito de obter julgamento favorável sobre os serviços a prestar.
    </p>

    <div class="doc-title">Décima</div>
    <div class="doc-title">(Resolução de litígio)</div>
<p>1.	Os litígios que eventualmente surgirem na interpretação e aplicação do presente Contrato, serão resolvidos por comum acordo das partes, segundo as regras de boa-fé e equidade.</p>
<p>2.	Na falta de acordo, o litígio será dirimido pelo Tribunal competente para o efeito.</p>

    </main>
    <section id="data">Maputo,_______de____________20__</section>
    <footer class="footer-section">
        <div class="footer-child" align="left" style="width: 50%;float: left;">
            <label>O/A Contrante</label><br><br>
            <label>______________________________</label><br>
            <small>(Profª. Doutora Marisa Guião de Mendonça)</small>
        </div>
        <div class="footer-child" align="left" style="width: 50%;float: left;">
            <label>O/A Contratado</label><br><br>
            <label>____________________________</label><br>
            <small>({{ $nivel }} {{$docente->nome_docente}})</small>
        </div>
    </footer>

<style>
     #table-footer{
            border: none;
            text-align: center;
            border-collapse: collapse;
        }
</style>
    <!--<footer><img src="{{ public_path('footer.png') }}" width="80%" height="200px"></footer>-->
</body>
</html>
