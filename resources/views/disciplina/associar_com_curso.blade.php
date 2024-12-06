


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    @include('head2')
    <script>
        var script = document.createElement('script');
        var script2 = document.createElement('script');
        script.src = "javascript/funcoes2.js";
        document.head.appendChild(script);
    </script>
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
        document.getElementById('load-curso-disciplina-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Associar Disciplina à curso</label></div>
            <div id="info">

                <h3>Associar disciplina a Curso</h3>
                <style>
                    .row{
                        margin-top: 5px;
                        padding: 5px;
                        text-align: left;
                    }
                </style>
                <!--<div class="card">-->
                    <div id="feedback"></div>
                    <form id="associar" action="" method="post" novalidate>
                    @csrf
                        <div class="row">
                            <div class="col">
                                    <label class="input-label" for="floatingInput">Curso<span style="color:red">*</span></label>
                                    <input required="true" type="text" class="form-control" onkeyup="checkCurso(this)" id="curso" name="curso" placeholder="curso" autocomplete="off">
                
                                    <ul class="list"></ul>
                               
                            </div>
                            <div class="col">
                                    <label class="input-label" for="floatingInput">Disciplina<span style="color:red">*</span></label>
                                    <input required="true" type="text" class="form-control" id="disciplina" onkeyup="checkDisciplina(this)" name="disciplina" placeholder="disciplina" autocomplete="off">
                                    <ul class="list2"></ul>
                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
            
                                <label for="validationCustom04" class="form-label">Horas de Contacto</label>
                                <select id="horas_c" name="horas_c" class="form-select" id="validationCustom04" required>
                                    <option selected disabled value="">Escolha..</option>
                                    <option value="16">16</option>
                                    <option value="24">24</option>
                                    <option value="28">28</option>
                                    <option value="32">32</option>
                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">Ano</label>
                                <select id="ano" name="ano" class="form-select" id="validationCustom04" required>
                                    <option selected disabled value="">Escolha..</option>
                                    <option value="1">1 Ano</option>
                                    <option value="2">2 Ano</option>
                                    <option value="3">3 Ano</option>
                                    <option value="4">4 Ano</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">Semestre</label>
                                <select id="semestre" name="semestre" class="form-select" id="validationCustom04" required>
                                    <option selected disabled value="">Escolha..</option>
                                    <option value="1">1 Semestre</option>
                                    <option value="2">2 Semestre</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id_curso" id="id_curso">
                        <input type="hidden" name="codigo_disciplina" id="codigo_disciplina">
                    </form>

                    <div class="row" id="div-button">
                            <button id="submit" class="rounded bg-green-600 text-white px-2 py-1" onclick="validarForm()" >Associar disciplina</button>
                        </div>
            </div>
        </div>
    </main>
    @include('../footer')
</body>