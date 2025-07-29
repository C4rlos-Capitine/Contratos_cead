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
           function get_users(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'GET',
            url: '/user/ver',
// Passa o id_docente aqui
            success: function (response) {
                console.log(response);
                console.log(response);
                const tbody = $('#users');
                tbody.empty(); // Clear the table before filling
               // $('#list_docentes_title').text(`Lista de áreas ${id_docente}`);
    
                // Iterate over the data and create table rows
                response.response.forEach(user => {
                    const row = $('<tr></tr>');
                    row.append($('<td></td>').text(user.name));
                    if(user.tipo_user == 1){
                        row.append($('<td></td>').text('Administrador'));
                    }else{
                        row.append($('<td></td>').text('Gestor')); 
                    }
                    
                    //const buttonHtml = `<button id="'${docente.id_docente}'" onclick="disciplinas_docente('${docente.id_docente}')">Ver Disciplinas</button>`;
                    //row.append($('<td></td>').html(buttonHtml));
                   // const buttonHtml2 = `<button id="'${docente.id_docente}'" onclick="gerar('${docente.id_docente}')">Gerar</button>`;
                   // row.append($('<td></td>').html(buttonHtml2));
                    tbody.append(row);
                });
                $('#modal-lista-users').modal('show');
            },
            error: function () {
                alert("error");
            }
        });
    }
    </script>
<body class="antialiased">

@include('side2')
        
<div id="page-content-wrapper">
    @include('nav')
        <!-- Page content-->
    <div class="container-fluid">
       
        <div id="info">
        <h1 class="mt-4">Registar Utilizador</h1>
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
                            <label>Tipo de Utilizador</label>
                            <select class="form-control" id="tipo_user" name="tipo_user" required>
                                <option value="1">Administrador</option>
                                <option value="2">Gestor de Contratos</option>
                            </select>
                        </div>
    
                    </div>
                </div>
                <div class="row">
                    <div id="div-button"><button type="button" class="rounded bg-green-600 text-white px-2 py-1" onclick="reg_usuario()">Registrar Utilizador<i class="fa-solid fa-user-plus action-secondary "></i></button></div>
                    <div id="div-button"><button type="button" class="rounded bg-green-600 text-white px-2 py-1" onclick="get_users()">Ver Utilizador<i class="fa-solid fa-users action-secondary "></i></button></div>
                </div>
                </div>
            </form>

    </div>
    </div>
    </div>


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

</body>
</html>
