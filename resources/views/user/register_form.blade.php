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
    <script src="javascript/template-controller.js"></script>

    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('load-user-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        });
    </script>
<body class="antialiased">
@include('header2')

<main class="main-section">
    @include('side')
    <div class="content-section">
        <div id="content-header">
            <label id="cont-title">Registrar Usuário</label>
        </div>
        <div id="info">
            <h3>Registrar Novo Usuário</h3>
            <div id="feedback"></div>
            <form id="user-reg">
                @csrf <!-- Token de segurança para formulários em Laravel -->

                <div id="feedback"></div>
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nome</label>
                            <input required="true" type="text" class="form-control" id="name" name="name" placeholder="Nome">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Email</label>
                            <input required="true" type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Senha</label>
                            <input required="true" type="password" class="form-control" id="password" name="password" placeholder="Senha">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tipo de Usuário</label>
                            <select class="form-control" id="tipo_user" name="tipo_user" required>
                                <option value="1">Administrador</option>
                                <option value="2">Usuário Comum</option>
                            </select>
                        </div>
    
    </div>
                </div>

                </div>
            </form>
            <div class="row">
            <div id="div-button"><button type="button" class="rounded bg-green-600 text-white px-2 py-1" onclick="reg_usuario()">Registrar Usuário</button></div>
            <div id="div-button"><button type="button" class="rounded bg-green-600 text-white px-2 py-1" onclick="get_users()">Ver Usuários</button></div>
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
                            
                        <label class="input-label" for="floatingInput">Utilizadores</label>
                        <input required="true" id="ano_contrato" type="number" name="ano_contrato" min="1900" max="2100" step="1" class="form-control">
                    
                        </div>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Perfil</th>
                            </tr>
                        </thead>
                        <tbody id="users">
                            <!-- As linhas de dados serão inseridas aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@include('../footer')
</body>
</html>
