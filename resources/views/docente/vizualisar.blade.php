

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

        /* Estilização do dropdown */
        .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
      border-radius: 4px;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown i {
      cursor: pointer;
      font-size: 20px;
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
                        
            <script>
                $(document).ready(function(){
                    new DataTable('#example');
                })
            
            </script>

            <body>
            <div class="popup" width="80%">
                <span class="close-btn">&times;</span>
                <div class="popup-body"></div>
            </div>
                <main class="main">
            <table id="example" class="table table-striped" style="width:100%">
                <thead><tr><th>Nome Completo</th><th>Nivel</th><th>genero</th><th></th></tr></thead>
                <tbody>
                @foreach($docentes as $docente)
                    <tr>
                        <td>{{$docente->nome_docente}}-{{$docente->apelido_docente}}</td>
                        <td>{{$docente->designacao_nivel}}</td>
                        <td>{{$docente->genero}}</td>
                        <!--<td><button id="{{$docente->id_docente}}" width="fit-content" class="rounded bg-green-600 text-white px-2 py-1" onclick="loadDisciplinasAlocadas(this.id)">ver disciplinas</button></td>-->
                        <td>
                            <div class="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                                <div class="dropdown-content">
                                    <a href="/docente/find/{{$docente->id_docente}}">Ver Informações</a>
                                    <a href="#link2">Editar</a>
                                    <a href="#">Associar Áreas Cientificas</a>
                                    <a href="#" onclick="loadDisciplinasAlocadas(this.id)">Disciplinas</a>
                                </div>
                            </div>
                        </td>
<!--<td><button id="{{$docente->id_docente}}" width="fit-content" class="rounded bg-green-600 text-white px-2 py-1" onclick="loadDisciplinasAlocadas(this.id)"><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i>Mais..</button></td>-->
                    </tr>
                @endforeach
            </tbody>
            </table>
            </main>
           
            </div>
        </div>
    </main>
    @include('../footer')
    <script>
            //document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".close-btn").addEventListener("click", function(){
        document.body.classList.remove("active-popup");
        
      });
  
      function loadDisciplinasAlocadas(id){
        console.log(id);
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
          url: '/docente/get_disciplinas',
          data: { id_docente: id },
          success: function (data) {
            console.log(data.response);
            var html = "";
            if(data.response.length>0){
                html = '<table id="tb-data" class="table table-striped"><tr><th>curso</th><th>modulo</th><th>ano</th></tr>';
                    
                data.response.forEach(function (item) {
                html += '<tr><td scope="col">' + item.designacao_curso + '</td><td scope="col">' + item.nome_disciplina + '</td><td scope="col">' + item.ano_contrato + '</td></tr>';
                });
                html += '</table>';
            }else{
                html = "Nenhuma disciplina alocada até agora!!";
            }
            document.querySelector(".popup-body").innerHTML = html;
            document.body.classList.add("active-popup");
          },
          
          error: function () {
            alert("error");
          }
        });
         

      }
//});    
    </script>
</body>
