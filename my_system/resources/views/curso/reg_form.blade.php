
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
        document.getElementById('load-curso-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });

    function buscar_docentes(){
        
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        
        console.log("ola");
        //event.preventDefault(); // Prevent the form from being submitted traditionally

        console.log("ola");
        $.ajax({
            type: 'GET',
            url: "/cead_template2/faculdade/docentes",
            data: {faculdade: document.getElementById('faculdade').value },
            success: function (data) {
                console.log(data.docentes);
                var select = $("#dir_curso"); // Replace with the actual ID of your select element
                docente = data.docentes;
                //docentes[] = data.docentes;
                //var html_dir_curso = "<option disabled></option>";
                var option1 = $("<option>");
                option1.text();
                //option1.prop("disabled", true); 
                select.append(option1);
                for (var i = 0; i < docente.length; i++) {
                    var option = $("<option>");
                    console.log(docente)
                    option.val(docente[i].id_docente);
                    option.text(docente[i].nome_docente);
                    select.append(option);

                }

                
            },
            error: function () {
                alert("error");
            }
        });
    }
    </script>
<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Registar curso</label></div>
        <div id="info">

           


        <div id="feedback"></div>
            <form id="curso-reg">
            @csrf
                <div class="row">
                    <div class="col">
                        <label>Designação curso<span style="color:red">*</span></label>
                        <input required="true" type="text" class="form-control" name="designacao_curso" placeholder="Designação">
                    </div>
                    <div class="col">
                        <label>Sigla<span style="color:red">*</span></label>
                        <input required="true" type="text" class="form-control" name="sigla" placeholder="sigla">
                    </div>
                </div>
                <div class="row">
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Faculdade<span style="color:red">*</span></label>
                    <select id="faculdade" name="faculdade" class="form-select" id="validationCustom04" onchange="buscar_docentes()" required>
                        <option selected disabled value="">Escolha..</option>   
                        @foreach($faculdades as $faculdade)
                            <option value="{{$faculdade->id_faculdade}}">{{$faculdade->nome_faculdade}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Director do Curso<span style="color:red">*</span></label>
                    <select id="dir_curso" name="dir_curso" class="form-select" id="validationCustom04">
                        
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Centro de Recursos<span style="color:red">*</span></label>
                    <select id="centro" name="centro" class="form-select"required>
                        <option selected disabled>Escolha..</option>   
                        @foreach($centros as $centro)
                            <option value="{{$centro->id_centro}}">{{$centro->nome_centro}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                
                </form>
 
        <div class="row" id="div-button">
                <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" width="fit-content" onclick="reg_curso()">Registar curso</button>
        </div>
    </div>
</main>
@include('../footer')
</body>
