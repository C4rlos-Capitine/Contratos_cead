


function update_docente(event){

    

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