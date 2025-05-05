

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="javascript/template-controller.js"></script>
    @include('head2')
    <style>
    #div-button{
        width:fit-content;
        height:auto;
    }
    @media (max-width:500px){
        #div-button{
            width:fit-content;
            height:auto;
        }
    }
    .modal{
        z-index: 9999;
    }
    .modal-opened {
        
        pointer-events: none;
    }
     .modal-backdrop {
        z-index: 1040; /* Lower than the default z-index of the modal */
    }


       /* Estilização do dropdown */
       .dropdown {
      position: relative;
      display: inline-block;

    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: #f9f9f9;
      min-width: 160px;
      width: 300px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
      border-radius: 4px;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
      padding: 20px;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown i {
      cursor: pointer;
      font-size: 20px;
    }
    .mini-menu{
        width: 100%;
    }
    .mini-menu:hover {
        background: #C8E6C9 !important;
    }

    </style>

<body class="antialiased">

<!-- Scrollable modal -->
@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
      
            <div id="info">
       <script>

            </script>
         
                <h1>Contratos no Tribunal administrativo</h1>
               
            <table id="example" class="table table-hover" style="width:100%">
                <thead><tr><th>Nome Completo</th><th>Resultado do TA</th>><th>Estado</th><th>ano</th><th></th></tr></thead>
                <tbody>
                @foreach($contratos as $contrato)
                    <tr>
                        <td>{{$contrato->nome_docente}}-{{$contrato->apelido_docente}}</td>
                        <td>{{$contrato->resultado_ta}}</td>
                        <td>{{$contrato->estado}}</td>
                        <td>{{$contrato->ano_contrato}}</td>
                        <td>
                        <div class="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                                <div class="dropdown-content">
                                    <button class="mini-menu" id="{{$contrato->id_docente}}" width="fit-content" onclick="pdf(this.id, '{{$contrato->ano_contrato}}')" ><i class="fa-solid fa-file-contract" style="color: #4CAF50;margin:5px"></i>Ver o Contrato</button></br>
                                    <button class="mini-menu" id="{{$contrato->id_docente}}" width="fit-content" onclick="load_disciplinas(this.id, '{{$contrato->ano_contrato}}')" ><i class="fa-solid fa-table-list" style="color: #4CAF50;margin:5px"></i>Disciplinas</button>
                                    @if($contrato->resultado_ta != "Aprovado")
                                        <button class="mini-menu" id="{{$contrato->id_docente}}" onclick="aprovado(this.id, '{{ $contrato->ano_contrato }}')"><i class="fa-solid fa-check"></i>Aprovado ?</button>
                                    @endif
                                    @if($contrato->resultado_ta!="Reprovado")
                                        <button class="mini-menu" id="{{$contrato->id_docente}}" onclick="reprovado(this.id, '{{ $contrato->ano_contrato }}')" ><i class="fa-solid fa-check"></i>Reprovado ?</button>
                                    @endif
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
          
       
            </div>
        </div>

    <script>
        function reprovado(id_docente, ano){
            console.log("ola")
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: '/contrato/reprovar',
                data: {ano_contrato: ano, id_docente: id_docente

                },
                success: function (response) {
                    console.log(response);
                    if (jQuery.isEmptyObject(response.errors)) {
                        $('#feedback').html('<div class="alert alert-success">' + response.response + '</div>');
                    }else{
                        var errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each(response.errors, function (key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                            console.log(value)
                        });
                        errorsHtml += '</ul></div>';
                        $('#feedback').html(errorsHtml);
                    }
                },
                error: function () {
                    alert("error");
                }
            });
        }
        function aprovado(id_docente, ano){
            console.log("ola")
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: '/contrato/aprovar',
                data: {ano_contrato: ano, id_docente: id_docente

                },
                success: function (response) {
                    console.log(response);
                    if (jQuery.isEmptyObject(response.errors)) {
                        $('#feedback').html('<div class="alert alert-success">' + response.response + '</div>');
                    }else{
                        var errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each(response.errors, function (key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                            console.log(value)
                        });
                        errorsHtml += '</ul></div>';
                        $('#feedback').html(errorsHtml);
                    }
                },
                error: function () {
                    alert("error");
                }
            });
        }

    </script>
     
    </body>
