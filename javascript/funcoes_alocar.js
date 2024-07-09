    
document.getElementById("semestre").addEventListener('change', (event) => {
    
    console.log("ola");
    console.log(document.getElementById('ano').value);
    //event.preventDefault(); // Prevent the form from being submitted traditionally

    console.log("ola");
    $.ajax({
        type: 'GET',
        url: '/cead_template2/curso/get_disciplinas_nao_associada',
        data: {
            ano_contrato: document.getElementById('ano_contrato').value,
            ano: document.getElementById('ano').value,
            semestre: document.getElementById('semestre').value,
            id_curso: document.getElementById('curso').value,
            tipo_contrato: document.getElementById('tipo_contrato').value
        },
        success: function (data) {
            console.log(data);
            var html = "";
            for(var a = 0; a< data.length; a++){
                if(data[a].codigo_docente="null"){
                    html += "<option value="+data[a].codigo_disciplina+">"+data[a].nome_disciplina+"</option>";
                }
                
            }
            document.getElementById("disciplina").innerHTML = html;
        },
        error: function () {
            alert("error");
        }
    });
    
});