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
        flex-direction: row;
    }

   

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    #modal-lista-centros{
        z-index: -1000;
    }
</style>

<body class="antialiased">
    <script defer>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('load-centro-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        });

        function reg_centro() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/centro_recursos/save', // URL para salvar o centro de recursos
                data: $('#centro-reg').serialize(),
                success: function (response) {
                    if (response.success) {
                        $('#feedback').html('<div class="alert alert-success">' + response.success + '</div>');
                        $('#centro-reg')[0].reset(); // Reseta o formulário
                    } else if (response.errors) {
                        var errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each(response.errors, function (key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                        errorsHtml += '</ul></div>';
                        $('#feedback').html(errorsHtml);
                    }
                },
                error: function () {
                    $('#feedback').html('<div class="alert alert-danger">Ocorreu um erro ao registrar o centro de recursos.</div>');
                }
            });
        }

        function get_centros() {
            $.ajax({
                type: 'GET',
                url: '/centro_recursos/list', // URL para buscar os centros de recursos
                success: function (response) {
                    let tbody = document.getElementById('centros');
                    tbody.innerHTML = ''; // Limpa o conteúdo anterior

                    response.centros.forEach(function (centro) {
                        let row = `<tr>
                            <td>${centro.nome_centro}</td>
                        </tr>`;
                        tbody.innerHTML += row;
                    });

                    // Exibe o modal com a lista de centros
                    $('#modal-lista-centros').modal('show');
                },
                error: function () {
                    alert('Erro ao buscar os centros de recursos.');
                }
            });
        }
        function closeModal() {
            document.getElementById('modal-lista-centros').style.display = 'none';
        }
    </script>
    @include('side2')

    <div id="page-content-wrapper">
        @include('nav')
        <!-- Page content-->
        <div class="container-fluid">
            <div id="info">
                <h1 class="mt-4">Registar Centro de Recursos</h1>

                <div id="feedback"></div>
                <form id="centro-reg">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>Nome do Centro de Recursos<span style="color:red">*</span></label>
                            <input required="true" type="text" class="form-control" name="nome_centro" placeholder="Nome do Centro">
                        </div>
                    </div>
                </form>

                
                    <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" width="fit-content" onclick="reg_centro()">Registar Centro</button>
                    <button class="rounded bg-green-600 text-white px-2 py-1" id="view" width="fit-content" onclick="get_centros()">Ver Centros</button>
                
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-lista-centros">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Centros de Recursos</h2>
            <div id="modal-body">
                <!-- Centros serão carregados aqui -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody id="centros">
                        <!-- As linhas de dados serão inseridas aqui -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>