


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
    </style>

<body class="antialiased">

     <script defer>
    document.addEventListener("DOMContentLoaded", function() {

        var bi;
        var nuit;
        console.log('validacao.js');

        bi = document.getElementById('bi');
        
        bi.addEventListener('keyup', function(event) {
            
            //var typedText = event.target.value;
            //console.log("Typed text:", typedText);
            response = verificar(event.target);
            console.log(response);
            console.log(response.color);
            document.getElementById('bi_msg_req').textContent = response.msg;
            document.getElementById('bi_msg_req').style.color = response.color;
        });
        nuit = document.getElementById('nuit');

        nuit.addEventListener('keyup', function(event) {
            response = verificar_nuit(event.target);
            console.log(response);
            console.log(response.color);
            document.getElementById('nuit_msg_req').textContent = response.msg;
            document.getElementById('nuit_msg_req').style.color = response.color;
        });
        
    });

    function update_docente(event) {
    event.preventDefault();
    erros_bi_nuit = [];
    var iterator = 0;
    var response_bi = verifica_digitos(document.getElementById('bi').value);
    var response_nuit = verifica_digitos(document.getElementById('nuit').value);
    console.log(response_bi);
    console.log(response_nuit);

    if(!isNaN(parseFloat(response_bi.last_char))) {
        erros_bi_nuit[iterator] = mensagens.ultimo_carater_error_bi;
        iterator++; 
    }
    if(response_bi.nr_chars > 1) {
        erros_bi_nuit[iterator] = mensagens.caracteres_invalidos_bi;
        iterator++;
    }

    if(response_nuit.nr_chars > 0) {
        erros_bi_nuit[iterator] = mensagens.caracteres_invalidos_nuit;
        iterator++;
    }

    if(iterator > 0) {
        var bi_nuit_errorsHtml = '<div class="alert alert-danger"><ul>';
        for(var i = 0; i < erros_bi_nuit.length; i++) {
            bi_nuit_errorsHtml += '<li>' + erros_bi_nuit[i] + '</li>';
        }
        bi_nuit_errorsHtml += '</ul></div>';
        $('#feedback').html(bi_nuit_errorsHtml);
    } else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/docente/update',
            data: $('#docente-reg').serialize(),
            success: function (data) {
                if (jQuery.isEmptyObject(data.errors)) {
                    console.log(data.response);
                    console.log(data);
                    $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                    
                    // Chama a função get_areas passando o id_docente
                   // get_areas(data.id_docente);
                   alert("Actualização guardada");
                   window.top.location = window.top.location;
                } else {
                    var errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(data.errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                        console.log(value);
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
}

    
    </script>



@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
      
            <div id="info">
                <p><strong>Detalhes do Contrato</strong></p>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

    

            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col" colspan="2">Dados Pessoais</th>
                

                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>Nome do Contratado</td>
                            <td>{{$docente->nome_docente}} - {{$docente->apelido_docente}}</td>
                        </tr>
                        <tr>
                            <td>Contrato para </td>
                            <td>Titoria</td>
                        </tr>
                        <tr>
                            <td>Horas de Trabalho</td>
                            <td>{{$contrato->carga_horaria}} Horas</td>
                        </tr>

                        <tr>
                            <td>Faculdade</td>
                            <td>{{$docente->nome_faculdade}}</td>
                        </tr>
                        <tr>
                            <td>Nível Académico do Tutor</td>
                            <td>{{$docente->designacao_nivel}}</td>
                        </tr>
                        <tr>
                            <td>Duração</td>
                            <td>1 Ano (equivalente a 2 semestres de {{$contrato->ano_contrato}})</td>
                        </tr>
                        @if($contrato->estado=="Na Up")
                        <tr>
                            <td>Estado do Contrato</td>
                            <td>{{$contrato->estado}}</td>
                        </tr>
                        @else
                        <tr>
                            <td>Estado do Contrato</td>
                            <td>{{$contrato->resultado_ta}} no Tribunal Administrativo</td>
                        </tr>
                            @if($contrato->resultado_ta=="Aprovado")
                                <tr>
                                    <td>Anexar o Contrato Com Visto do Tribunal Administrativo</td>
                                    <td>
                                        <form id="modal-submit-contrato" method="POST" action="/docente/upload_contrato" enctype="multipart/form-data">
                                           
                                        @csrf
                                        <input class="form-control form-control-sm" type="file" name="ficheiro" id="file_ta"/>
                                        <input type="hidden" name="id" id="id" value="{{$docente->id_docente}}"/>
                                        <input type="hidden" name="ano" id="ano" value="{{$contrato->ano_contrato}}"/>
                                     
                                </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" class="rounded bg-green-600 text-white px-2 py-1">Guardar Contrato com visto</button></td>
                                    </form>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a class="rounded bg-green-600 text-white px-2 py-1" href="/contrato/download/{{$contrato->ano_contrato}}/{{$docente->id_docente}}">Baixar Contrato</a></td>
                                </tr>
                            @else
                                <tr>
                                    <td>Anexar Justificação do TA</td>
                                    <td>
                                    <form id="modal-submit-contrato" method="POST" action="/docente/upload_contrato" enctype="multipart/form-data">
                                        
                                        @csrf
                                        <input class="form-control form-control-sm" type="file" name="ficheiro" id="file_ta"/>
                                        <input type="hidden" name="id" id="id" value="{{$docente->id_docente}}"/>
                                        <input type="hidden" name="ano" id="ano" value="{{$contrato->ano_contrato}}"/></form></td>
                                    </td>
                                    </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" class="rounded bg-green-600 text-white px-2 py-1">Guardar Justificação</button></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a class="rounded bg-green-600 text-white px-2 py-1" href="/contrato/download/{{$contrato->ano_contrato}}/{{$docente->id_docente}}">Baixar informe do Ta</a></td>
                                </tr>
                            @endif
                        @endif

                    </tbody>
            </table>

            <table id="example" class="table table-hover" style="width:100%">
                    <thead>
                    <th scope="col" colspan="6">Módulos/Disciplinas</th>
                        <tr><th>Disciplina</th><th>Curso</th><th>Ano</th><th>Semestre</th><th>Carga Horaria</th></tr>
                    </thead>
                    <tbody>
                    @foreach($disciplinas as $disciplina)
                        <tr>
                            <td>{{$disciplina->nome_disciplina}}</td>
                            <td>{{$disciplina->designacao_curso}}</td>
                            <td>{{$disciplina->ano}}</td>
                            <td>{{$disciplina->semestre}}</td>
                            <td>{{$disciplina->horas_contacto}}</td>
                          
                        </tr>
                    @endforeach
                </tbody>
                </table>
         
            </div>
        
            
        </div>
    </div>
</div>


    <script>
        function modoEditar() {
          //  $('#faculdade')val = $('#temp-faculdade').val;
            document.getElementById('faculdade').value = document.getElementById('temp-faculdade').value 
            document.getElementById('nivel').value = document.getElementById('temp-nivel').value 
            $('#modal-formulario-edit').modal('show');
        }


    </script>
    
</body>