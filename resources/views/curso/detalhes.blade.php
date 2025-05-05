

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
        document.getElementById('load-curso-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
            <div id="info">
            <h1 class="mt-4">Detalhes do curso de: {{$cursos->designacao_curso}}a</h1>

        <div id="feedback"></div>
        <form id="curso-reg">
            @csrf
                <div class="row">
                    <div class="col">
                        <label>Designação curso<span style="color:red">*</span></label>
                        <input required="true" type="text" class="form-control" name="designacao_curso" value="{{$cursos->designacao_curso}}" placeholder="Designação">
                    </div>
                    <div class="col">
                        <label>Sigla</label>
                        <input required="true" id="sigla" type="text" class="form-control" value="{{$cursos->sigla}}" name="sigla" placeholder="sigla">
                    </div>
                </div>
                <div class="row">
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Faculdade</label>
                    <select id="faculdade" name="faculdade" class="form-select" id="validationCustom04">
                       <option selected>{{$cursos->nome_faculdade}}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Director do Curso</label>
                    <select id="dir_curso" name="dir_curso" class="form-select" id="validationCustom04">
                        
                        @foreach($docentes as $d)
                        <option value="{{$d->id_docente }}">{{$d->nome_docente}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                <label for="validationCustom04" class="form-label">Director do Curso</label>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Actual Director</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="{{$docente->nome_docente}}" disabled>
                </div>
</div>
            </div>
            <input type="hidden" name="designacao_curso" id="designacao_curso" value="{{$cursos->designacao_curso}}"/>
            <input type="hidden" name="id_curso" id="id_curso" value="{{$cursos->id_curso}}"/>
                </form>
 
        <div class="row" id="div-button">
                <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" width="fit-content" onclick="update_docente()">Editar</button>
        </div>

            
        </div>
</div>

</body>