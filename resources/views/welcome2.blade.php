<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('head')
    <style>
        .card-header{
            background: #43A047;
            color: white;
        }   
        .card{
            margin: 10px;
           /* max-width: 250px;*/
            
        }
        .about-us{
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
            width: 90%;
            padding: 50px;   
            border: solid 1px #b3dca3;
            border-radius: 5px;
        }
    </style>

        <script>
            $(document).ready(function(){
    
    function get_estatisticas_genero() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                type: 'GET',
                url: '/docente/by_genero',
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    

    get_estatisticas_genero().then(function(data) {
        var ctx = document.getElementById('myChart').getContext('2d');
        renderChart(data, ctx);
    }).catch(function(error) {
        console.error('Error fetching data:', error);
    });



    function renderChart(data, ctx) {
        var estatisticas = data;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Maculino', 'Femenino'],
                datasets: [{
                    label: '# Docentes por Genero',
                    data: [estatisticas.masculino, estatisticas.femenino],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
       

    }

    function get_estatisticas_nivel() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                type: 'GET',
                url: '/docente/by_nivel',
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    get_estatisticas_nivel().then(function(data) {
        var ctx = document.getElementById('myChart2').getContext('2d');
        renderChart2(data, ctx);
    }).catch(function(error) {
        console.error('Error fetching data:', error);
    });

    function renderChart2(data, ctx) {
        data;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Licenciado', 'Mestre', 'Doutor'],
                datasets: [{
                    label: '# Docentes por Nivel',
                    data: [data.licenciado, data.mestre, data.doutor],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        
    }


    function get_estatisticas_genero_contratados() {
        return new Promise(function(resolve, reject) {
            var anoAtual = {{ $ano }};
            console.log(anoAtual);
            $.ajax({
                type: 'GET',
                url: '/docente/contratados_genero',
                data: {ano: anoAtual},
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    get_estatisticas_genero_contratados().then(function(data) {
        var ctx = document.getElementById('myChart3').getContext('2d');
        renderChart3(data, ctx);
    }).catch(function(error) {
        console.error('Error fetching data:', error);
    });

    function renderChart3(data, ctx) {
        data;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Masculino', 'Femenino'],
                datasets: [{
                    label: '# Contratados por genero',
                    data: [data.masculino, data.femenino],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }




    function get_estatisticas_assinadosDocentes() {
        return new Promise(function(resolve, reject) {
            var anoAtual = {{ $ano }};
            console.log(anoAtual);
            $.ajax({
                type: 'GET',
                url: '/contrato/get_assinados_docentes',
                data: {ano: anoAtual},
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    get_estatisticas_assinadosDocentes().then(function(data) {
        var ctx = document.getElementById('myChart4').getContext('2d');
        renderChart4(data, ctx);
    }).catch(function(error) {
        console.error('Error fetching data:', error);
    });

    function renderChart4(data, ctx) {
        ctx = document.getElementById('myChart4');

        data = {
            labels: ['assinados', 'não assinados'],
            datasets: [{
            label: 'Contratos assinados pelos docentes',
            data: [data.docentes_assinaram, data.nao_assinaram],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)'
            ],
            hoverOffset: 4
            }]
        };

        const options = {
            responsive: true, // Ensures chart resizes correctly
            plugins: {
            legend: {
                position: 'top',
            }
            }
        };

        new Chart(ctx, {
            type: 'doughnut',
            data: data,   // Properly defining data
            options: options // Properly defining options
        });
    }


    
    function get_estatisticas_assinadosUp() {
        return new Promise(function(resolve, reject) {


// Obter o ano atual
            var anoAtual = {{ $ano }};
            console.log(anoAtual);
            $.ajax({
                type: 'GET',
                url: '/contrato/get_assinados_up',
                data: {ano: anoAtual},
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    get_estatisticas_assinadosUp().then(function(data) {
        var ctx = document.getElementById('myChart5').getContext('2d');
        renderChart5(data, ctx);
    }).catch(function(error) {
        console.error('Error fetching data:', error);
    });

    function renderChart5(data, ctx) {
        ctx = document.getElementById('myChart5');

        data = {
            labels: ['assinados', 'não assinados'],
            datasets: [{
            label: 'Contratos assinados pelo representante da UP',
            data: [data.assinados, data.nao_assinaram],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)'
            ],
            hoverOffset: 4
            }]
        };

        const options = {
            responsive: true, // Ensures chart resizes correctly
            plugins: {
            legend: {
                position: 'top',
            }
            }
        };

        new Chart(ctx, {
            type: 'doughnut',
            data: data,   // Properly defining data
            options: options // Properly defining options
        });
    }

    
    

});

        </script>

<body class="antialiased">


   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('home1').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        
        
    });
       // document.getElementById('home1').style.backgroundColor = "blue";
        
    </script>

@include('side2')
        
<div id="page-content-wrapper">
    @include('nav')
        <!-- Page content-->
    <div class="container-fluid">

     <!-- Scrollable modal -->
     <div class="modal fade bd-example-modal-lg" id="modal-lista" style="margin-top:50px;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                
                <div class="modal-content">
                
                </div>
            </div>
        </div>
     
    <div id="info">
        
    
      
    <div class="col-md-4">
          <label for="validationCustomUsername" class="form-label">Estatisticas de um ano</label>
          <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">escreva o ano</span>
            <input type="number" class="form-control" id="ano_contrato" name="ano_contrato" min="1900" max="2100" value = "{{$ano}}"  aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
              Ano invávido
            </div>
            <button class="rounded bg-green-600 text-white px-2 py-1" onclick="get_byAno()">Buscar</button>
          </div>
          
        </div>

            <div class="row-section">
                @if($total_disciplinas == $total_alocadas)
                    <div class="alert alert-success" role="alert">
                        Já foram alocadas todas as disciplinas para os contratos de {{date("Y")}}
                    </div>
                @else
                <div class="alert alert-warning" role="alert">
                        Foram alocadas {{$total_alocadas}} de {{$total_disciplinas}} disciplinas existentes, proceda com alocação das mesmas
                    </div>
                @endif
            </div>
            <div class="row-section" style="padding:0">
                <div class="card">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="card">
                    <canvas id="myChart2"></canvas>
                </div>
                <div class="card">
                    <canvas id="myChart3"></canvas>
                </div>
            </div>
            <div class="row-section" style="padding:0">
                <div class="card">
                    <canvas id="myChart4"></canvas>
                </div>
                <div class="card">
                    <canvas id="myChart5"></canvas>
                </div>
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Contratados</div>
                    <div class="card-body">
                        <h5 class="card-title">Docentes: {{ $total_docentes }}</h5>
                    <p class="card-text">Contratados para tutoria {{$contratados}}.</p>
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
                        <h5 class="card-title">Alocadas: <label id="alocada-{{ $curso['id_curso'] }}">{{ $curso['nao_associadas'] }}</label></h5>
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
                        <h5 class="card-title">Faltam: <label id="nao-alocada-{{ $curso['id_curso'] }}">{{ $faltam }}</label> <button class="rounded bg-green-600 text-white px-2 py-1" onclick="open_list({{ $curso['id_curso']}})">ver<button></h5>
                        <p class="card-text">Total das disciplinas do curso: {{ $curso['total_disciplinas'] }}</p>
                    
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" id="progress-bar-{{ $curso['id_curso'] }}" style="width: {{ $percentagem2 }}%" aria-valuenow="{{ $percentagem2 }}%" aria-valuemin="0" aria-valuemax="{{ $curso['total_disciplinas'] }}">{{ $percentagem2.'%' }}</div>
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
    
  
      
    <input type="hidden" name="id_docente" id="id_docente">
    <!--<input type="hidden" name="id_docente" id="">-->
    </body>
    <script src="{{asset('javascript/jquery-3.7.0.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        var dataAtual = new Date();

    //document.getElementById('ano_contrato').value 
    function open_list(id) {
        console.log(id);
        const cod_disciplina = id;
        //$('body').addClass('modal-opened');
        $.ajax({
            type: 'GET',
            url: '/curso/get_all_nao_ass',
            data: {
                ano_contrato: document.getElementById('ano_contrato').value,
                id_curso: id
            },
            success: function(data) {
                console.log(data);

                disciplinas = data.disciplinas;
                var $html = '<ol><h1>lista</h1><div id="feedback"></div>';
                for (let i = 0; i < disciplinas.length; i++) {
                    console.log(id);
                    $html += '<li style="margin-left:20px">' + disciplinas[i].nome_disciplina + '<select style="margin-left:20px" onchange="set_id_docente(this.value)" id="select_' + id + '_' + i + '"><option selected disabled>Escolha</option></select><button class="rounded bg-green-600 text-white px-2 py-1 aloc-btn" id="\'' + disciplinas[i].codigo_disciplina + '\'" onclick="alocar(\'' + id + '\',  \'' + disciplinas[i].codigo_disciplina + '\', this.id )">Alocar</button></li>';
                    // AJAX request for populating select options
                    $.ajax({
                        type: 'GET',
                        url: '/docente/sem_contrato', // Put your URL here
                        data: { ano: document.getElementById('ano_contrato').value },
                        success: function(response) {
                            // Populate select options dynamically
                            console.log(response);
                            data = response.response;
                            
                            response.forEach(docente => {
                                console.log(docente.id_docente)
                                $('#select_' + id + '_' + i + '').append('<option value="' +  docente.id_docente + '">' +  docente.nome_docente + '</option>');
                            });
                        
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }

                $html += '</ol>'; // Corrected assignment operator

                $('.modal').modal('show');
                $('.modal-content').html($html);
                //$('.modal-content').modal('show');

            },
            error: function(error) {
                //reject(error);
                alert('Erro');
            }
        });

    }
    function set_id_docente(value){
        console.log(value);
        document.getElementById('id_docente').value = value;
        console.log(document.getElementById('id_docente').value);
    }

    function alocar(id_curso, codigo_disciplina, bt_id){
        console.log('curso_'+id_curso);
        console.log('cod_ '+codigo_disciplina)
        console.log("bt_id: "+bt_id)
        var dataAtual = new Date();
        var anoAtual = dataAtual.getFullYear();

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    $.ajax({
            type: 'POST',
            url: '/docente/alocar/add_disciplina',
            data: {
                id_docente: document.getElementById('id_docente').value,
                id_curso: id_curso,
                codigo_disciplina: codigo_disciplina,
                tipo_contrato: 1,
                ano: document.getElementById('ano_contrato').value

            },
            success: function (data) {
                console.log(data);
                console.log(data.response);
                if(data.status == 1){
                    document.getElementById(bt_id).innerText = "Alocado";
                    document.getElementById(bt_id).disabled=true;
                    var val_alocadas = parseInt(document.getElementById('alocada-'+id_curso).innerText);
                    var val_nao_alocadas = parseInt(document.getElementById('nao-alocada-'+id_curso).innerText);
                    val_alocadas += 1;
                    val_nao_alocadas -= 1;
                    
                    //var total_disciplinas = ;
                    var percentagem = (100 * val_alocadas) / (val_alocadas + val_nao_alocadas)
                    console.log(val_alocadas);
                    console.log(val_nao_alocadas);
                    document.getElementById('alocada-'+id_curso).innerText = val_alocadas;
                    document.getElementById('nao-alocada-'+id_curso).innerText = val_nao_alocadas;
                    document.getElementById('progress-bar-'+id_curso).innerText = ""+percentagem.toFixed(2)+"%";
                    document.getElementById('progress-bar-'+id_curso).width = '${percentagem}%';
                    document.getElementById('progress-bar-'+id_curso).setAttribute("aria-valuenow", percentagem)
                    $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');

                }else{
                    $('#feedback').html('<div class="alert alert-danger">' + data.response + '</div>');
                }
            
            },
            error: function () {
                alert("error");
            }
        });
    }

    function get_byAno(){
        window.location.href = "/" + document.getElementById('ano_contrato').value;
    }


    </script>
</html>