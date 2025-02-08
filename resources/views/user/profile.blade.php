<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('head2')
    <style>
           #div-button{
            margin: 10px;
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
            document.getElementById('load-user-profile').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        });
    </script>
<body class="antialiased">
@include('header2')

<main class="main-section">
    @include('side')
    <div class="content-section">
        <div id="content-header">
            <label id="cont-title">Meu Perfil</label>
        </div>
        <div id="info">

            <div id="feedback"></div>


            <table class="table table-striped">
                <tr>
                    <td>Nome</td>
                    <td>{{auth()->user()->name}}</td>
                </tr>
                <tr>
                    <td>Perfil</td>
                    @if(auth()->user()->tipo_user == 1)
                    <td>Administrador</td>
                    @else
                    <td>Tutoria</td>
                    @endif
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{auth()->user()->email}}</td>
                </tr>
                
            </table>
            </div>

            <div class="row">
            <div id="div-button"><button type="button" class="rounded bg-green-600 text-white px-2 py-1" onclick="show_editarForm()">Editar Dados</button></div>
            <div id="div-button"><button type="button" class="rounded bg-green-600 text-white px-2 py-1" onclick="mudar_senhaForm()">Alterar senha</button></div>
    </div>
    </div>
</main>





<script>

    function show_editarForm(){
        $('#modal-edit-dados').modal('show');
    }

    function mudar_senhaForm(){
        $('#modal-edit-senha').modal('show');
    }
    function editar_dados(){
        
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log("ola");
    //event.preventDefault(); // Prevent the form from being submitted traditionally
    
    console.log("ola");
    $.ajax({
        type: 'POST',
        url: '/user/edit_data',
        data: $('#edit-user-form').serialize(),
        success: function (data) {
            if (jQuery.isEmptyObject(data.errors)) {
                console.log(data.response);
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');

            } else {
                // Se houver erros, exiba-os
                var errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each(data.errors, function (key, value) {
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

    function mudar_senha(){
          
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log("ola");
    //event.preventDefault(); // Prevent the form from being submitted traditionally
    
    console.log("ola");
    $.ajax({
        type: 'POST',
        url: '/user/change_password',
        data: $('#password-user-form').serialize(),
        success: function (data) {
            if (jQuery.isEmptyObject(data.errors)) {
                console.log(data.response);
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');

            } else {
                // Se houver erros, exiba-os
                var errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each(data.errors, function (key, value) {
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

    
</script>

@include('../footer')
</body>

<!-- bootstrap modal-->
<div class="modal fade bd-example-modal-lg" id="modal-edit-dados" tabindex="1" style="z-index:9999" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="list_docentes_title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-user-form" >
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
            @csrf <!-- Token de segurança para formulários em Laravel -->



            <input type="hidden" name="id" value="{{auth()->user()->id}}"/>

            </form>
            <div id="div-button"><button type="button" class="rounded bg-green-600 text-white px-2 py-1" onclick="editar_dados()">Editar Dados</button></div>
        </div>
    </div>
</div>

<!-- bootstrap modal-->
<div class="modal fade bd-example-modal-lg" id="modal-edit-senha" tabindex="1" style="z-index:9999" role="dialog" aria-labelledby="myLargeModalLabel" padding="15px" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="list_docentes_title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="password-user-form" style="margin:15px">
            <div class="col">
                <div class="form-group">
                    <label>Senha Acutal</label>
                    <input required="true" type="password" class="form-control" id="senha_actaul" name="senha_actaul" placeholder="Senha actaul">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Nova Senha</label>
                    <input required="true" type="password" class="form-control" id="password" name="senha_nova" placeholder="Nova Senha">
                </div>
            </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Confirmar Senha</label>
                    <input required="true" type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Confirmar Senha">
                </div>
            </div>
            <input type="hidden" name="id" value="{{auth()->user()->id}}"/>
            <div id="div-button"><button type="button" class="rounded bg-green-600 text-white px-2 py-1" onclick="mudar_senha()">Alterar</button></div>

            @csrf <!-- Token de segurança para formulários em Laravel -->
           
            </form>
        </div>
    </div>
</div>

</html>
