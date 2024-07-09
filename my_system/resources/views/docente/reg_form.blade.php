<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
        document.getElementById('load-docente-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        var bi;
        var nuit;
        console.log('validacao.js');

        bi = document.getElementById('bi');
        
        bi.addEventListener('keyup', function(event) {
            
            //var typedText = event.target.value;
            //console.log("Typed text:", typedText);
            response = verificar(event.target);
            console.log(response);
            console.log(response.color);
            document.getElementById('bi_msg_req').textContent = response.msg;
            document.getElementById('bi_msg_req').style.color = response.color;
        });
        nuit = document.getElementById('nuit');

        nuit.addEventListener('keyup', function(event) {
            response = verificar_nuit(event.target);
            console.log(response);
            console.log(response.color);
            document.getElementById('nuit_msg_req').textContent = response.msg;
            document.getElementById('nuit_msg_req').style.color = response.color;
        });
        
    });
    </script>

<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Registar Docente</label></div>
        <div id="info">
            <div id="feedback"></div>
            <form id="docente-reg" class="needs-validation">
            @csrf
             
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label class="input-label" for="floatingInput">Nome:<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="nome" placeholder="nome" autocomplete="off">
                            </div>
                        </div>
                    
                        <div class="col">
                            <div class="form-group">
                            <label class="input-label" for="floatingInput">Apelido:<span style="color:red">*</span></label>
                            <input  type="text" class="form-control" name="apelido" placeholder="apelido" autocomplete="off">
                            <small id="emailHelp" class="form-text text-muted">50 caracteres no maximo</smal>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="input-label" for="floatingInput">BI:<span style="color:red">*</span></label>
                                <input required="true" id="bi" type="text" class="form-control" name="bi" placeholder="bi" autocomplete="off">
                                <small id="bi_msg_req" class="form-text text-muted">13 caracteres</small>
                            </div>
                        </div>
                   
                  
                        <div class="col">
                            <div class="form-group">
                                <label class="input-label" for="floatingInput">Nuit:<span style="color:red">*</span></label>
                                <input required="true" id="nuit" type="text" class="form-control" name="nuit" placeholder="nuit" autocomplete="off">
                                <small id="nuit_msg_req" class="form-text text-muted">8 caracteres</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="input-label" for="floatingInput">Nacionalidade:<span style="color:red">*</span></label>
                            <input required="true" type="text" class="form-control" name="nacionalidade" placeholder="nacionalidade">
                            
                        </div>
                    
                        <div class="col">
                            <label class="input-label" for="floatingInput">Email:<span style="color:red">*</span></label>
                            <input required="true" type="text" class="form-control" name="email" placeholder="email">
                            <small id="emailHelp" class="form-text text-muted">deve conter &quot;@&quot;</smal>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Nivel:<span style="color:red">*</span></label>
                        <select id="nivel" name="nivel" class="form-select" required>
                            <option selected disabled value="">Escolha..</option>
                            @foreach($niveis as $nivel)
                                <option value="{{$nivel->id_nivel}}">{{$nivel->designacao_nivel}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Faculdade</label>
                        <select id="faculdade" name="faculdade" class="form-select" required>
                            <option selected disabled value="">Escolha..</option>
                            @foreach($faculdades as $faculdade)
                                <option value="{{$faculdade->id_faculdade}}">{{$faculdade->nome_faculdade}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                Genero:
                <br>
                Masculino:<input type="radio" value="masculino" name="genero"><br>
                Femenino:
                <input  type="radio" value="femenino" name="genero">
                <div class="row" id="div-button">
                    <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" onclick="reg_docente(event)">Registar</button>
                </div>
            </form>
        </div>
    
    </div>
    </main>
    @include('../footer')
</body>
