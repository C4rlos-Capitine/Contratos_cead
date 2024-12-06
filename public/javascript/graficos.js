
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
                url: '/cead_template2/docente/by_nivel',
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
                url: '/cead_template2/docente/contratados_genero',
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
    window.location.href = "/cead_template2/" + document.getElementById('ano').value;
}