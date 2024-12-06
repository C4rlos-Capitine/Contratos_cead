<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="fontawsome/css/all.min.css" rel="stylesheet">
    <link href="fontawsome/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="javascript/funcoes_ver_contratos.js"></script>
    <script src="Jquery/jq"></script>
    <title>Document</title>
    <style>
        body{
            top: 0;
            left: 0;
            width: 100%;
            overflow: scroll;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        form{
            display: flex;
            flex-direction: column;
        }
        .form-floating{
            display:flex;
            flex-direction: column;
        }
        .header-section {
            top: 0;
            left: 0;
            padding-top: 2px;
            height: 60px;
            position: fixed;
            z-index: 9999;
            background: rgba(9, 32, 76, 0.882);
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .main-section{
            top: 60px;
            left: 0;
            padding-left: 0;
            /*height: 2000px;*/
            display: flex;
            flex-direction: row;
        }
        .side-section{
            left: 0;
            position: fixed;
            padding-top: 40px;
            margin-top: 60px;
            margin-right: 20px;
            width: 300px;
            height: 1500px;
            background: #43A047;
        }
        .menu-link{
            text-decoration: none;
            color: white;
        }
        .nav-bar{
            display: flex;
            flex-direction: column;
        }
        .nav-content{
            width: 100%;
            padding-top: 10px;
            padding-left: 10px;
            cursor: pointer;
        }
        .nav-content:hover{
            background: rgba(9, 32, 76, 0.882);
            cursor: pointer;
        }
        .content-section{
            /*height:2000px;*/
           width: 80%;
            margin-left: 300px;
            margin-top: 70px;
            padding: 50px;
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: scroll;
        }
        .row-section{
            margin-bottom: 10px;
            display: flex;
            flex-direction: row;
        }
        .card-img-top{
            width: 30px;
            height: 30px;
        }
        .card{
            margin-left: 10px;
        }
        .menu-label{
            margin-left: 10px;
            text-decoration: white;
            color: white;
            cursor: pointer;
        }
        #quit{
            height: 5px;
        }
        #quit-link{
            height: 60%;
        }
        #logo{
            height: 50px;
            order: 1;
            margin-left:50px;
            color: white;
        }
        #img-logo{
            height: 50px;
        }
        #header-right{
            order: 2;
            margin-right: 100px;
            width: fit-content;
            height: fit-content;
            background: red;
            background-color: red;
            color: white;
            border-radius: 20px 20px;
        }
        @media (max-width: 700px){
            .main-section{
                flex-direction: column;
            }
            .content-section{
                height:2000px;
                margin-top: 250px;
                margin-left:0;
                padding: 50px;
                width: 100%;
                position: relative;
                display: flex;
                flex-direction: column;
                overflow-y: scroll;
            }
            .side-section{
                width: 100%;
                height: fit-content;
                z-index: 9999;
                display:none;
            }
            .row-section{
                display: flex;
                flex-direction: column;
            }
            .card{
                margin-top: 10px;
            }
            
    
            
           
        }
    </style>
    <script src="Jquery/jq"></script>
 <!-- ... -->
<script src="javascript/submit-forms.js"></script>
<script src="javascript/template-controller.js"></script>
<!-- ... -->

</head>

<body>
    <header class="header-section">

        <!--<i class="fa-solid fa-bars" style="color: #f7f7f8;"></i>-->
        <div id="logo">
            <img id="img-logo" src="cead.png">
        </div>
       <!-- <button id="bt-quit">sair<i id="quit" class="fa-solid fa-power-off" style="color: #f4f0f0;"></i></button>-->
        <p id="header-right"><a id="quit-link" class="btn btn-danger" href="user-logout.php">sair<i id="quit" class="fa-solid fa-power-off" style="color: #f4f0f0;"></i></a></p>
    </header>
    
    <main class="main-section">
        <aside class="side-section">
            <div class="nav-bar">
                <div id="home" class="nav-content"><i class="fa-solid fa-house" style="color: #e5e7eb;"></i></i><label class="menu-label">Home</label></div>
                <div id="load-representante-form" class="nav-content"><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Representante</label></div>
                <div id="load-curso-form" class="nav-content"><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar curso</label></div>
                <div id="load-cat-disciplina-form" class="nav-content" ><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Categoria de disciplina</label></div>
                <div id="load-disciplina-form" class="nav-content" ><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Disciplina</label></div>
                <div id="load-docente-form" class="nav-content"><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Docente</label></div>
                <div id="load-curso-disciplina-form" class="nav-content"><i class="fa-solid fa-files" style="color: #e4e5ec;"></i><label class="menu-label">Associar disciplina a curso</label></div>
                <div id="load-curso-view" class="nav-content"><i class="fa-solid fa-table-list" style="color: #eff0f0;"></i><label class="menu-label">Visualizar Cursos</label></div>
                <div id="load-docente-view" class="nav-content"><i class="fa-solid fa-table-list" style="color: #eff0f0;"></i><label class="menu-label">Visualizar Docentes</label></div>
                <div id="load-contrato-view" class="nav-content"><i class="fa-solid fa-table-list" style="color: #eff0f0;"></i><label class="menu-label">Visualizar Contratos</label></div>
                <div id="load-contrato-form" class="nav-content"><i class="fa-solid fa-file-pen" style="color: #eceff3;"></i><label class="menu-label">Gerar Contrato</label></div>
                
            
            </div>
        </aside>
        <div class="content-section"  id="info">

            <div class="row-section">
                <div class="card">
                    <img src="grafic2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Contratos de 2023</h5>
                    <p class="card-text">Docentes contratados para tutorias: 20.</p>
                    <p class="card-text"><small class="text-muted">Contratos de tutorias</small></p>
                    </div>
                </div>
                <div class="card">
                    <img src="grafic2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Contratos de 2023</h5>
                    <p class="card-text">Docentes contratados para elaboracao de Manuais: 20.</p>
                    <p class="card-text"><small class="text-muted">Contratos de Elaboracao de Manuais</small></p>
                    </div>
                </div>
                <div>
                    <canvas id="myChart"></canvas>
                  </div>
                  
                  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                  
                  <script>
                    const ctx = document.getElementById('myChart');
                  
                    new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                          label: '# of Votes',
                          data: [12, 19, 3, 5, 2, 3],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  </script>
                  
            </div>
            <div class="row-section">
            <div class="card">
                    <img src="grafic2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Contratos de 2023</h5>
                    <p class="card-text">Docentes contratados para tutorias: 20.</p>
                    <p class="card-text"><small class="text-muted">Contratos de tutorias</small></p>
                    </div>
                </div>
               <!-- <div class="card">
                    <img src="grafic2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Contratos de 2023</h5>
                    <p class="card-text">Docentes contratados para elaboracao de Manuais: 20.</p>
                    <p class="card-text"><small class="text-muted">Contratos de Elaboracao de Manuais</small></p>
                    </div>
                </div>-->
            </div>
            </div>
            
        </div>
    </main>
</body>
<script>
    


</script>
</html>
