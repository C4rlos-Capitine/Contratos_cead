


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
        document.getElementById('load-docente-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Home</label></div>
            <div id="info">


                <div id="docente-reg" class="row g-3 needs-validation">
                <h3>Dados pessoais</h3>
             
                <div class="col-md-6">

                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" id="floatingInput" name="nome" value="{{$docente->nome_docente}}" autocomplete="off" disabled>
                            <label class="input-label" for="floatingInput">Nome</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" id="floatingInput" name="apelido" value="{{$docente->apelido_docente}}"0 disabled>
                            <label class="input-label" for="floatingInput">Apelido</label>
                        </div>

                    </div>
                    <div class="col-md-6">
                    
                            <div class="form-floating mb-3">
                                <input required="true" type="text" class="form-control" name="bi" value="{{$docente->bi}}" disabled>
                                <label class="input-label" for="floatingInput">BI</label>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input required="true" type="text" class="form-control" id="floatingInput" name="nuit" value="{{$docente->nuit}}" disabled>
                                <label class="input-label" for="floatingInput">Nuit</label>
                            </div>
                         </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" id="floatingInput" name="nacionalidade" value="{{$docente->nacionalidade}}" disabled>
                            <label class="input-label" for="floatingInput">Nacionalidade</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input required="true" type="text" class="form-control" name="email"value="{{$docente->email}}" disabled>
                            <label class="input-label" for="floatingInput">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row" id="div-button">
                    <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" onclick="reg_docente(event)">editar</button>
                </div>
            </div>
        </div>
       
        </main>
        @include('../footer')
</body>