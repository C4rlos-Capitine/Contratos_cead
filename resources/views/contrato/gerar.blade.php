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

   <script defer>
    $(document).ready(function(){
                    new DataTable('#example');
                })
    </script>

@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
      
            <div id="info">

                <p>gerar contratos</p>
            <script>
                $(document).ready(function(){
                    new DataTable('#example');
                })
            function get_docentesAlocados_ano(){
    //ano_contrato
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: '/contrato/docentes_alocados',
        data: { ano: document.getElementById('ano_contrato').value }, // Passa o id_docente aqui
        success: function (response) {
            console.log(response);
            console.log(response);
            const tbody = $('#docentes_alocados');
            tbody.empty(); // Clear the table before filling
           // $('#list_docentes_title').text(`Lista de áreas ${id_docente}`);

            // Iterate over the data and create table rows
            response.docentes.forEach(docente => {
                const row = $('<tr></tr>');
                row.append($('<td></td>').text(docente.nome_docente));
                const buttonHtml = `<button class="rounded bg-green-600 text-white px-2 py-1" id="'${docente.id_docente}'" onclick="disciplinas_docente('${docente.id_docente}')">Ver Disciplinas</button>`;
                row.append($('<td></td>').html(buttonHtml));
                const buttonHtml2 = `<button class="rounded bg-green-600 text-white px-2 py-1" id="'${docente.id_docente}'" onclick="gerar('${docente.id_docente}')">Gerar</button>`;
                row.append($('<td></td>').html(buttonHtml2));
                tbody.append(row);
            });
           // $('#modal-lista').modal('show');
        },
        error: function () {
            alert("error");
        }
    });
}
            </script>

            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">escreva o ano</span>
                <input type="number" class="form-control" id="ano_contrato" name="ano_contrato" min="1900" max="2100"aria-describedby="inputGroupPrepend" placeholder="Escreva o ano dos contratos que pretende gerar" required>
                <div class="invalid-feedback">
                Ano invávido
                </div>
                <button class="rounded bg-green-600 text-white px-2 py-1" onclick="get_docentesAlocados_ano()">Buscar</button>
          </div>
            <table id="example" class="table table-hover" style="width:100%;">
                <thead><tr><th>Docente</th><th>ver disciplinas</th><th></th></tr></thead>
                <tbody id='docentes_alocados'>

                </tbody>
            </table>
        
            </div>
            </div>


            <!-- bootstrap modal-->
            <div class="modal fade bd-example-modal-lg" id="modal-lista-disciplinas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            
                        <label class="input-label" for="floatingInput">Disciplinas alocadas</label>
                    <!--<input required="true" id="ano_contrato" type="number" name="ano_contrato" min="1900" max="2100" step="1" class="form-control">-->
                        </div>
                        <thead>
                            <tr>
                                <th>Nome da Disciplina</th>
                                <th>Curso</th>

                            </tr>
                        </thead>
                        <tbody id="disciplinas">
                            <!-- As linhas de dados serão inseridas aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>