<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    </style>

<body class="antialiased">
   @include('header2')
   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-tecnico-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        var bi;
        var nuit;

        bi = document.getElementById('bi');
        bi.addEventListener('keyup', function(event) {
            response = verificar(event.target);
            document.getElementById('bi_msg_req').textContent = response.msg;
            document.getElementById('bi_msg_req').style.color = response.color;
        });

        nuit = document.getElementById('nuit');
        nuit.addEventListener('keyup', function(event) {
            response = verificar_nuit(event.target);
            document.getElementById('nuit_msg_req').textContent = response.msg;
            document.getElementById('nuit_msg_req').style.color = response.color;
        });
    });
    </script>

<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Registar Técnico</label></div>
        <div id="info">
            <div id="feedback"></div>
            <form id="tecnico-reg" class="needs-validation">
            @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label class="input-label">Nome:<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="nome_tecnico" placeholder="nome" autocomplete="off">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            <label class="input-label">Apelido:<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="apelido_tecnico" placeholder="apelido" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="input-label">BI:<span style="color:red">*</span></label>
                            <input required id="bi" type="text" class="form-control" name="bi" placeholder="BI">
                            <small id="bi_msg_req" class="form-text text-muted">13 caracteres</small>
                        </div>
                        <div class="col">
                            <label class="input-label">Nuit:<span style="color:red">*</span></label>
                            <input required id="nuit" type="text" class="form-control" name="nuit" placeholder="Nuit">
                            <small id="nuit_msg_req" class="form-text text-muted">8 caracteres</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="input-label">Nacionalidade:<span style="color:red">*</span></label>
                            <input required type="text" class="form-control" name="nacionalidade" placeholder="Nacionalidade">
                        </div>
                        <div class="col">
                            <label class="input-label">Email:<span style="color:red">*</span></label>
                            <input required type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nivel:<span style="color:red">*</span></label>
                            <select name="id_nivel" class="form-select" required>
                                <option selected disabled value="">Escolha..</option>
                                @foreach($niveis as $nivel)
                                    <option value="{{$nivel->id_nivel}}">{{$nivel->designacao_nivel}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Faculdade:<span style="color:red">*</span></label>
                            <select name="id_faculdade_in_tecnico" class="form-select" required>
                                <option selected disabled value="">Escolha..</option>
                                @foreach($faculdades as $faculdade)
                                    <option value="{{$faculdade->id_faculdade}}">{{$faculdade->nome_faculdade}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Curso:<span style="color:red">*</span></label>
                            <select name="id_curso" class="form-select" required>
                                <option selected disabled value="">Escolha..</option>
                                @foreach($cursos as $curso)
                                    <option value="{{$curso->id_curso}}">{{$curso->designacao_curso}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label>Genero:<span style="color:red">*</span></label><br>
                    Masculino:<input type="radio" value="masculino" name="genero"><br>
                    Femenino:<input type="radio" value="femenino" name="genero">
                    
            </form>
            <div class="row">
                <div id="div-button">
                    <button class="rounded bg-green-600 text-white px-2 py-1" onclick="reg_tecnico(event)" id="submit">Registar</button>
                </div>
                <div class="row" id="div-button">
                    <button class="rounded bg-green-600 text-white px-2 py-1" onclick="get_tecnicos(event)" id="submit">Ver</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- bootstrap modal-->
<div class="modal fade bd-example-modal-lg" id="modal-lista-users" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <div id="feedback"></div>
                        <div class="col-md-3">
                            
                        <label class="input-label" for="floatingInput">Técnicos de laboratório</label>
                        <input required="true" id="ano" type="number" name="ano_contrato" placeholder="Informe o ano do contrato" min="1900" max="2100" step="1" class="form-control">
                    
                        </div>
                        <thead>
                            <tr>
                                <th>Nome</th>

                                <th>Curso</th>
 
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tecnicos">
                            <!-- As linhas de dados serão inseridas aqui -->
                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="codigo_disciplina" name="codigo_disciplina"/>
            </div>
        </div>
    </div>
@include('../footer')
</body>
</html>
