

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
        document.getElementById('load-curso-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

@include('side2')
        
        <div id="page-content-wrapper">
            @include('nav')
                <!-- Page content-->
            <div class="container-fluid">
            <div id="info">
            <h1 class="mt-4">Cursos</h1>
</br>
                <a href="/curso/reg" style="margin-right:0" class="rounded bg-green-600 text-white px-2 py-1">Novo curso</a>
            <script>
                $(document).ready(function(){
                    new DataTable('#example');
                })
            
            </script>
    
            <table id="example" class="table table-hover" style="width:100%">
                <thead><tr><th>Designação do curso</th><th>Faculdade</th><th>Sigla</th><th>Centro</th><th></th><th></th></tr></thead>
                <tbody>
                @foreach($cursos as $curso)
                    <tr>
                        <td>{{$curso->designacao_curso}}</td>
                        <td>{{$curso->sigla_faculdade}}</td>
                        <td>{{$curso->sigla_curso}}</td>
                        <td>{{$curso->nome_centro}}</td>
                        <td><a id="{{$curso->id_curso}}" width="fit-content" href="/disciplina/vizualisar/{{$curso->id_curso}}" class="rounded bg-green-600 text-white px-2 py-1">Ver disciplinas</a></td>
                        <td><a id="{{$curso->id_curso}}" width="fit-content" href="/curso/sobre/{{$curso->id_curso}}" class="rounded bg-green-600 text-white px-2 py-1">Mais..</a></td>
                        
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
            </div>

</body>