

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="javascript/template-controller.js"></script>
    @include('head2')
    <style>
    #div-button{
        width:fit-content;
        height:auto;
        margin: 20px;
    
    }
    @media (max-width:500px){
        #div-button{
            width:fit-content;
            height:auto;
        }
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
      <p>Contratos</div>
      <div id="feedback"></div>
    
       
         
                <h1>Contratos</h1>
           

            <table id="example" class="table table-hover" style="width:100%">
                <thead><tr><th>Nome Completo</th><th>Assinado pelo docente</th><th>Assinado pela UP</th><th>ano</th><th></th></tr></thead>
                    <tbody>
                        @if(!$contratos->isEmpty()) 
                            @foreach($contratos as $contrato)
                                <tr>
                                    <td>{{$contrato->nome_docente}}-{{$contrato->apelido_docente}}</td>
                                    <td>{{$contrato->assinado_docente}}</td>
                                    <td>{{$contrato->assinado_up}}</td>
                                    <td>{{$contrato->ano_contrato}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <i class="fa-solid fa-ellipsis"></i>
                                            <div class="dropdown-content">
                                                <button class="mini-menu" id="{{$contrato->id_docente}}" width="fit-content" onclick="pdf(this.id, '{{$contrato->ano_contrato}}')">
                                                    <i class="fa-solid fa-file-contract" style="color: #4CAF50;margin:5px"></i> Ver o Contrato
                                                </button><br/>
                                                <button class="mini-menu" id="{{$contrato->id_docente}}" width="fit-content" onclick="load_disciplinas(this.id, '{{$contrato->ano_contrato}}')">
                                                    <i class="fa-solid fa-table-list" style="color: #4CAF50;margin:5px"></i> Disciplinas
                                                </button>
                                                @if($contrato->assinado_docente=="Não")
                                                    <button class="mini-menu" id="{{$contrato->id_docente}}" onclick="update_contrato_assinado1(this.id, '{{ $contrato->ano_contrato }}')">
                                                        <i class="fa-solid fa-check"></i> Marcar como assinado pelo docente
                                                    </button>
                                                @endif
                                                <button class="mini-menu" id="{{$contrato->id_docente}}" onclick="loadFormSubmit(this.id, '{{ $contrato->ano_contrato }}')">
                                                        <i class="fa-solid fa-check"></i> Submeter Contrato assinado
                                                    </button>
                <!-- loadFormSubmit() -->
                                          
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                <tr><th colspan="6">Nenhum contrato encontrado</th></tr>
            @endif
        </tbody>

            </table>
          <!-- bootstrap modal-->

<!-- bootstrap modal-->
<div class="modal fade bd-example-modal-lg" id="modal-submit-contrato" tabindex="1" style="z-index:9999" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="list_docentes_title">Submissão do Contrato assinado pelo docente</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
            <form id="modal-submit-contrato" method="POST" action="/docente/upload_contrato" enctype="multipart/form-data">
            <div class="col">
                <div class="form-group">
                    <label>Anexo do contrato Assinado</label>
                    <input required="true" type="file" class="form-control" id="ficheiro" name="ficheiro" placeholder="FIcheiro">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Data</label>
                    <input required="true" type="date" class="form-control" id="data" name="data" placeholder="Data">
                </div>
            </div>
            </div>
            @csrf <!-- Token de segurança para formulários em Laravel -->


            <input type="hidden" id ="ano" name="ano" value=""/>
            <input type="hidden" id="id" name="id" value=""/>
            <div id="div-button"><button type="submit" class="rounded bg-green-600 text-white px-2 py-1" >Submeter</button></div>
            </form>
            
        </div>
    </div>
</div>
   
            </div>
        </div>
        </div>
    <script>
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
      function loadFormSubmit(id, contrato) {
            console.log(id);
            document.getElementById('ano').value = contrato;
            document.getElementById('id').value = id;
            $('#modal-submit-contrato').modal('show'); // Use modal('show') para abrir corretamente
        }

        function submit() {
    console.log("ola");

    // Crie uma nova instância de FormData
    var formData = new FormData($('#edit-user-form')[0]);

    // Configure o AJAX
    $.ajax({
        type: 'post',
        url: '/docente/upload_contrato',
        data: formData,
        contentType: false, // Importante para enviar arquivos
        processData: false, // Importante para enviar FormData
        success: function(response) {
            console.log(response);
            if (jQuery.isEmptyObject(response.errors)) {
                $('#feedback').html('<div class="alert alert-success">' + response.response + '</div>');
            } else {
                var errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each(response.errors, function(key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                    console.log(value);
                });
                errorsHtml += '</ul></div>';
                $('#feedback').html(errorsHtml);
            }
        },
        error: function() {
            alert("error");
        }
    });
}
  
    
//});    
    </script>
</body>




        