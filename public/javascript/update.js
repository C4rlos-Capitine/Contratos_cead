function update_docente(event) {
    event.preventDefault();
    erros_bi_nuit = [];
    var iterator = 0;
    var response_bi = verifica_digitos(document.getElementById('bi').value);
    var response_nuit = verifica_digitos(document.getElementById('nuit').value);
    console.log(response_bi);
    console.log(response_nuit);

    if(!isNaN(parseFloat(response_bi.last_char))) {
        erros_bi_nuit[iterator] = mensagens.ultimo_carater_error_bi;
        iterator++; 
    }
    if(response_bi.nr_chars > 1) {
        erros_bi_nuit[iterator] = mensagens.caracteres_invalidos_bi;
        iterator++;
    }

    if(response_nuit.nr_chars > 0) {
        erros_bi_nuit[iterator] = mensagens.caracteres_invalidos_nuit;
        iterator++;
    }

    if(iterator > 0) {
        var bi_nuit_errorsHtml = '<div class="alert alert-danger"><ul>';
        for(var i = 0; i < erros_bi_nuit.length; i++) {
            bi_nuit_errorsHtml += '<li>' + erros_bi_nuit[i] + '</li>';
        }
        bi_nuit_errorsHtml += '</ul></div>';
        $('#feedback').html(bi_nuit_errorsHtml);
    } else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/docente/update',
            data: $('#docente-reg').serialize(),
            success: function (data) {
                if (jQuery.isEmptyObject(data.errors)) {
                    console.log(data.response);
                    console.log(data);
                    $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                    
                    // Chama a função get_areas passando o id_docente
                   // get_areas(data.id_docente);
                } else {
                    var errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(data.errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                        console.log(value);
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


function update_curso(event){

    

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
        url: '/curso/update',
        data: {
            //designacao_curso: document.getElementById('designacao_curso').value, 
            id_docente_dir_curso: document.getElementById('dir_curso').value,
            //sigla: document.getElementById('sigla').value,
            id_curso: document.getElementById('id_curso').value
        },
        success: function (data) {
            if (jQuery.isEmptyObject(data.errors)) {
                console.log(data.response);
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                $('#feedback').delay(5000).hide(0);
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


function update_docente(){

}

function update_contrato_assinado1(id_docente, ano){

    

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
        url: '/contrato/set_assinado_docente',
        data: {
            id_docente: id_docente,
            ano: ano
        },
        success: function (data) {
            if (jQuery.isEmptyObject(data.errors)) {
                console.log(data.response);
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                $('#feedback').delay(5000).hide(0);
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

function update_contrato_assinado2(id_docente, ano){
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
        url: '/contrato/set_assinado_up',
        data: {
            id_docente: id_docente,
            ano: ano
        },
        success: function (data) {
            if (jQuery.isEmptyObject(data.errors)) {
                console.log(data.response);
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                $('#feedback').delay(5000).hide(0);
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