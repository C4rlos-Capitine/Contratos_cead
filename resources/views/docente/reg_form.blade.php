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
   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
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

@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
      
            <div id="info">
            <h1 class="mt-4">Registar Tutor/Docente</h1>
            <div id="feedback"></div>
            <form id="docente-reg" class="needs-validation">
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label class="input-label" for="nome">Nome:<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="nome" placeholder="nome" autocomplete="off">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="input-label" for="apelido">Apelido:<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="apelido" placeholder="apelido" autocomplete="off">
                <small id="emailHelp" class="form-text text-muted">50 caracteres no máximo</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label class="input-label" for="bi">BI:<span style="color:red">*</span></label>
                <input required id="bi" type="text" class="form-control" name="bi" placeholder="bi" autocomplete="off">
                <small id="bi_msg_req" class="form-text text-muted">13 caracteres</small>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="input-label" for="nuit">Nuit:<span style="color:red">*</span></label>
                <input required id="nuit" type="text" class="form-control" name="nuit" placeholder="nuit" autocomplete="off">
                <small id="nuit_msg_req" class="form-text text-muted">8 caracteres</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label class="input-label" for="nacionalidade">Nacionalidade:<span style="color:red">*</span></label>
            <input required type="text" class="form-control" name="nacionalidade" placeholder="nacionalidade">
        </div>
        <div class="col">
            <label class="input-label" for="email">Email:<span style="color:red">*</span></label>
            <input required type="text" class="form-control" name="email" placeholder="email">
            <small id="emailHelp" class="form-text text-muted">deve conter "@"</small>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label class="input-label" for="data_nascimento">Data de Nascimento:</label>
            <input type="date" class="form-control" name="data_nascimento" placeholder="Data de nascimento">
        </div>
        <div class="col">
            <label class="input-label" for="ano_comeco_carreira">Ano de Começo de Carreira:</label>
            <input type="number" class="form-control" name="ano_comeco_carreira" placeholder="Ano de começo de carreira" min="1900" max="{{ date('Y') }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="nivel" class="form-label">Nivel:<span style="color:red">*</span></label>
            <select id="nivel" name="nivel" class="form-select" required>
                <option selected disabled value="">Escolha..</option>
                @foreach($niveis as $nivel)
                    <option value="{{$nivel->id_nivel}}">{{$nivel->designacao_nivel}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="faculdade" class="form-label">Faculdade</label>
            <select id="faculdade" name="faculdade" class="form-select" required>
                <option selected disabled value="">Escolha..</option>
                @foreach($faculdades as $faculdade)
                    <option value="{{$faculdade->id_faculdade}}">{{$faculdade->nome_faculdade}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            Gênero:<br>
            Masculino: <input type="radio" value="masculino" name="genero"><br>
            Feminino: <input type="radio" value="femenino" name="genero">
        </div>
    </div>
    <div class="row" id="div-button">
        <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" onclick="reg_docente(event)">Registar</button>
    </div>
</form>
        </div>
    
    </div>
            <!-- Modal Bootstrap -->
    <div class="modal fade bd-example-modal-lg" id="modal-lista" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <div id="feedback2"></div>
                        <div class="col-md-3">
                            
                        <label class="input-label" for="floatingInput">Ano do contrato</label>
                        <input required="true" id="ano_contrato" type="number" name="ano_contrato" min="1900" max="2100" step="1" class="form-control">
                        </div>
                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>Disciplina</th>
              
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="docentes-table">
                            <!-- As linhas de dados serão inseridas aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
