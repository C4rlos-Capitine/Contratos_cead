
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
    .modal{
            margin-top:200px;
            padding: 30px;
        }
    .modal-content{
        padding: 30px;
    }
    </style>

<body class="antialiased">

   
   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-curso-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
            <div id="info">
            <h1 class="mt-4">Disciplinas</h1>
       
                <script>
                    $(document).ready(function(){
                        new DataTable('#example');
                    });

                    function alocar_disciplina(codigo, nome, curso) {
                        console.log(`Código: ${codigo}`);
                        console.log(`Nome: ${nome}`);
                        console.log(`Curso: ${curso}`);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'GET',
                            url: '/docente/ml_call2',
                            data: { codigo_disciplina: codigo },
                            success: function (response) {
                                console.log(response);
                                const tbody = $('#docentes-table');
                                tbody.empty(); // Clear the table before filling
                                $('#list_docentes_title').text(`Lista de Prováveis Docentes para ${nome}`);

                                // Iterate over the data and create table rows
                                response.docentes.forEach(docente => {
                                    const row = $('<tr></tr>');
                                    row.append($('<td></td>').text(docente.id));
                                    row.append($('<td></td>').text(docente.nome));
                                    row.append($('<td></td>').text(docente.apelido));

                                    // Properly embed variables in button HTML using template literals
                                    const buttonHtml = `<button onclick="add_disciplina_to_docente(${docente.id}, '${codigo}', '${curso}')">Alocar</button>`;
                                    row.append($('<td></td>').html(buttonHtml));
                                    
                                    tbody.append(row);
                                });

                                // Show the modal
                                $('#modal-lista').modal('show');
                            },
                            error: function () {
                                alert("error");
                            }
                        });
                    }

                </script>
                </head>
            
                    
                    <p>curso: {{$curso->designacao_curso}}</p>
                <table id="example" class="table table-hover" style="width:100%">
                    <thead><tr><th>designação</th><th>sigla</th><th>ano</th><th>semestre</th><th>horas de contacto</th><th></th><th></th></tr></thead>
                    <tbody>
                    @foreach($disciplinas as $disciplina)
                        <tr>
                            <td>{{$disciplina->nome_disciplina}}</td>
                            <td>{{$disciplina->codigo_disciplina}}</td>
                            <td>{{$disciplina->ano}}</td>
                            <td>{{$disciplina->semestre}}</td>
                            <td>{{$disciplina->horas_contacto}}</td>
                            <td><button id="{{$disciplina->codigo_disciplina}}" class="rounded bg-green-600 text-white px-2 py-1" onclick="alocar_disciplina('{{ htmlspecialchars($disciplina->codigo_disciplina, ENT_QUOTES, 'UTF-8') }}', '{{ htmlspecialchars($disciplina->nome_disciplina, ENT_QUOTES, 'UTF-8') }}', '{{ htmlspecialchars($disciplina->id_curso, ENT_QUOTES, 'UTF-8') }}')">Alocar a contrato</button></td>
                            <td><i class="fa-solid fa-trash action"></i>
                                <a href="/disciplina/{{$disciplina->codigo_disciplina}}/edit"><i class="fa-solid fa-pen-to-square action" data-id="{{$disciplina->codigo_disciplina}}"></i></a>
                                <i class="fa-solid fa-eye action" data-id="{{ $disciplina->codigo_disciplina }}" onclick="detalhesDisciplina(this)"></i></td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Bootstrap -->
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
                    <div id="feedback"></div>
                        <div class="col-md-3">
                            
                        <label class="input-label" for="floatingInput">Ano do contrato</label>
                        <input required="true" id="ano_contrato" type="number" name="ano_contrato" min="1900" max="2100" step="1" class="form-control">
                        </div>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Apelido</th>
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
                </div>

                <div class="modal fade" id="modal-detalhes-disciplina" tabindex="-1" role="dialog" aria-labelledby="modalDetalhesDisciplina" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalhes da Disciplina</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detalhes-feedback"></div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Código</th>
                            <td id="detalhes-codigo"></td>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <td id="detalhes-nome"></td>
                        </tr>
                        <tr>
                            <th>Sigla</th>
                            <td id="detalhes-sigla"></td>
                        </tr>
                        <tr>
                            <th>Ano</th>
                            <td id="detalhes-ano"></td>
                        </tr>
                        <tr>
                            <th>Semestre</th>
                            <td id="detalhes-semestre"></td>
                        </tr>
                        <tr>
                            <th>Horas de Contacto</th>
                            <td id="detalhes-horas"></td>
                        </tr>
                        <tr>
                            <th>Categoria</th>
                            <td id="detalhes-categoria"></td>
                        </tr>
                        <tr>
                            <th>Curso</th>
                            <td id="detalhes-curso"></td>
                        </tr>
                        <tr>
                            <th>Área Científica</th>
                            <td id="detalhes-area"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function detalhesDisciplina(element) {
    const codigoDisciplina = $(element).data('id'); // Obtém o código da disciplina do botão

    $.ajax({
        type: 'GET',
        url: `/disciplina/find/${codigoDisciplina}`, // Rota para buscar os detalhes da disciplina
        success: function (response) {
            const disciplina = response.response;

            // Preenche os campos do modal com os dados da disciplina
            $('#detalhes-codigo').text(disciplina.codigo_disciplina);
            $('#detalhes-nome').text(disciplina.nome_disciplina);
            $('#detalhes-sigla').text(disciplina.sigla_disciplina);
            $('#detalhes-ano').text(disciplina.ano);
            $('#detalhes-semestre').text(disciplina.semestre);
            $('#detalhes-horas').text(disciplina.horas_contacto);
            $('#detalhes-categoria').text(disciplina.designacao_categoria);
            $('#detalhes-curso').text(disciplina.designacao_curso);
            $('#detalhes-area').text(disciplina.designacao_area);

            // Exibe o modal
            $('#modal-detalhes-disciplina').modal('show');
        },
        error: function () {
            $('#detalhes-feedback').html('<div class="alert alert-danger">Erro ao buscar os detalhes da disciplina.</div>');
        }
    });
}
</script>

</body>