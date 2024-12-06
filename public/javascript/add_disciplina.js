function add_disciplina_to_docente(id_docente, codigo_disciplina, id_curso)
  {
    console.log(codigo_disciplina);
    console.log(id_curso);
    console.log(id_docente);
    console.log(document.getElementById('ano_contrato').value)
    if(document.getElementById('ano_contrato').value == ""){
      alert("Informe o ano");
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    console.log("ola");
    $.ajax({
        type: 'POST',
        url: '/docente/alocar/add_disciplina',
        data: {
            id_docente: id_docente,
            id_curso: id_curso,
            codigo_disciplina: codigo_disciplina,
            tipo_contrato: 1,
            ano: document.getElementById('ano_contrato').value  

        },
        success: function (data) {
            console.log(data.status);
            //console.log(data.novo_registo);
            //var novoRegisto = data.novo_registo;
            if(data.status == 0){
              $('#feedback').html('<div class="alert alert-danger">' + data.response + '</div>');
              
            }else{
              $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');

            }
            
           
        },
        error: function () {
            alert("error");
        }
    });
  }