

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
        opacity: 0.5;
        pointer-events: none;
    }
     .modal-backdrop {
        z-index: 1040; /* Lower than the default z-index of the modal */
    }
    </style>

<body class="antialiased">
   @include('header2')

   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-contrato-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>
<!-- Scrollable modal -->

<main class="main-section">
        @include('side')
    <div class="content-section">
      <div id="content-header"><label id="cont-title">Contratos</label></div>
        <div id="info">
        <button id="bt_novo_contrato" class="rounded bg-green-600 text-white px-2 py-1" width="fit-content">Novos contratos<i class="fa-solid fa-plus"></i></button>
               
            <script>
                $(document).ready(function(){
                    new DataTable('#example');

                     /*$('#bt_novo_contrato').on('click', function(){
                         $('.modal').show();
                     });
                    $('#close-modal').on('click', function(){
                        $('.modal').hide();
                    });*/
                   
                    $('#bt_novo_contrato').on('click', function(){
                        $('body').addClass('modal-opened');
                        $('.modal').show();
                    });

                    $('#close-modal').on('click', function(){
                        $('body').removeClass('modal-opened');
                        $('.modal').hide();
                    });
                    
                    $('#registar_novos').on('click', function(){
                        console.log("ola")
                        $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'post',
                            url: '/cead_template2/contrato/novos_contratos',
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
                    })
   
                });
               
            </script>

         
                <h1>Contratos</h1>
               
            <table id="example" class="table table-striped" style="width:100%">
                <thead><tr><th>Nome Completo</th><th>Nivel</th><th>tipo</th><th>Carga H</th><th>remuneração</th><th>ano</th><th></th><th></th></tr></thead>
                <tbody>
                @foreach($contratos as $contrato)
                    <tr>
                        <td>{{$contrato->nome_docente}}-{{$contrato->apelido_docente}}</td>
                        <td>{{$contrato->designacao_nivel}}</td>
                        <td>{{$contrato->designacao_tipo_contrato}}</td>
                        <td>{{$contrato->carga_horaria}}</td>
                        <td>{{$contrato->remuneracao}}</td>
                        <td>{{$contrato->ano_contrato}}</td>
                        <td><button id="{{$contrato->id_docente}}" width="fit-content" class="rounded bg-green-600 text-white px-2 py-1" onclick="pdf(this.id)">Gerar pdf</button></td>
                        <td><button id="{{$contrato->id_docente}}" width="fit-content" class="rounded bg-green-600 text-white px-2 py-1" onclick="load_disciplinas(this.id)">Disciplinas</button></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
          
        
            <div class="popup" width="80%">
                <span class="close-btn">&times;</span>
            </div>
            <!-- modal -->
            <div class="modal" tabindex="-1">
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
                        <button type="button" id="close-modal" class="rounded bg-red-600 text-white px-2 py-1" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="registar_novos" class="rounded bg-green-600 text-white px-2 py-1">Registar</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->
            </div>
        </div>
    </main>
    @include('../footer')
    <script>
        function pdf(id){
             window.location.href = "/cead_template2/contrato/gerar_pdf?id_docente="+id;
        }
        function load_disciplinas(id){
            window.location.href = "/cead_template2/docente/ver_disciplinas?id_docente="+id;
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
          url: '/cead_template2/docente/get_disciplinas',
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
