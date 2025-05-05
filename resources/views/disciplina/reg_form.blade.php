

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


   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-disciplina-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
            <div id="info">
            <h1 class="mt-4">Registar Disciplina/Módulo</h1>
            <div id="info">
                <h3></h3>
                <div id="feedback"></div>
                <form id="disciplina-reg" class="needs-validation">
                    @csrf
                    

                    <div class="row">
                        <div class="col">
                            <label class="input-label" for="floatingInput">Nome da Disciplina<span style="color:red">*</span></label>
                            
                            <input required="true" type="text" class="form-control" name="nome_disciplina" placeholder="Designação da Disciplina">
                              
                        </div>
                        <div class="col">
                            <label class="input-label" for="floatingInput">codigo da disciplina<span style="color:red">*</span></label>
                            <input required="true" type="text" class="form-control" name="codigo_disciplina" placeholder="codigo">
                           
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="input-label" for="floatingInput">Sigla<span style="color:red">*</span></label>
                            <input required="true" type="text" class="form-control" name="sigla" placeholder="Sigla">
                        </div>
                        <div class="col">
                            Categoria
                            
                                <select class="form-select" aria-label="Floating label select example" name="id_categoria">
                                    <option selected>Selecione...</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id_cat_disciplina}}">{{$categoria->designacao_categoria}}</option>
                                    @endforeach
                                </select>
                                
                           
                        </div>
                    </div>

                    <div class="row">
                    <div class="col">
                            Curso
                            
                                <select class="form-select" aria-label="Floating label select example" name="id_curso">
                                    <option selected>Selecione...</option>
                                    @foreach($cursos as $curso)
                                    <option value="{{$curso->id_curso}}">{{$curso->designacao_curso}}</option>
                                    @endforeach
                                </select>
                                
                           
                        </div>
                        <div class="col">
                            Ano
                            <select class="form-select" aria-label="Floating label select example" name="ano_curso">
                                    <option selected>Selecione...</option>
                                    
                                    <option value="1">I ano</option>
                                    <option value="2">II ano</option>
                                    <option value="3">III ano</option>
                                    <option value="4">IV ano</option>
                                   
                                </select>
                        </div>
                        <div class="col">
                            Semestre
                        <select class="form-select" aria-label="Floating label select example" name="semestre_curso">
                                    <option selected>Selecione...</option>
                                    
                                    <option value="1">I semestre</option>
                                    <option value="2">II semestre</option>
                                    
                                   
                                </select>
                        </div>
                        
                    </div>
                    <div class="row">
                    <div class="col">
                            Horas de contacto
                        <select class="form-select" aria-label="Floating label select example" name="horas_c">
                            <option selected>Selecione...</option>
                            <option value="6">6</option>
                            <option value="18">18</option>
                            <option value="25">25</option>
                            <option value="31">31</option>
                            <option value="38">38</option>
                            <option value="44">44</option>
                            <option value="50">50</option>
                            
                            
                            </select>
                    </div>
                    <div class="col">
                            <label>área cientifica</label>
                        <select class="form-select" aria-label="Floating label select example" name="cod_area">
                                    <option selected>Selecione...</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->cod_area}}">{{$area->designacao_area}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    

                    <div class="row" id="div-button">
                        <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" onclick="reg_disciplina(event)">Registar</button>
                    </div>
                </form>

            </div>

        </div>
</div>

</body>