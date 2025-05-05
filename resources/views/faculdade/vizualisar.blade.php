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
        document.getElementById('load-faculdade-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    $(document).ready(function(){
                    new DataTable('#example');
                })
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

            
            <table id="example" class="table table-striped" style="width:100%">
                <thead><tr><th>Faculdade</th><th>Sigla</th></tr></thead>
                <tbody>
                @foreach($faculdades as $faculdade)
                    <tr>
                        <td>{{$faculdade->nome_faculdade}}</td>
                        <td>{{$faculdade->sigla_faculdade}}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        
            </div>
            </div>
            </div>
    </body>
</html>