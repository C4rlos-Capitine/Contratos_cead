
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
   <script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-docente-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

@include('side2')
        
<div id="page-content-wrapper">
    @include('nav')
        <!-- Page content-->
    <div class="container-fluid">
                <script>
                    $(document).ready(function(){
                        new DataTable('#example');
                    })
                
                </script>
                </head>
                <body>
                    <p>Docente: {{$docente->nome_docente}}</p>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead><tr><th>designação</th><th>sigla</th><th>ano</th><th>semestre</th><th>Carga Horaria</th><th>ano do contrato</th></tr></thead>
                    <tbody>
                    @foreach($disciplinas as $disciplina)
                        <tr>
                            <td>{{$disciplina->nome_disciplina}}</td>
                            <td>{{$disciplina->codigo_disciplina}}</td>
                            <td>{{$disciplina->ano}}</td>
                            <td>{{$disciplina->semestre}}</td>
                            <td>{{$disciplina->horas_contacto}}</td>
                            <td>{{$disciplina->ano_contrato}}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="col-md-3">
                <button id="{{$docente->id_docente}}" type="submit" width="fit-content"  onclick="pdf(this.id, '{{$disciplina->ano_contrato}}')" class="rounded bg-green-600 text-white px-2 py-1">ver contrato</button>
            </div>
            </div>
        </div>
          
        
                </div>
                </div>
    <script>
         function pdf(id, ano){
             window.location.href = "/contrato/"+id+"/"+ano;
        }
    </script>
</body>