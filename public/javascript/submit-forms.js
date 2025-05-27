
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
        url: '/faculdade/save',
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

    function get_faculdades(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'GET',
            url: '/faculdade/vizualisar',
// Passa o id_docente aqui
            success: function (response) {
                console.log(response);
                console.log(response);
                const tbody = $('#faculdades');
                tbody.empty(); // Clear the table before filling
               // $('#list_docentes_title').text(`Lista de áreas ${id_docente}`);
    
                // Iterate over the data and create table rows
                response.faculdades.forEach(faculdade => {
                    console.log(faculdade.nome_faculdade)
                    const row = $('<tr></tr>');
                    row.append($('<td></td>').text(faculdade.nome_faculdade));
                    row.append($('<td></td>').text(faculdade.sigla_faculdade));
                    const btAccoes = `<i class="fa-solid fa-trash action"></i>
                                <i class="fa-solid fa-pen-to-square action" data-id="${faculdade.id_faculdade}" onclick="editFaculdade(this)"></i>
                                <i class="fa-solid fa-eye action" data-id="" onclick="detalhesFaculdade(this)"></i>`;
                    row.append($('<td></td>').html(btAccoes));
                    tbody.append(row);
                });
                $('#modal-lista-faculdades').modal('show');
            },
            error: function () {
                alert("error");
            }
        });
    }

    function editFaculdade(element) {
        window.location.href = '/faculdade/edit/' + element.getAttribute('data-id');
    }


    function get_users(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'GET',
            url: '/user/ver',
// Passa o id_docente aqui
            success: function (response) {
                console.log(response);
                console.log(response);
                const tbody = $('#users');
                tbody.empty(); // Clear the table before filling
               // $('#list_docentes_title').text(`Lista de áreas ${id_docente}`);
    
                // Iterate over the data and create table rows
                response.response.forEach(user => {
                    const row = $('<tr></tr>');
                    row.append($('<td></td>').text(user.name));
                    if(user.tipo_user == 1){
                        row.append($('<td></td>').text('Administrador'));
                    }else{
                        row.append($('<td></td>').text('Gestor')); 
                    }
                    
                    //const buttonHtml = `<button id="'${docente.id_docente}'" onclick="disciplinas_docente('${docente.id_docente}')">Ver Disciplinas</button>`;
                    //row.append($('<td></td>').html(buttonHtml));
                   // const buttonHtml2 = `<button id="'${docente.id_docente}'" onclick="gerar('${docente.id_docente}')">Gerar</button>`;
                   // row.append($('<td></td>').html(buttonHtml2));
                    tbody.append(row);
                });
                $('#modal-lista-users').modal('show');
            },
            error: function () {
                alert("error");
            }
        });
    }

    function get_tecnicos(){
        var cod_disciplinas;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'GET',
            url: '/tec/all',
            success: function (response) {
                const tbody = $('#tecnicos');
                tbody.empty(); 
    
                response.response.forEach(tecnico => {
                    const row = $('<tr></tr>');
                    row.append($('<td></td>').text(tecnico.nome_tecnico + ' ' + tecnico.apelido_tecnico));
                    row.append($('<td></td>').text(tecnico.designacao_curso));
    
                    
                    // Criar o select para disciplinas
                    const selectDisciplina = $('<select></select>').attr('data-id-curso', tecnico.id_curso);
                    selectDisciplina.append('<option value="">Selecione uma disciplina</option>');
                    selectDisciplina.on('change', function() {
                        // $('#codigo_disciplina').val = $(this).val();
                        alert('Disciplina selecionada: ' + $(this).val());
                        cod_disciplinas = $(this).val();
                    });
                    // Buscar as disciplinas para o curso
                    $.ajax({
                        type: 'GET',
                        url: `/disciplina/get_disciplinas_curso?id_curso=${tecnico.id_curso}`,
                        success: function (disciplinas) {
                            disciplinas.forEach(disciplina => {
                                selectDisciplina.append(
                                    $('<option></option>')
                                        .val(disciplina.codigo_disciplina)
                                        .text(disciplina.nome_disciplina)
                                );
                               
                            });
                        },
                        error: function () {
                            alert("Erro ao carregar disciplinas");
                        }
                    });
                    
                    row.append($('<td></td>').append(selectDisciplina));
                    tbody.append(row);
                    // Adicionar coluna com botão
                const button = $('<button>Gerar Contrato</button>').text('Gerar Contrato').on('click', function() {
                    
                    alert('Botão clicado para: ' + tecnico.id_tecnico+' disciplina'+' '+cod_disciplinas);
                    reg_contr_laboratorio(tecnico.id_tecnico, cod_disciplinas, tecnico.id_curso, document.getElementById('ano').value)
                });
                row.append($('<td></td>').append(button));
                });
                $('#modal-lista-users').modal('show');
            },
            error: function () {
                alert("error");
            }
        });
    }
    //ano_contrato

    function reg_contr_laboratorio(id_tecnico, codigo_disciplina, id_curso, ano_contrato){
        console.log('id_tec: '+id_tecnico)
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
            url: '/lab/save',
            data: {id_tecnico: id_tecnico, codigo_disciplina: codigo_disciplina, id_curso: id_curso, ano_contrato: ano_contrato},
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
    function reg_usuario() {
        // Configuração do token CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        console.log("Iniciando o registro de usuário...");
    
        $.ajax({
            type: 'POST', // Método correto
            url: '/user/save', // URL correta
            data: $('#user-reg').serialize(), // Serializa os dados do formulário
            success: function (data) {
                console.log("Resposta recebida:", data);
    
                // Verifica se há erros
                if (jQuery.isEmptyObject(data.errors)) {
                    $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                    //$('#user-reg')[0].reset(); // Reseta o formulário após sucesso
                } else {
                    var errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(data.errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                        console.log(value);
                    });
                    errorsHtml += '</ul></div>';
                    $('#feedback').html(errorsHtml); // Exibe os erros no feedback
                }
            },
            error: function (xhr) {
                console.error("Erro ao registrar o usuário:", xhr.responseText);
                alert("Erro ao registrar o usuário. Verifique o console para mais detalhes.");
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
        url: '/curso/save',
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
    if(confirm("Tem a certeza que pretende registar disciplina/módulo?")){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    event.preventDefault(); // Prevent form submission and page refresh
        console.log("ola");
        $.ajax({
            type: 'POST',
            url: '/disciplina/save',
            data: $('#disciplina-reg').serialize(),
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    console.log("teste")
                    $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                }else{
                    var errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(data.errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                        console.log(value);
                    });
                    errorsHtml += '</ul></div>';
                    $('#feedback').html(errorsHtml);
                }
                
                //$('#disciplina-reg')[0].reset();
            },
            error: function () {
                alert("error");
            }
        });
    }
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

//
function get_docentesAlocados_ano(){
    //ano_contrato
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: '/contrato/docentes_alocados',
        data: { ano: document.getElementById('ano_contrato').value }, // Passa o id_docente aqui
        success: function (response) {
            console.log(response);
            console.log(response);
            const tbody = $('#docentes_alocados');
            tbody.empty(); // Clear the table before filling
           // $('#list_docentes_title').text(`Lista de áreas ${id_docente}`);

            // Iterate over the data and create table rows
            response.docentes.forEach(docente => {
                const row = $('<tr></tr>');
                row.append($('<td></td>').text(docente.nome_docente));
                const buttonHtml = `<button class="rounded bg-green-600 text-white px-2 py-1" id="'${docente.id_docente}'" onclick="disciplinas_docente('${docente.id_docente}')">Ver Disciplinas</button>`;
                row.append($('<td></td>').html(buttonHtml));
                const buttonHtml2 = `<button class="rounded bg-green-600 text-white px-2 py-1" id="'${docente.id_docente}'" onclick="gerar('${docente.id_docente}')">Gerar</button>`;
                row.append($('<td></td>').html(buttonHtml2));
                tbody.append(row);
            });
           // $('#modal-lista').modal('show');
        },
        error: function () {
            alert("error");
        }
    });
}
function get_contratosLab(){
    var ano = document.getElementById('ano_contrato').value
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: '/lab/all/'+ano,
        //data: { ano: document.getElementById('ano_contrato').value }, // Passa o id_docente aqui
        success: function (response) {
            console.log(response);
            console.log(response);
            const tbody = $('#tecnicos');
            tbody.empty(); // Clear the table before filling
           // $('#list_docentes_title').text(`Lista de áreas ${id_docente}`);

            // Iterate over the data and create table rows
            response.tecnicos.forEach(tecnico => {
                console.log(tecnico);
                const row = $('<tr></tr>');
                row.append($('<td></td>').text(tecnico.nome_tecnico));
                row.append($('<td></td>').text(tecnico.designacao_curso));
                row.append($('<td></td>').text(tecnico.nome_disciplina));
                
                const buttonHtml = `<a class="rounded bg-green-600 text-white px-2 py-1" href="/contrato/lab/${ano}/${tecnico.id_tecnico}">Ver Contrato</a>`;
                row.append($('<td></td>').html(buttonHtml));
                tbody.append(row);
            });
           // $('#modal-lista').modal('show');
        },
        error: function () {
            alert("error");
        }
    });
}

function disciplinas_docente(id){
    //ano_contrato
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: '/docente/get_disciplinas',
        data: { ano: document.getElementById('ano_contrato').value, id_docente: id }, // Passa o id_docente aqui
        success: function (response) {
            console.log(response);
            console.log(response);
            const tbody = $('#disciplinas');
            tbody.empty(); // Clear the table before filling
           // $('#list_docentes_title').text(`Lista de áreas ${id_docente}`);

            // Iterate over the data and create table rows
            response.response.forEach(disciplina => {
                const row = $('<tr></tr>');
                row.append($('<td></td>').text(disciplina.nome_disciplina));
                row.append($('<td></td>').text(disciplina.designacao_curso));
                //const buttonHtml = `<button id="'${disciplina.codigo_disciplina_in_leciona}'" onclick="disciplinas_docente('${docente.id_docente}')">Ver Disciplinas</button>`;
                //row.append($('<td></td>').html(buttonHtml));
                tbody.append(row);
            });
           $('#modal-lista-disciplinas').modal('show');
        },
        error: function () {
            alert("error");
        }
    });
}


function gerar(id){
        if(confirm("Gerar contrato?")){
    
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
        url: '/contrato/create',
        data: {id_docente: id, tipo_contrato: 1, ano: document.getElementById("ano_contrato").value},
        success: function (data) {
            console.log(data.response);
           // $('#feedback').html('alert(<div class="alert alert-success">' + data.response + '</div>)');
           alert(data.response);
           $(`#${id}`).remove();
           if(data.status == "success"){
            $('.modal-body').html('<div class="alert alert-success">' + data.response + '</div>');
           }else{
            $('.modal-body').html('<div class="alert alert-danger">' + data.response + '</div>');
           }
          
          //$('.modal').show();
        },
        error: function () {
            alert("error");
        }
    });
}
}

//REGISTAR DOCENTE
function reg_docente(event) {
    if(confirm("Tem a certeza que pretende registar docente?")){
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
            url: '/docente/save',
            data: $('#docente-reg').serialize(),
            success: function (data) {
                if (jQuery.isEmptyObject(data.errors)) {
                    console.log(data.response);
                    console.log(data);
                    $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                    
                    // Chama a função get_areas passando o id_docente
                    get_areas(data.id_docente);
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
}
function reg_tecnico(event) {
    event.preventDefault();
    let erros_bi_nuit = [];
    let iterator = 0;
    let response_bi = verifica_digitos(document.getElementById('bi').value);
    let response_nuit = verifica_digitos(document.getElementById('nuit').value);

    if (!isNaN(parseFloat(response_bi.last_char))) {
        erros_bi_nuit[iterator++] = mensagens.ultimo_carater_error_bi;
    }
    if (response_bi.nr_chars > 1) {
        erros_bi_nuit[iterator++] = mensagens.caracteres_invalidos_bi;
    }
    if (response_nuit.nr_chars > 0) {
        erros_bi_nuit[iterator++] = mensagens.caracteres_invalidos_nuit;
    }

    if (iterator > 0) {
        let bi_nuit_errorsHtml = '<div class="alert alert-danger"><ul>';
        erros_bi_nuit.forEach(erro => {
            bi_nuit_errorsHtml += `<li>${erro}</li>`;
        });
        bi_nuit_errorsHtml += '</ul></div>';
        document.getElementById('feedback').innerHTML = bi_nuit_errorsHtml;
    } else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/tec/save',
            data: $('#tecnico-reg').serialize(),
            success: function (data) {
                if (jQuery.isEmptyObject(data.errors)) {
                    console.log(data.response);
                    console.log(data);
                    $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                    
                    // Chama a função get_areas passando o id_docente
                    get_areas(data.id_docente);
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

function reg_area(event){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: '/area/save',
        data: $('#area-reg').serialize(),
        success: function (data) {
            if (jQuery.isEmptyObject(data.errors)) {
                console.log(data.response);
                console.log(data);
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
                
                // Chama a função get_areas passando o id_docente
                get_areas(data.id_docente);
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


function get_areas(id_docente) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'GET',
        url: '/areas/get_areas',
       // data: { id_docente: id_docente }, // Passa o id_docente aqui
        success: function (response) {
            console.log(response);
            console.log(response);
            const tbody = $('#docentes-table');
            tbody.empty(); // Clear the table before filling
            $('#list_docentes_title').text(`Lista de áreas ${id_docente}`);

            // Iterate over the data and create table rows
            response.areas.forEach(area => {
                const row = $('<tr></tr>');
                row.attr('id', `${area.cod_area}`);
                row.append($('<td></td>').text(area.cod_area));
                row.append($('<td></td>').text(area.designacao_area));
                
                //row.append($('<td></td>').text(areas.apelido));

                // Properly embed variables in button HTML using template literals
                const buttonHtml = `<button id="'${area.cod_area}'" onclick="alocar_area('${id_docente}', '${area.cod_area}')">Alocar</button>`;
                row.append($('<td></td>').html(buttonHtml));
                
                tbody.append(row);
            });
            $('#modal-lista').modal('show');
        },
        error: function () {
            alert("error");
        }
    });
}

function get_areas2(id_docente) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log('/areas/get_areas/'+id_docente)
    $.ajax({
        type: 'GET',
        url: '/areas/get_areas/'+id_docente,
       // data: { id_docente: id_docente }, // Passa o id_docente aqui
        success: function (response) {
            console.log(response);
            console.log(response);
            const tbody = $('#docentes-table2');
            tbody.empty(); // Clear the table before filling
            $('#list_docentes_title2').text(`Lista de áreas ${id_docente}`);

            // Iterate over the data and create table rows
            response.areas.forEach(area => {
                const row = $('<tr></tr>');
                row.append($('<td></td>').text(area.cod_area));
                row.append($('<td></td>').text(area.designacao_area));
                //row.append($('<td></td>').text(areas.apelido));

                // Properly embed variables in button HTML using template literals
                //const buttonHtml = `<button id="'${area.cod_area}'" onclick="alocar_area('${id_docente}', '${area.cod_area}')">Alocar</button>`;
                
                tbody.append(row);
            });
            $('#modal-lista2').modal('show');
        },
        error: function () {
            alert("error");
        }
    });
}

function alocar_area(docente, area){
    if(confirm("Tem a certeza que pretende alocar área?")){
    console.log(docente)
    console.log(area);
    console.log(area);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: '/areas/alocar_area',
        data: {id_docente: docente, cod_area: area},
        success: function (data) {
            if (jQuery.isEmptyObject(data.errors)) {
                console.log(data.response);
                console.log(data);
                $('#feedback2').html('<div class="alert alert-success">' + data.response + '[área '+area+']</div>');
                
                // Chama a função get_areas passando o id_docente
               // get_areas(data.id_docente);
               document.getElementById(area).innerText = "Alocado";
               //document.getElementById(area).disabled=true;
               $(`#${area}`).remove();
               
            } else {
               
                $('#feedback2').html('<div class="alert alert-danger">' + data.erro_message + '</div>');
            }
        },
        error: function () {
            alert("error");
        }
    });
}
}


function buscarDisciplinas(id_docente, ano_contrato){
    $.ajax({
    type: 'GET',
    url: '/docente/get_disciplinas',
    data: {
      id_docente: id_docente,
      //tipo_contrato: $("#tipo_contrato").val(),
      ano: ano_contrato
    },
    success: function (data) {
      console.log(data.response);

      if (data.response.length === 0) {
        alert("Docente sem disciplina alocada");
        return;
      }

      var $tbody = $("#tb-data tbody");

      // Remove todas as linhas, exceto a primeira
      $tbody.find("tr:not(:first-child)").remove();

      // Adiciona as novas linhas com os dados recebidos
      data.response.forEach(function (item) {
        var row = `
          <tr id="${item.codigo_disciplina_in_leciona}">
            <td>${item.nome_disciplina}</td>
            <td>${item.horas_contacto}</td>
            <td>${item.designacao_curso}</td>
            <td>${item.ano}</td>
            <td>${item.semestre}</td>
            <td>
              <button onclick="remover('${$("#id_docente").val()}', '${item.codigo_disciplina_in_leciona}', ${item.ano})">Remover</button>
            </td>
          </tr>
        `;
        $tbody.append(row);
      });
    },
    error: function () {
      alert("error");
    }
  });
}


function addDisciplina(){
    if(confirm("Tem a certeza que pretende alocar disciplina/módulo ?")){
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
        url: '/docente/alocar/add_disciplina',
        data: {
            id_docente: document.getElementById('id_docente').value,
            id_curso: document.getElementById('curso').value,
            codigo_disciplina: document.getElementById('disciplina').value,
            tipo_contrato: 1,
            ano: document.getElementById("ano_contrato").value  

        },
        success: function (data) {
            if (jQuery.isEmptyObject(data.errors)){
                console.log(data.response);
                //console.log(data.novo_registo);
             
                $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');

                // Adiciona a linha na tabela
                buscarDisciplinas(document.getElementById('id_docente').value, document.getElementById('ano_contrato').value);    
            }else{
                var errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(data.errors, function (key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                        console.log(value);
                    });
                    errorsHtml += '</ul></div>';
                    $('#feedback').html(errorsHtml);

            }
         //document.getElementById("header").innerHTML = "Modulos Lecionados lecionados por "+document.getElementById("docente").value;
        
        },
        error: function () {
            alert("error");
        }
    });
}
  
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
        url: '/contrato/novos_contratos',
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

