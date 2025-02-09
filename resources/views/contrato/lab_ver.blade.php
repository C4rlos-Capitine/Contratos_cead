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
   @include('header2')
   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-contrato-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    $(document).ready(function(){
                    new DataTable('#example');
                })
    </script>

<main class="main-section">
<body>
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Home</label></div>
        <div id="info">


            <script>
                $(document).ready(function(){
                    new DataTable('#example');
                })
            
            </script>

            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">escreva o ano</span>
                <input type="number" class="form-control" id="ano_contrato" name="ano_contrato" min="1900" max="2100"aria-describedby="inputGroupPrepend" placeholder="Escreva o ano dos contratos que pretende gerar" required>
                <div class="invalid-feedback">
                Ano invávido
                </div>
                <button class="rounded bg-green-600 text-white px-2 py-1" onclick="get_contratosLab()">Buscar</button>
          </div>
            <table id="example" class="table table-striped" style="width:100%;">
                <thead><tr><th>Técnico</th>
                                <th>Curso</th>
                                <th>Nome da Disciplina</th>
                                <th></th>
                                </tr></thead>
                <tbody id='tecnicos'>

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
                </div>
            </div>
        </div>
    </div>


        </main>
        @include('../footer')
    </body>
</html>