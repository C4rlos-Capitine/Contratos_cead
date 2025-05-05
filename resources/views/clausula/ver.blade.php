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
                <h1 class="mt-4">Cláusula do Contrato</h1>
    </br>
                <a class="rounded bg-green-600 text-white px-2 py-1 new-reg" href="/clausulas/create">Nova Clausula<i class="fa-solid fa-plus action-secondary"></i></a>  
    
                <div id="feedback"></div>
                </br>
                <table id="example" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Ordem</th>
                            <th>Título</th>
                            <th>Subtítulo</th>
                            <th>Texto</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="clausula-table-body">
                        @foreach($clausulas as $clausula)
                        <tr id="clausula-{{ $clausula->id }}">
                            <td>{{ $clausula->ordem_clausula }}</td>
                            <td>{{ $clausula->titulo_clausula }}</td>
                            <td>{{ $clausula->subtitulo_clausula }}</td>
                            <td>{{ $clausula->texto_clausula }}</td>
                            <td>
                                <i class="fa-solid fa-trash action"></i>
                                <i class="fa-solid fa-pen-to-square action" data-id="{{ $clausula->id_clausula }}" onclick="editClausula(this)"></i>
                                <i class="fa-solid fa-eye action" data-id="{{ $clausula->id_clausula }}" onclick="detalhesClausula(this)"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Botão para abrir o modal -->


                <!-- Modal -->
                <div class="modal fade" id="clausulaModal" tabindex="-1" aria-labelledby="clausulaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="clausulaModalLabel">Registar Cláusula</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="clausula-reg">
                                @csrf
                                <input type="hidden" name="id_clausula"> <!-- Campo oculto para o ID da cláusula -->
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
                                <input type="hidden" name="id_clausula" value=""> <!-- Campo oculto para o ID do contrato -->
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" onclick="updateClausula()">Salvar Alterações</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fim do Modal -->
            </div>
        </div>
    </div>
    <script>
        function editClausula(element) {
        const clausulaId = element.getAttribute('data-id'); // Obtém o ID da cláusula do atributo data-id

        // Faz a requisição AJAX para buscar os dados da cláusula
        $.ajax({
            type: 'GET',
            url: `/clausulas/${clausulaId}`,
            dataType: 'json', // <- força o jQuery a tratar como JSON
            success: function (response) {
                console.log(response);
                document.querySelector('input[name="id_clausula"]').value = response.id_clausula;
                document.querySelector('input[name="ordem_clausula"]').value = response.ordem_clausula;
                document.querySelector('input[name="titulo_clausula"]').value = response.titulo_clausula;
                document.querySelector('input[name="subtitulo_clausula"]').value = response.subtitulo_clausula;
                document.querySelector('textarea[name="descricao_clausula"]').value = response.descricao_clausula;

                const modal = new bootstrap.Modal(document.getElementById('clausulaModal'));
                modal.show();
            },
            error: function () {
                alert('Erro ao buscar os dados da cláusula.');
            }
        });

    }

    function updateClausula() {
        // Obtém o ID da cláusula do campo oculto no formulário
        const clausulaId = document.querySelector('input[name="id_clausula"]').value;

        // Serializa os dados do formulário
        const formData = $('#clausula-reg').serialize();
        $.ajax({
            type: 'POST', // Método HTTP PUT
            url: `/clausulas/update/${clausulaId}`, // URL com o ID da cláusula
            data: formData, // Dados do formulário
            success: function (response) {
                if (response.success) {
                    // Exibe mensagem de sucesso
                    alert(response.success);

                    // Atualiza a tabela ou fecha o modal
                    $('#clausulaModal').modal('hide');
                    location.reload(); // Recarrega a página para refletir as alterações
                } else {
                    alert('Erro ao atualizar a cláusula.');
                }
            },
            error: function (xhr) {
                // Exibe erros de validação ou outros erros
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = Object.values(errors).map(error => error.join(', ')).join('\n');
                    alert('Erro(s):\n' + errorMessages);
                } else {
                    alert('Erro ao atualizar a cláusula.');
                }
            }
        });
    }

    function detalhesClausula(element){
        window.location.href = "/clausulas/detalhes/"+element.getAttribute('data-id');
    }
    </script>

</body>