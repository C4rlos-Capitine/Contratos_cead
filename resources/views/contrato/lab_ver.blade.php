

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
    .row {
        margin-top: 5px;
        padding: 5px;
        text-align: left;
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
    </style>

<body class="antialiased">
   @include('header2')

   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-contrato-view-lab').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
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
                    });

                 
                    $('#curso').on('change', function(){
                        $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'GET',
                            url: '/disciplina/get_by_categoria',
                            data: {id_cat: 3, id_curso: document.getElementById('curso').value},
                            success: function (response) {
                                console.log(response);
                                var selectElement = document.getElementById('disciplina');
                                selectElement.innerHTML = "";
                                response.disciplinas.forEach(function(disciplina) {
                                    console.log(disciplina.nome_disciplina)
                                    var option = document.createElement('option');
                                    option.value = disciplina.codigo_disciplina;
                                    option.textContent = disciplina.nome_disciplina;
                                    selectElement.appendChild(option);
                                });
                                
                            },
                            error: function () {
                                alert("error");
                            }
                        });
                    });

                    $('#registar').on('click', function(){
                        $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            url: '/contrato/ver_lab_save',
                            data: $('#contrato_lab').serialize(),
                            success: function (response) {
                                console.log(response);
                                if(response.status==1){
                                    $("#feedback").html('<div class="alert alert-success">' + response.response + '</div>')
                                }
                                
                                
                            },
                            error: function () {
                                alert("error");
                            }
                        });
                    });



                }); 
               
            </script>

         
                <h1>Contratos</h1>
               
            <table id="example" class="table table-striped" style="width:100%">
                <thead><tr><th>Nome Completo</th><th>Curso</th><th>Módulo</th><th>ano</th><th></th></tr></thead>
                <tbody>
                @foreach($contratos as $contrato)
                    <td>{{$contrato->nome_docente}}</td>
                    <td>{{$contrato->designacao_curso}}</td>
                    <td>{{$contrato->nome_disciplina}}</td>
                    <td>{{$contrato->ano_contrato}}</td>
                    <td><button id="{{$contrato->id_docente}}" class="rounded bg-green-600 text-white px-2 py-1" onclick="pdf(this.id)" width="fit-content">ver PDF</i></button>
                    </td>
                @endforeach
                </tbody>
            </table>
          
            <!-- modal -->
            <div class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">gerar novo contrato</h5>
                        <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="feedback"></div>
                        <form id="contrato_lab">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Curso<span style="color:red">*</span></label>
                                        <select id="docente" name="id_docente" class="form-select" required>
                                            <option selected disabled value="">Docente</option>  
                                            @foreach($docentes as $docente) 
                                                <option value="{{$docente->id_docente}}">{{$docente->nome_docente}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="input-label"  max="2100" for="floatingInput">Ano</label>
                                        <input required="true"type="number" class="form-control" min="1900" max="2100" step="1"name="ano" autocomplete="off">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Curso<span style="color:red">*</span></label>
                                    <select id="curso" name="curso" class="form-select" required>
                                    <option selected disabled value="">Curso</option>  
                                        @foreach($cursos as $curso) 
                                            <option value="{{$curso->id_curso}}">{{$curso->designacao_curso}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Modulo<span style="color:red">*</span></label>
                                    <select id="disciplina" name="disciplina" class="form-select" id="validationCustom04" required>
                                    
                                    <option selected disabled value="">Curso</option>   
                                    </select>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close-modal" class="rounded bg-red-600 text-white px-2 py-1" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="registar" class="rounded bg-green-600 text-white px-2 py-1">Registar</button>
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
             window.location.href = "/contrato/gerar_pdf_lab?id_docente="+id;
        }
        function load_disciplinas(id){
            window.location.href = "/docente/ver_disciplinas?id_docente="+id;
        }
            //document.addEventListener("DOMContentLoaded", function () {
        document.querySelector(".close-btn").addEventListener("click", function(){
            document.body.classList.remove("active-popup");
            
        });
  
        
  
    </script>
</body>
