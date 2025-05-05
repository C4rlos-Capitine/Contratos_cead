

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
        document.getElementById('load-area-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>
@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
            <div id="info">
            <h1 class="mt-4">Registar Area Cientifica</h1>
            <div id="info">
                <h3></h3>
                <div id="feedback"></div>
                <form id="area-reg" class="needs-validation">
                    @csrf
                    

                    <div class="row">
                        <div class="col">
                            <label class="input-label" for="floatingInput">Designação da Area<span style="color:red">*</span></label>
                            
                            <input required="true" type="text" class="form-control" name="cod_area" placeholder="Designação da Disciplina">
                              
                        </div>
                        <div class="col">
                            <label class="input-label" for="floatingInput">Nome da Area<span style="color:red">*</span></label>
                            <input required="true" type="text" class="form-control" name="nome_area" placeholder="codigo">
                           
                        </div>
                    </div>

                    
                    <div class="row" id="div-button">
                        <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" onclick="reg_area(event)">Registar</button>
                    </div>
                </form>

            </div>

        </div>
</div>
</div>
</div>
</body>