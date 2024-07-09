
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('head2')
    <style>
    .card-header{
            background: #43A047;
            color: white;
        }   
        .card{
            margin-left: 10px;
        }
    </style>
    <script src="javascript/template-controller.js"></script>
    <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('home').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>
<body class="antialiased">
<header class="header-section">

<!--<i class="fa-solid fa-bars" style="color: #f7f7f8;"></i>-->
<div id="logo">

<img src="{{ asset('cead.png') }}">



    <label id="titulo">Sistema Gestão de Contratos do CEAD</label>
</div>

<!-- <button id="bt-quit">sair<i id="quit" class="fa-solid fa-power-off" style="color: #f4f0f0;"></i></button>-->
<p id="header-right"><a id="quit-link" width="fit-content" href="{{url('logout')}}" class="rounded bg-red-600 text-white px-2 py-1">sair<i id="quit" class="fa-solid fa-power-off" style="color: #f4f0f0;"></i></a></p>
</header>

<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Home</label></div>
            <div id="info">
            
                <h2>Estatisticas</h2>

                <h4>Estatisticas Gerais</h4>
                <br>
                <label>Estagio dos contratos</label>
                <div class="progress">
                    
                    <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
                <div class="row-section" style="padding:0">
                    <div class="card">
                        <img src="grafic.png" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Contratos de {{date("Y")}}</h5>
                            <p class="card-text" id="total-contratos">Docentes contratados para tutorias: .</p>
                            <p class="card-text"><small class="text-muted">Contratos de tutorias</small></p>
                        </div>
                    </div>

                    <div class="card">
                        <img src="{{asset('grafic.png')}}"class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Contratos de {{date("Y")}}</h5>
                            <p class="card-text" id="total-contratos">Cursos: {{ $total_cursos }}.</p>
                            <p class="card-text"><small class="text-muted">Contratos de tutorias</small></p>
                        </div>
                    </div>
                </div>

                @php
                $controlador = 1;
                @endphp

                <h4>Estatisticas dos cursos</h4>

                @foreach ($cada_curso as $curso)
                    @if($controlador == 1)
                        <div class="row-section" style="padding:0">
                    @endif

                    <div class="card border-warning mb-3" style="width: 80%;">
                        <div class="card-header">Curso: {{ $curso['designacao_curso'] }}</div>
                        <div class="card-body">
                            <h5 class="card-title">Não Associadas: {{ $curso['nao_associadas'] }}</h5>
                            @php
                                $total_disciplinas = $curso['nao_associadas'];
                                $total_disciplinas_curso = $curso['total_disciplinas'];
                                $percentagem = intval($total_disciplinas) * 100;
                                $percentagem2 = 0;
                                if (intval($total_disciplinas_curso) > 0) {
                                    $percentagem2 = number_format($percentagem / intval($total_disciplinas_curso), 2);
                                }
                                $faltam = $total_disciplinas_curso - $total_disciplinas;
                            @endphp
                            <h5 class="card-title">Faltam: {{ $faltam }}</h5>
                            <p class="card-text">Total das disciplinas do curso: {{ $curso['total_disciplinas'] }}</p>
                        
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentagem2 }}%" aria-valuenow="{{ $percentagem2 }}%" aria-valuemin="0" aria-valuemax="{{ $curso['total_disciplinas'] }}">{{ $percentagem2.'%' }}</div>
                            </div>
                        </div>
                    </div>

                    @if($controlador == 3)
                        </div>
                        @php
                        $controlador = 1;
                        @endphp
                    @else
                        @php
                        $controlador++;
                        @endphp
                    @endif
                @endforeach

                @if($controlador !== 1)
                    </div>
                @endif

        </div>
    </div>
</main>
                            <footer>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
            Campus de Lhanguene, Av. Trabalho, nº 2482, Bairro Chamanculo “C”, Maputo - Moçambique.
            (+258) 84 90 01 80 4
            up.cead@gmail.com
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
            &copy;UP-Maputo
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
                Contactos & Endereço
                <div class="footer-dec">
                    Campus de Lhanguene, Avenida do Trabalho, nº 2482, Bairro Chamanculo “C”, Maputo - Moçambique

                    (+258) 84 90 01 80 4
                    (+258) 84 20 26 75 9
                   
                   up.cead@gmail.com
                   cead@up.ac.mz
                </div>
            </div>
        </div>
    </div>
    </footer>

    </body>
   
</html>
