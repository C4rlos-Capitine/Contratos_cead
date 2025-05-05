


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
        document.getElementById('home1').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>
     <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('home1').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
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


                <div class="row g-3 needs-validation">
                @if(auth()->user()->tipo_user == 1)
                <h3>Dados pessoais</h3>
             
                <div class="col-md-6">

                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" id="floatingInput" name="nome" value="{{$docente->nome_docente}}" autocomplete="off" disabled>
                            <label class="input-label" for="floatingInput">Nome</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" id="floatingInput" name="apelido" value="{{$docente->apelido_docente}}"0 disabled>
                            <label class="input-label" for="floatingInput">Apelido</label>
                        </div>

                    </div>
                    <div class="col-md-6">
                    
                            <div class="form-floating mb-3">
                                <input required="true" type="text" class="form-control" name="bi" value="{{$docente->bi}}" disabled>
                                <label class="input-label" for="floatingInput">BI</label>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input required="true" type="text" class="form-control" id="floatingInput" name="nuit" value="{{$docente->nuit}}" disabled>
                                <label class="input-label" for="floatingInput">Nuit</label>
                            </div>
                         </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" id="floatingInput" name="nacionalidade" value="{{$docente->nacionalidade}}" disabled>
                            <label class="input-label" for="floatingInput">Nacionalidade</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" name="email"value="{{$docente->email}}" disabled>
                            <label class="input-label" for="floatingInput">Email</label>
                        </div>
                    </div>
                <h3>Informação Académica</h3>
                <input type="hidden" id="temp-faculdade" value="{{$docente->id_faculdade_in_docente}}">
                <input type="hidden" id="temp-nivel" value="{{$docente->id_nivel}}">
                    <div class="col-md-6">

                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" id="floatingInput" name="nome" value="{{$docente->designacao_nivel}}" autocomplete="off" disabled>
                            <label class="input-label" for="floatingInput">Nível</label>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" id="floatingInput" name="nome" value="{{$docente->nome_faculdade}}" autocomplete="off" disabled>
                            <label class="input-label" for="floatingInput">Faculdade</label>
                        </div>
                    </div>
         
            </div>
            @elseif(auth()->user()->tipo_user == 3)
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col" colspan="2">Dados Pessoais</th>
                

                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>Nome Completo</td>
                            <td>{{$docente->nome_docente}} - {{$docente->apelido_docente}}</td>
                        </tr>
                        <tr>
                            <td>Bilhete de Identidade</td>
                            <td>{{$docente->bi}}</td>
                        </tr>
                        <tr>
                            <td>Nuit</td>
                            <td>{{$docente->nuit}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$docente->email}}</td>
                        </tr>
                        <tr>
                            <td>Faculdade</td>
                            <td>{{$docente->nome_faculdade}}</td>
                        </tr>
                        <tr>
                            <td>Nível Académico</td>
                            <td>{{$docente->designacao_nivel}}</td>
                        </tr>
                        <tr>
                            <td>Nível Académico</td>
                            <td>{{$docente->nacionalidade}}</td>
                        </tr>
                        <tr>
                            <th scope="col" colspan="2">Informação Académica</th>
                        </tr>
                        <tr>
                            <td>Nível Académico</td>
                            <td>{{$docente->designacao_nivel}}</td>
                        </tr>
                    </tbody>
            </table>
            @endif
            <div class="row g-3 align-items-center">
                <div class="row" id="div-button">
                        <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" onclick="modoEditar()">editar</button>
                    </div>
                    <div class="row" id="div-button">
                        <button class="rounded bg-green-600 text-white px-2 py-1" id="{{$docente->id_docente}}" onclick="get_areas2(this.id)">ver áreas Cientificas</button>
                    </div>
                    <div class="row" id="div-button">
                        <button class="rounded bg-green-600 text-white px-2 py-1" id="{{$docente->id_docente}}" onclick="get_areas(this.id)">Alocar áreas Cinentificas</button>
                    </div>
            </div>
        </div>


        



                    <!-- Modal Bootstrap -->
    <div class="modal fade bd-example-modal-lg" id="modal-lista2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="list_docentes_title2"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <div class="col-md-3">
                            
                        <label class="input-label" for="floatingInput">Ano do contrato</label>
                        <input required="true" id="ano_contrato" type="number" name="ano_contrato" min="1900" max="2100" step="1" class="form-control">
                        </div>
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Área</th>
                            </tr>
                        </thead>
                        <tbody id="docentes-table2">
                            <!-- As linhas de dados serão inseridas aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modal-formulario-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="list_docentes_title2"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
            <div id="feedback"></div>
            <form id="docente-reg" class="needs-validation">
            @csrf
             <input type="hidden" name="id" id="id_docente" value="{{$docente->	id_docente}}">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label class="input-label" for="floatingInput">Nome:<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="nome" value="{{$docente->nome_docente}}" placeholder="nome" autocomplete="off">
                        </div>
                    </div>
                
                    <div class="col">
                        <div class="form-group">
                        <label class="input-label" for="floatingInput">Apelido:<span style="color:red">*</span></label>
                        <input  type="text" class="form-control" name="apelido" value="{{$docente->apelido_docente}}"  placeholder="apelido" autocomplete="off">
                        <small id="emailHelp" class="form-text text-muted">50 caracteres no maximo</smal>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="input-label" for="floatingInput">BI:<span style="color:red">*</span></label>
                            <input required="true" id="bi" type="text" class="form-control" name="bi" value="{{$docente->bi}}" placeholder="bi" autocomplete="off">
                            <small id="bi_msg_req" class="form-text text-muted">13 caracteres</small>
                        </div>
                    </div>
                
                
                    <div class="col">
                        <div class="form-group">
                            <label class="input-label" for="floatingInput">Nuit:<span style="color:red">*</span></label>
                            <input required="true" id="nuit" type="text" class="form-control" name="nuit" value="{{$docente->nuit}}" placeholder="nuit" autocomplete="off">
                            <small id="nuit_msg_req" class="form-text text-muted">8 caracteres</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="input-label" for="floatingInput">Nacionalidade:<span style="color:red">*</span></label>
                        <input required="true" type="text" class="form-control" name="nacionalidade" value="{{$docente->nacionalidade}}" placeholder="nacionalidade">
                        
                    </div>
                
                    <div class="col">
                        <label class="input-label" for="floatingInput">Email:<span style="color:red">*</span></label>
                        <input required="true" type="text" class="form-control" name="email" value="{{$docente->email}}" placeholder="email">
                        <small id="emailHelp" class="form-text text-muted">deve conter &quot;@&quot;</smal>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Nivel:<span style="color:red">*</span></label>
                    <select id="nivel" name="nivel" class="form-select" required>
                        <option selected disabled value="">Escolha..</option>
                        @foreach($niveis as $nivel)
                            <option value="{{$nivel->id_nivel}}">{{$nivel->designacao_nivel}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Faculdade</label>
                    <select id="faculdade" name="faculdade" class="form-select" required>
                        <option selected disabled value="">Escolha..</option>
                        @foreach($faculdades as $faculdade)
                            <option value="{{$faculdade->id_faculdade}}">{{$faculdade->nome_faculdade}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        
            Genero:
            <br>
            Masculino:<input type="radio" value="masculino" name="genero"><br>
            Femenino:
            <input  type="radio" value="femenino" name="genero">
    
        </form>
        <div class="row" id="div-button">
            <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" onclick="update_docente(event)">Guardar</button>
        </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

    <div class="modal fade bd-example-modal-lg" id="modal-lista" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="list_docentes_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                    <div id="feedback2"></div>
                        <div class="col-md-3">
                            
                        <label class="input-label" for="floatingInput">Ano do contrato</label>
                        <input required="true" id="ano_contrato" type="number" name="ano_contrato" min="1900" max="2100" step="1" class="form-control">
                        </div>
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Área</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="docentes-table">
                            <!-- As linhas de dados serão inseridas aqui -->
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