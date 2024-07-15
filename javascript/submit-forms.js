
function reg_faculdade() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    console.log("ola");
    //event.preventDefault(); // Prevent the form from being submitted traditionally

    console.log("ola");
    $.ajax({
        type: 'POST',
        url: '/cead_template2/faculdade/save',
        data: $('#faculdade-reg').serialize(),
        success: function (data) {
            console.log(data);
            if (jQuery.isEmptyObject(data.errors)) {
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                //$('#feedback').delay(5000).hide(0);
                //$('#faculdade-reg')[0].reset();
            }else{
                var errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each(data.errors, function (key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                    console.log(value)
                });
                errorsHtml += '</ul></div>';
                $('#feedback').html(errorsHtml);
            }
        },
        error: function () {
            alert("error");
        }
    });
    }

//registar curso
function reg_curso() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    console.log($('#curso-reg').serialize());
    //event.preventDefault(); // Prevent the form from being submitted traditionally
    
    $.ajax({
        type: 'post',
        url: '/cead_template2/curso/save',
        data: $('#curso-reg').serialize(),
        success: function (data) {
            console.log(data);
            if (jQuery.isEmptyObject(data.errors)) {
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                //$('#feedback').delay(5000).hide(0);
                $('#curso-reg')[0].reset();
            } else {
                // Se houver erros, exiba-os
                var errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each(data.errors, function (key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                    console.log(value)
                });
                errorsHtml += '</ul></div>';
                $('#feedback').html(errorsHtml);
            }
            
        },
        error: function () {
            alert("error");
        }
    });
    }

    //REGISTAT DISCIPLINA
function reg_disciplina(event)
{
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    event.preventDefault(); // Prevent form submission and page refresh
        console.log("ola");
        $.ajax({
            type: 'POST',
            url: '/cead_template2/disciplina/save',
            data: $('#disciplina-reg').serialize(),
            success: function (data) {
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                
                $('#disciplina-reg')[0].reset();
            },
            error: function () {
                alert("error");
            }
        });
}

function validar_docente(event)
{
    if(document.getElementById("email").value.includes('@')){
        reg_disciplina(event);
    }else{
        alert("email inválido");
    }
}

function editarCurso() {
    
    console.log("ola");
    //event.preventDefault(); // Prevent the form from being submitted traditionally

    console.log("ola");
    $.ajax({
        type: 'post',
        url: 'curso-editar.php',
        data: $('#curso-editar').serialize(),
        success: function (response) {
            $('#feedback').html(response);
        },
        error: function () {
            alert("error");
        }
    });
}


//REGISTAR DOCENTE
function reg_docente(event){
    event.preventDefault();
    erros_bi_nuit = [];
    var iterator = 0;
    var response_bi = verifica_digitos(document.getElementById('bi').value);
    var response_nuit = verifica_digitos(document.getElementById('nuit').value);
    console.log(response_bi);
    console.log(response_nuit);

    if(!isNaN(parseFloat(response_bi.last_char))){
        erros_bi_nuit[iterator] = mensagens.ultimo_carater_error_bi;
        iterator++; 
    }
    if(response_bi.nr_chars>1){
        erros_bi_nuit[iterator] = mensagens.caracteres_invalidos_bi;
        iterator++;
    }

    if(response_nuit.nr_chars > 0){
        erros_bi_nuit[iterator] = mensagens.caracteres_invalidos_nuit;
        iterator++;
    }

    if(iterator>0){
        var bi_nuit_errorsHtml = '<div class="alert alert-danger"><ul>';
       for(var i=0; i<erros_bi_nuit.length; i++){
            bi_nuit_errorsHtml += '<li>'+erros_bi_nuit[i]+'</li>';
       }
       bi_nuit_errorsHtml += '</ul></div>';
       $('#feedback').html(bi_nuit_errorsHtml);
       //return
    }else{
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log("ola");
        event.preventDefault(); // Prevent the form from being submitted traditionally

        console.log("ola");
        $.ajax({
            type: 'POST',
            url: '/cead_template2/docente/save',
            data: $('#docente-reg').serialize(),
            success: function (data) {
                if (jQuery.isEmptyObject(data.errors)) {
                    console.log(data.response);
                    $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                    
                    $('#docente-reg')[0].reset();
                } else {
                    // Se houver erros, exiba-os
                    var errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(data.errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                        console.log(value)
                    });
                    errorsHtml += '</ul></div>';
                    $('#feedback').html(errorsHtml);
                }
            },
            error: function () {
                alert("error");
            }
        });
    }
    
}



function addDisciplina(){
 
    console.log(document.getElementById('id_docente').value)
    console.log(document.getElementById('curso').value)
    //event.preventDefault(); // Prevent the form from being submitted traditionally
  
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    console.log("ola");
    $.ajax({
        type: 'POST',
        url: '/cead_template2/docente/alocar/add_disciplina',
        data: {
            id_docente: document.getElementById('id_docente').value,
            id_curso: document.getElementById('curso').value,
            codigo_disciplina: document.getElementById('disciplina').value,
            tipo_contrato: document.getElementById('tipo_contrato').value,
            ano: document.getElementById("ano_contrato").value  

        },
        success: function (data) {
            console.log(data.response);
            //console.log(data.novo_registo);
            var novoRegisto = data.novo_registo;
            $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
            document.getElementById('#feedback').innerHTML = '<div class="alert alert-success">' + data.response + '</div>';
            //$('#feedback').delay(5000).hide(0);
            //$('#curso-reg')[0].reset();
            //var selectobject = document.getElementById("disciplina");
            //var text= selectobject.options[selectobject.selectedIndex].text;
            var table = document.getElementById("tb-data");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);

            
            cell1.innerHTML = novoRegisto[0].nome_disciplina;
            cell2.innerHTML = "--"//novoRegisto.horas_contacto ;
            cell3.innerHTML = novoRegisto[0].designacao_curso;
            cell4.innerHTML = document.getElementById("ano").value;
            cell5.innerHTML = document.getElementById('semestre').value;
            cell6.innerHTML = '<button type="hidden" onclick="remover(this.id)">Remover</button>';
            //document.getElementById("header").innerHTML = "Modulos Lecionados lecionados por "+document.getElementById("docente").value;
        
        },
        error: function () {
            alert("error");
        }
    });
  
  }


  function novos_cotratos(){
    console.log("ola")
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'post',
        url: '/cead_template2/contrato/novos_contratos',
        data: {ano_novo_contrato: document.getElementById('ano').value},
        success: function (response) {
            console.log(response);
            $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
        },
        error: function () {
            alert("error");
        }
    });
  }

