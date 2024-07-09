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
        document.getElementById('load-representante-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>
<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Home</label></div>
        <div id="info">
            <div id="feedback"></div>
            <form id="docente-reg" class="needs-validation">
            @csrf
                <h3>Registar Representante/h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" name="nome" placeholder="nome" autocomplete="off">
                            <label class="input-label" for="floatingInput">Nome</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" name="apelido" placeholder="apelido" autocomplete="off">
                            <label class="input-label" for="floatingInput">Apelido</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" name="bi" placeholder="bi" autocomplete="off">
                            <label class="input-label" for="floatingInput">BI</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" name="nuit" placeholder="nuit" autocomplete="off">
                            <label class="input-label" for="floatingInput">Nuit</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" name="nacionalidade" placeholder="nacionalidade">
                            <label class="input-label" for="floatingInput">Nacionalidade</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" name="email" placeholder="email">
                            <label class="input-label" for="floatingInput">Email</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Nivel</label>
                        <select id="nivel" name="nivel" class="form-select" required>
                            <option selected disabled value="">Escolha..</option>
                            
                    </div>
                    
                </div>
                Genero:
                <br>
                Masculino:<input required="true" type="radio"name="masculino"><br>
                Femenino:
                <input required="true" type="radio"  name="femenino">
                <div class="row" id="div-button">
                    <button class="rounded bg-green-600 text-white px-2 py-1" id="submit">Registar</button>
                </div>
            </form>
        </div>

    </div>
    </main>
    @include('../footer')
</body>
