

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
    .row {
        margin-top: 5px;
        padding: 5px;
        text-align: left;
    }
    </style>

<body class="antialiased">
   @include('header2')

   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-faculdade-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>
<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Registar Faculdade</label></div>
        <div id="info">

                <div id="feedback"></div>
                <form id="faculdade-reg">
                @csrf
                
              

                <form>
                <div class="row">
                    <div class="col">
                    <label class="input-label">Designação:<span style="color:red">*</span></label>
                        <input type="text" name="nome_faculdade" class="form-control" placeholder="Designação">
                    </div>
                    <div class="col">
                    <label class="input-label">sigla:<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="sigla_faculdade" placeholder="sigla">
                    </div>
                </div>
                </form>

            </form>
            <div class="row">
                <div style="padding:20px" class="row" id="div-button"><button class="rounded bg-green-600 text-white px-2 py-1" id="submit" width="fit-content" onclick="reg_faculdade()">Registar</button> </div>
                <div style="padding:20px" class="row" id="div-button"><button class="rounded bg-green-600 text-white px-2 py-1" id="submit" width="fit-content" onclick="get_faculdades()">Ver</button></div>
            </div>   
</div>
</div>





</main>

<!-- bootstrap modal-->
<div class="modal fade bd-example-modal-lg" id="modal-lista-faculdades" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            
                        <label class="input-label" for="floatingInput">Faculdades</label>
                        </div>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Sigla</th>
                            </tr>
                        </thead>
                        <tbody id="faculdades">
                            <!-- As linhas de dados serão inseridas aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@include('../footer')
</body>
</html>


