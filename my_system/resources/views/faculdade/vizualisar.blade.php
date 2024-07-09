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
        document.getElementById('load-faculdade-view').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>

<main class="main-section">
<body>
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Home</label></div>
        <div id="info">


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
        </main>
        @include('../footer')
    </body>
</html>