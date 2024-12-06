
function buscar_dados(){
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
  
   console.log("ola");
   //event.preventDefault(); // Prevent the form from being submitted traditionally
  
   console.log(document.getElementById('tipo_contrato').value);
   $.ajax({
       type: 'GET',
       url: '/docente/get_disciplinas',
       data: { id_docente: document.getElementById("id_docente").value, tipo_contrato: document.getElementById('tipo_contrato').value },
       success: function (data) {
       console.log(data.response);
       // Assuming data is an array of objects with properties 'column1' and 'column2'
       var table = document.getElementById("tb-data");
       var tbody = table.getElementsByTagName("tbody")[0];
           // Get all rows in tbody except the first one
           var rowsToRemove = tbody.querySelectorAll("tr:not(:first-child)");
  
           // Remove the rows
           rowsToRemove.forEach(function (row) {
           tbody.removeChild(row);
           });
  
       // Loop through the data and add rows to the table
       data.response.forEach(function (item) {
           var row = tbody.insertRow();
   
           // Add cells to the row and populate with data
           var cell1 = row.insertCell(0);
           var cell2 = row.insertCell(1);
           var cell3 = row.insertCell(2);
           var cell4 = row.insertCell(3);
           var cell5 = row.insertCell(4);
           var cell6 = row.insertCell(5);
           cell1.innerHTML = item.nome_disciplina;
           cell2.innerHTML = item.horas_contacto;
           cell3.innerHTML = item.designacao_curso;
           cell4.innerHTML = item.ano;
           cell5.innerHTML = item.semestre;
           cell6.innerHTML = '<button type="hidden" onclick="remover(this.id)">Remover</button>';
           // Add more cells and properties as needed
       });
       },
       error: function () {
       alert("error");
       }
   });
   
  }
 

  document.addEventListener("DOMContentLoaded", function () {
    function get_estatisticas_genero() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                type: 'GET',
                url: '/docente/by_genero',
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    

    get_estatisticas_genero().then(function(data) {
        var ctx = document.getElementById('myChart').getContext('2d');
        renderChart(data, ctx);
    }).catch(function(error) {
        console.error('Error fetching data:', error);
    });



    function renderChart(data, ctx) {
        var estatisticas = data;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Maculino', 'Femenino'],
                datasets: [{
                    label: '# Docentes por Genero',
                    data: [estatisticas.masculino, estatisticas.femenino],
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
       

    }

    function get_estatisticas_nivel() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                type: 'GET',
                url: '/docente/by_nivel',
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    get_estatisticas_nivel().then(function(data) {
        var ctx = document.getElementById('myChart2').getContext('2d');
        renderChart2(data, ctx);
    }).catch(function(error) {
        console.error('Error fetching data:', error);
    });

    function renderChart2(data, ctx) {
        data;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Licenciado', 'Mestre', 'Doutor'],
                datasets: [{
                    label: '# Docentes por Nivel',
                    data: [data.licenciado, data.mestre, data.doutor],
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

        
    }


    function get_estatisticas_genero_contratados() {
        return new Promise(function(resolve, reject) {
            var dataAtual = new Date();

// Obter o ano atual
            var anoAtual = dataAtual.getFullYear();
            console.log(anoAtual);
            $.ajax({
                type: 'GET',
                url: '/docente/contratados_genero',
                data: {ano: anoAtual},
                success: function (data) {
                    resolve(data);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    get_estatisticas_genero_contratados().then(function(data) {
        var ctx = document.getElementById('myChart3').getContext('2d');
        renderChart3(data, ctx);
    }).catch(function(error) {
        console.error('Error fetching data:', error);
    });

    function renderChart3(data, ctx) {
        data;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Masculino', 'Femenino'],
                datasets: [{
                    label: '# Contratados por genero',
                    data: [data.masculino, data.femenino],
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
    }

    

});

function get_byAno(){
    window.location.href = "/" + document.getElementById('ano').value;
}