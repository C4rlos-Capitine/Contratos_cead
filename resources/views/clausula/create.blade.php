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
    </script>
    @include('side2')

    <div id="page-content-wrapper">
        @include('nav')
        <!-- Page content-->
        <div class="container-fluid">
            <div id="info">
                <h1 class="mt-4">Registar Cláusula</h1>

                <div id="feedback"></div>
                <form id="clausula-reg">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>Ordem da Cláusula<span style="color:red">*</span></label>
                            <input required="true" type="number" class="form-control" name="ordem_clausula" placeholder="Ordem">
                        </div>
                        <div class="col">
                            <label>Título da Cláusula<span style="color:red">*</span></label>
                            <input required="true" type="text" class="form-control" name="titulo_clausula" placeholder="Título">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Subtítulo da Cláusula</label>
                            <input type="text" class="form-control" name="subtitulo_clausula" placeholder="Subtítulo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Descrição da Cláusula<span style="color:red">*</span></label>
                            <textarea required="true" class="form-control" name="descricao_clausula" rows="4" placeholder="Descrição"></textarea>
                        </div>
                    </div>
                </form>

                <div class="row" id="div-button">
                    <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" width="fit-content" onclick="reg_clausula()">Registar Cláusula</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function reg_clausula() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/clausulas/store', // Substitua pela URL correta
                data: $('#clausula-reg').serialize(),
                success: function (response) {
                    if (response.success) {
                        $('#feedback').html('<div class="alert alert-success">' + response.success + '</div>');
                        $('#clausula-reg')[0].reset(); // Reseta o formulário
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
                    $('#feedback').html('<div class="alert alert-danger">Ocorreu um erro ao registrar a cláusula.</div>');
                }
            });
        }
    </script>

</body>