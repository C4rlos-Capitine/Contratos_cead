<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="javascript/template-controller.js"></script>
@include('head2')
<style>
    #div-button {
        width: fit-content;
        height: auto;
    }

    @media (max-width: 500px) {
        #div-button {
            width: fit-content;
            height: auto;
        }
    }

    .row {
        margin-top: 5px;
        padding: 5px;
        text-align: left;
        display: flex;
        flex-wrap: wrap; /* Permite que os campos se ajustem em telas menores */
    }

    .form-group {
        flex: 1; /* Faz com que os campos ocupem o mesmo espaço */
        margin-right: 10px; /* Espaçamento entre os campos */
    }

    .form-group:last-child {
        margin-right: 0; /* Remove o espaçamento do último campo */
    }
</style>

<body class="antialiased">

    <script defer>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('load-representante-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        });
    </script>
    @include('side2')

    <div id="page-content-wrapper">
        @include('nav')
        <!-- Page content-->
        <div class="container-fluid">
        <div id="info">
            <div id="feedback"></div>

    @csrf
    <h3>Registar Representante</h3>
    <div id="feedback"></div>
    <div class="row g-3">
    <form id="registro-form"  method="POST">
        <div class="row">
            
            <div class="form-group">
                <label class="input-label" for="nome_representante">Nome</label>
                <input required="true" type="text" class="form-control" name="nome_representante" placeholder="Nome" autocomplete="off">
            </div>
            <div class="form-group">
                <label class="input-label" for="apelido_representante">Apelido</label>
                <input required="true" type="text" class="form-control" name="apelido_representante" placeholder="Apelido" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="id_nivel_contrantante" class="form-label">Nível</label>
                <select name="id_nivel_contrantante" class="form-select" required>
                    <option selected disabled value="">Escolha..</option>
                    @foreach($niveis as $nivel)
                        <option value="{{$nivel->id_nivel}}">{{$nivel->designacao_nivel}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Gênero</label><br>
                <label><input required="true" type="radio" name="genero_representante" value="Masculino"> Masculino</label><br>
                <label><input required="true" type="radio" name="genero_representante" value="Feminino"> Feminino</label><br>
                <label><input required="true" type="radio" name="genero_representante" value="Outro"> Outro</label>
            </div>
        </div>
    </div>
    
        <button class="rounded bg-green-600 text-white px-2 py-1" id="submit">Registar</button>
        
</form>
<button class="rounded bg-green-600 text-white px-2 py-1" onclick="loadRepresentantes()">Representante no ativo</button>
<!--<button class="rounded bg-green-600 text-white px-2 py-1">Historico de representa</button>-->

        </div>
    </div>
    </div>

<!-- bootstrap modal-->
<div class="modal fade bd-example-modal-lg" id="modal-lista-faculdades" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="list_docentes_title">Representantes Ativos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Apelido</th>
                            <th>Gênero</th>
                            <th>Nível Contratante</th>
                        </tr>
                    </thead>
                    <tbody id="dados">
                        <!-- As linhas de dados serão inseridas aqui -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    
    <script>
      $(document).ready(function () {
    $('#registro-form').on('submit', function (e) {
        e.preventDefault(); // Impede o envio tradicional do formulário

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'save', // Substitua pela URL correta
            data: $(this).serialize(), // Serializa os dados do formulário
            success: function (response) {
                if (response.success) {
                    $('#feedback').html('<div class="alert alert-success">' + response.success + '</div>');
                    $('#registro-form')[0].reset(); // Reseta o formulário
                } else if (response.errors) {
                    var errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(response.errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    errorsHtml += '</ul></div>';
                    $('#feedback').html(errorsHtml);
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                $('#feedback').html('<div class="alert alert-danger">Ocorreu um erro ao registrar os dados.</div>');
            }
        });
    });
});
function loadRepresentantes() {
    $.ajax({
        type: 'GET',
        url: '/representante/ativo', // URL para buscar os representantes
        success: function (response) {
            // Limpa o conteúdo existente no corpo da tabela
            $('#dados').empty();

            // Itera sobre os dados retornados e adiciona as linhas na tabela
            const representante = response; // Supondo que a resposta seja um único objeto
            const row = `
                <tr>
                    <td>${representante.nome_representante}</td>
                    <td>${representante.apelido_representante}</td>
                    <td>${representante.genero_representante}</td>
                    <td>${representante.id_nivel_contrantante}</td>
                </tr>
            `;
            $('#dados').append(row);

            // Abre o modal
            $('#modal-lista-faculdades').modal('show');
        },
        error: function () {
            alert('Erro ao carregar os representantes.');
        }
    });
}
    </script>
</body>