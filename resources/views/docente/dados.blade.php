


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
   @include('header2')
   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-docente-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Informações pessoais e Académicas</label></div>
            <div id="info">


                <div id="docente-reg" class="row g-3 needs-validation">
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
                <div class="row" id="div-button">
                    <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" onclick="reg_docente(event)">editar</button>
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
       
        </main>
        @include('../footer')
</body>