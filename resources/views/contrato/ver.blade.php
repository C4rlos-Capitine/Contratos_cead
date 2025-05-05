

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


   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-contrato-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>
<!-- Scrollable modal -->

@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
      
            <div id="info">
                <p>Contratos</p>
        <button id="bt_novo_contrato" class="rounded bg-green-600 text-white px-2 py-1" width="fit-content" onclick="load_form()">Novos contratos<i class="fa-solid fa-plus"></i></button>
        <button id="bt_novo_contrato" class="rounded bg-green-600 text-white px-2 py-1" width="fit-content" onclick="load_form_sendTa()">Marcar como enviado para TA</button>
             
               <script>

                   $(document).ready(function(){
                       new DataTable('#example');
   
          
                      
                       $('#bt_novo_contrato').on('click', function(){
                           $('body').addClass('modal-opened');
                           $('#init-contract').show();
                       });
   
                       $('#close-modal').on('click', function(){
                           $('body').removeClass('modal-opened');
                           $('#init-contract').hide();
                       });
      
                   });
                  
               </script>
         
                <h1>Contratos</h1>
               
            <table id="example" class="table table-hover" style="width:100%">
                <thead><tr><th>Nome Completo</th><th>Assinado pelo docente</th><th>Assinado pela UP</th><th>Estado</th><th>ano</th><th></th></tr></thead>
                <tbody>
                @foreach($contratos as $contrato)
                    <tr>
                        <td>{{$contrato->nome_docente}}-{{$contrato->apelido_docente}}</td>
                        <td>{{$contrato->assinado_docente}}</td>
                        <td>{{$contrato->assinado_up}}</td>
                        <td>{{$contrato->estado}}</td>
                        <td>{{$contrato->ano_contrato}}</td>
                        <td>
                        <div class="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                                <div class="dropdown-content">
                                    <button class="mini-menu" id="{{$contrato->id_docente}}" width="fit-content" onclick="pdf(this.id, '{{$contrato->ano_contrato}}')" ><i class="fa-solid fa-file-contract" style="color: #4CAF50;margin:5px"></i>Ver o Contrato</button></br>
                                    <button class="mini-menu" id="{{$contrato->id_docente}}" width="fit-content" onclick="load_disciplinas(this.id, '{{$contrato->ano_contrato}}')" ><i class="fa-solid fa-table-list" style="color: #4CAF50;margin:5px"></i>Disciplinas</button>
                                    <a class="mini-menu" id="{{$contrato->id_docente}}" width="fit-content" href="/contrato/detalhes/{{$contrato->ano_contrato}}/{{$contrato->id_docente}}"><i class="fa-sharp fa-solid fa-circle-info" style="color: #4CAF50;margin:5px"></i>Detalhes</a>
                <!-- /contrato/detalhes/{ano}/{id_docente} -->
                                    @if($contrato->assinado_docente=="Não")
                                        <button class="mini-menu" id="{{$contrato->id_docente}}" onclick="update_contrato_assinado1(this.id, '{{ $contrato->ano_contrato }}')"><i class="fa-solid fa-check"></i>Marcar como assinado pelo docente</button>
                                    @endif
                                    @if($contrato->assinado_up=="Não")
                                        <button class="mini-menu" id="{{$contrato->id_docente}}" onclick="update_contrato_assinado2(this.id, '{{ $contrato->ano_contrato }}')" ><i class="fa-solid fa-check"></i>Marcar como assinado pelo Representante da UP</button>
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

     
  
            <!-- modal -->
            <div class="modal" id="init-contract" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">abrir novos contratos</h5>
                        <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="feedback"></div>
                        <div class="col">
                     
                            <label>selecione o ano</label>
                            <input class="form-control" required="true" type="number" id="ano" name="ano" min="1900" max="2100" step="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close-modal" class="rounded bg-red-600 text-white px-2 py-1" data-bs-dismiss="modal" onclick="hide_form()">Fechar</button>
                        <button type="button" id="registar_novos" class="rounded bg-green-600 text-white px-2 py-1" onclick="save_novo_contrato()">Registar</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->

             <!-- modal -->
             <div class="modal" id="send-to-ta" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar para Tribunal administrativo</h5>
                        <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="feedback"></div>
                        <div class="row">
                            <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">Anos<span style="color:red">*</span></label>
                            <select id="ano_contr" name="ano" class="form-select" required>
                                <option selected disabled value="">Escolha..</option>
                                @foreach($anos as $ano)
                                    <option value="{{$ano->ano_contrato}}">{{$ano->ano_contrato}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">Data de Envio<span style="color:red">*</span></label>
                            <input required="true" id="data" type="date" class="form-control" name="data" placeholder="data">
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close-modal" class="rounded bg-red-600 text-white px-2 py-1" data-bs-dismiss="modal" onclick="hide_form_sendTa()">Fechar</button>
                        <button type="button" id="registar_novos" class="rounded bg-green-600 text-white px-2 py-1" onclick="save_set_ta()">Guardar</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->

    <script>
        function load_form(){
            $('body').addClass('modal-opened');
            $('#init-contract').show();
        }

        function load_form_sendTa(){
            $('body').addClass('modal-opened');
            $('#send-to-ta').show();
        }
        function save_novo_contrato(){
            console.log("ola")
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: '/contrato/novos_contratos',
                data: {ano_contrato: document.getElementById('ano').value},
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

        function save_set_ta(){
            console.log("ola")
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: '/contrato/send_to_ta',
                data: {ano_contrato: document.getElementById('ano_contr').value, data: document.getElementById('data').value},
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
        function hide_form(){
            $('body').removeClass('modal-opened');
            $('#init-contract').hide();
        }
        function hide_form_sendTa(){
            $('body').removeClass('modal-opened');
            $('#send-to-ta').hide();
        }
        function pdf(id, ano){
            console.log(ano);
             window.location.href = "/contrato/"+id+"/"+ano;
        }
        function load_disciplinas(id, ano){
            window.location.href = "/docente/ver_disciplinas/"+ano+"/"+id;
        }
            //document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".close-btn").addEventListener("click", function(){
        document.body.classList.remove("active-popup");
        
      });
  
      function loadDisciplinasAlocadas(id){
        console.log(id);
           $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        console.log("ola");
        //event.preventDefault(); // Prevent the form from being submitted traditionally
      
        console.log("ola");
        $.ajax({
          type: 'GET',
          url: '/docente/get_disciplinas',
          data: { id_docente: id },
          success: function (data) {
            console.log(data.response);
            var html = '<table id="tb-data" class="table table-striped"><tr><th>curso</th><th>modulo</th><th>ano</th></tr>';
                   
            data.response.forEach(function (item) {
              html += '<tr><td scope="col">' + item.designacao_curso + '</td><td scope="col">' + item.nome_disciplina + '</td><td scope="col">' + item.ano + '</td></tr>';
            });
            html += '</table>';
            document.querySelector(".popup").innerHTML = html;
            document.body.classList.add("active-popup");
          },
          
          error: function () {
            alert("error");
          }
        });
         

      }
//});    
    </script>
</body>
