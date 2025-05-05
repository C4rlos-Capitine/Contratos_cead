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
    }
</style>

<body class="antialiased">

    <script defer>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('load-clausula-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        });

        // Função para carregar os dados da cláusula
        function loadClausula(id) {
            $.ajax({
                type: 'GET',
                url: `/clausulas/${id}`, // Substitua pela URL correta
                success: function (response) {
                    // Preenche os campos com os dados retornados
                    document.querySelector('input[name="ordem_clausula"]').value = response.ordem_clausula;
                    document.querySelector('input[name="titulo_clausula"]').value = response.titulo_clausula;
                    document.querySelector('input[name="subtitulo_clausula"]').value = response.subtitulo_clausula;
                    document.querySelector('textarea[name="descricao_clausula"]').value = response.descricao_clausula;
                },
                error: function () {
                    $('#feedback').html('<div class="alert alert-danger">Erro ao carregar os dados da cláusula.</div>');
                }
            });
        }
    </script>
    @include('side2')

    <div id="page-content-wrapper">
        @include('nav')
        <!-- Page content-->
        <div class="container-fluid">
            <div id="info">
                <h1 class="mt-4">Detalhes da Cláusula</h1>

                <div id="feedback"></div>
                <form id="clausula-view">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>Ordem da Cláusula</label>
                            <input readonly type="number" class="form-control" value="{{ $clausula->ordem_clausula }}" placeholder="Ordem">
                        </div>
                        <div class="col">
                            <label>Título da Cláusula</label>
                            <input readonly type="text" class="form-control" value="{{ $clausula->titulo_clausula }}" placeholder="Título">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Subtítulo da Cláusula</label>
                            <input readonly type="text" class="form-control" value="{{ $clausula->subtitulo_clausula }}" placeholder="Subtítulo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Descrição da Cláusula</label>
                            <textarea readonly class="form-control" rows="4" placeholder="Descrição">{{ $clausula->descricao_clausula }}</textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>