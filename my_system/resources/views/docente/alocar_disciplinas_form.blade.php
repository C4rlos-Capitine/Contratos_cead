

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
    #tb-data{
      width: 80%;
      margin-left: 50px;
    }
    .info{
      width: 80%;
      margin-left: 50px;
    }
    .row {
        margin-top: 5px;
        padding: 5px;
        text-align: left;
    }
    </style>

    
<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-discilplina-alocar-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
       // $(document).ready(function(){
            //new DataTable('#example');
            $('#close-modal').on('click', function() {
                $('.modal').hide();   
            });
            
            
          //});
    });
    </script>
<script>
var input;
var ano;
//var buscar_dados;
var bt_submeter;
var arrDocentes = [];
var docentes = [];

//document.addEventListener("DOMContentLoaded", function() {

input = document.getElementById("docente");
ano  = document.getElementById("ano_academico");
bt_submeter = document.getElementById("submit");
//});

console.log(input);
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
  url: '/cead_template2/docente/get_disciplinas',
  data: { id_docente: document.getElementById("id_docente").value, tipo_contrato: document.getElementById('tipo_contrato').value, ano: document.getElementById("ano_contrato").value },
  success: function (data) {
    console.log(data.response);
    if(data.response.length==0){
      alert("Docente sem disciplina alocada")
    }
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

console.log("ola");
//document.addEventListener("DOMContentLoaded", function(){
getDocentes(imprimirDocentes);
console.log("ola2")
// Rest of your code...




  function getDocentes(callback) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      type: 'GET',
      url: '/cead_template2/docente/vizualisar',
      data: {json: "true"},
      success: function (response) {
          //$('#feedback').html(response);
          arrDocentes = response.map(function (docente) {
            return docente.nome_docente;
          });
          callback();
      },
      error: function () {
          alert("error");
      }
  });
   
    }

//});
//console.log(input);
function displayNames(value, input) {
  console.log(docentes.length);
  input.value = value;
  console.log(input);
  
  for(var i=0; i<docentes.length; i++){
    if(value == docentes[i].nome){
      document.getElementById("id_docente").value = docentes[i].id_docente;
      console.log(document.getElementById('id_docente').value)
      //console.log(document.getElementById("id_docente").value);
      document.getElementById("id_nivel").value = docentes[i].id_nivel;
      document.getElementById("valor_nivel").value = docentes[i].valor;
      document.getElementById("designacao_nivel").value = docentes[i].designacao_nivel;
      break;
    }
  }
  removeElements();
  }

  function add_disciplina2(codigo_disciplina, id_curso)
  {
    console.log(codigo_disciplina);
    console.log(id_curso);
    if(document.getElementById('ano_contrato').value == ""){
      alert("Informe o ano");
    }
    if(document.getElementById('tipo_contrato').value == ''){
      alert("Selecione o tipo de contrato")
    }
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
            id_curso: id_curso,
            codigo_disciplina: codigo_disciplina,
            tipo_contrato: document.getElementById('tipo_contrato').value,
            ano: document.getElementById("ano_contrato").value  

        },
        success: function (data) {
            console.log(data.status);
            //console.log(data.novo_registo);
            var novoRegisto = data.novo_registo;
            if(data.status == 0){
              $('#feedback').html('<div class="alert alert-danger">' + data.response + '</div>');
              
            }else{
              $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
            
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
          
            }
            
           
        },
        error: function () {
            alert("error");
        }
    });

    //console.log(document.getElementById('tipo_contrato').value)
  }

var buscar_docente = val => {
  //input.addEventListener("keyup", function(){
    console.log(val);
  
    removeElements();
    //console.log(arrDocentes.length);
    for (let i of arrDocentes) {
      if (i.toLowerCase().startsWith(val.toLowerCase()) && val !== "") { 
        let listItem = document.createElement("li");
        listItem.classList.add("list-items");
        listItem.style.cursor = "pointer";
        listItem.setAttribute(
          "onclick",
          "displayNames('" + i + "', '" + val + "')"
        );
  
        listItem.onclick = () => {
          document.getElementById('docente').value = i;
          console.log(document.getElementById('docente').value);
          console.log(docentes);
          for (var j = 0; j <= docentes.length; j++) {
            if (i == docentes[j].nome_docente) {
              document.getElementById("id_docente").value = docentes[j].id_docente;
              console.log(document.getElementById("id_docente").value);
              document.getElementById("id_nivel").value = docentes[j].id_nivel;
              document.getElementById("valor_nivel").value = docentes[j].valor;
              document.getElementById("designacao_nivel").value =
                docentes[j].designacao_nivel;
              break;
            }
          }
          console.log(document.getElementById("id_docente").value)
          //buscar historico
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type: 'GET',
            url: '/cead_template2/docente/ml_call',
            data: {id_docente: document.getElementById("id_docente").value},
            success: function (response) {
                //$('#feedback').html(response);
                console.log(response)
                var tabela = '<table class="table"><thead><tr><th scope="col">cod</th><th scope="col">curso</th><th scope="col">disciplina</th><th scope="col"></th></tr></thead>';
                tabela += '<tbody>'
                for(i=0; i<response.length; i++){
                  console.log(response[i].codigo)
                  tabela += '<tr><td scope="row">'+response[i].codigo+'</td><td>'+response[i].curso+'</td><td>'+response[i].disciplina+'</td><td><button id="buscar_dados"  onclick="add_disciplina2(\'' + response[i].codigo + '\', \'' + response[i].id_curso + '\')" width="fit-content" class="rounded bg-green-600 text-white px-2 py-1">alocar</button></td></tr>'
                }
                tabela += '<tbody></table>'
                $('#modal-lista').modal('show');
                $('#lista-modal-content').html(tabela);
            },
            error: function () {
                alert("error");
            }
        });
          removeElements();
        };
        let word =
          "<b>" +
          i.substr(0, val.length) +
          "</b>" +
          i.substr(val.length);
        listItem.innerHTML = word;
        document.querySelector(".list").appendChild(listItem);
      }
    }
  //});
  }
  

  
  function removeElements() {
  let items = document.querySelectorAll(".list-items");
  items.forEach(function (item) {
    item.remove();
  });
  }


function getDocentes(callback) {
var ajax = new XMLHttpRequest();
var method = "GET";
var url = "/cead_template2/docente/vizualisar?json=true";
var asynchronous = true;

ajax.open(method, url, asynchronous);
ajax.send();
ajax.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    docentes = JSON.parse(this.responseText);
    //console.log(docentes);
    arrDocentes = docentes.map(function (docente) {
      return docente.nome_docente;
    });
    //console.log(arrDocentes);
    callback();
  }
};
}

// Rest of your code...
function imprimirDocentes() {
  arrDocentes.sort();
  console.log(arrDocentes);
  console.log(docentes);
}



function validarForm() {
var nome_curso = document.getElementById("curso").value;
var nome_disciplina = document.getElementById("disciplina").value;

for (var i = 0; i < cursos.length; i++) {
  if (cursos[i].designacao == nome_curso) {
    document.getElementById("id_curso").value = cursos[i].id_curso;
    console.log("achado!!!");
    break;
  }
}

for (var i = 0; i < disciplinas.length; i++) {
  if (disciplinas[i].nome == nome_disciplina) {
    document.getElementById("codigo_disciplina").value =
      disciplinas[i].codigo_disciplina;
    console.log("achado!!!");
    break;
  }
}
}

var arrDisciplinas = [];

function remover(id){
  var oTable = document.getElementById('tb-table');

  var rowLength = oTable.rows.length;
  var estado = false;
  for (i = 0; i < rowLength; i++){

      //gets cells of current row  
      var oCells = oTable.rows.item(i).cells;

      var cellLength = oCells.length;

      for(var j = 0; j < cellLength; j++){

          var cellVal = oCells.item(j).innerHTML;
          if(cellVal == id){
              estado = true;
              break;
          }                               
              //alert(cellVal);
      }
      if(estado==true){
          document.getElementById("tb-table").deleteRow(i);
          break;
      }
  }
}






//var arrDisciplinas = [];

</script>



<body class="antialiased">
   @include('../header2')


<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header"><label id="cont-title">Alocar disciplinas à docente</label></div>
            <div id="info">
              <div class="modal fade bd-example-modal-lg" id="modal-lista" style="margin-top:300px;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    
                  <div id="lista-modal-content" class="modal-content">
                  <div id="feedback-modal-list"></div>
                    
                  </div>
                </div>
              </div>
            @csrf
		<!--<form id="adicionar-disc">-->
                <div id="feedback"></div>
           
                <div class="row">
                  <div class="col">
                    <label class="input-label" for="floatingInput">Nome do docente</label>
                    <div class="form-floating mb-3" style="width:50%">
                        <input required="true"  type="text" class="form-control" onkeyup="buscar_docente(this.value)" id="docente" name="docente" placeholder="Docente">
                        <label class="input-label" for="floatingInput">Docente</label>
                        <ul class="list"></ul>
                    </div>
                    </div>
                    <div class="col-md-3">
                        <button id="buscar_dados" type="submit" onclick="buscar_dados()" width="fit-content" class="rounded bg-green-600 text-white px-2 py-1">Buscar disciplinas</button>
                    </div>
                    <div class="col-md-3">
                    <label class="input-label" for="floatingInput">Ano do contrato</label>
                      <input required="true" id="ano_contrato" type="number" name="ano_contrato" min="1900" max="2100" step="1" class="form-control">
                    </div>
                <div class="col-md-3">
                 
                 <select id="tipo_contrato" name="tipo_contrato" class="form-select" required>
                    <option selected disabled value="">Tipo de Contrato</option>   
                    @foreach($tipo_contrato as $tipo)
                        <option value="{{$tipo->id_tipo_contrato}}">{{ $tipo->designacao_tipo_contrato }}</option>
                    @endforeach
                 
                 </select>
             </div>
        
            </div>
                <!--<div class="column">-->
                
                <!--</div>-->
            </div>
            <div class="row">
                <!--<div class="column">-->
                <div class="col-md-3">
                <label>Curso<span style="color:red">*</span></label>
                 <select id="curso" name="curso" class="form-select" id="validationCustom04" required>
                 
                 <option selected disabled value="">Curso</option>   
                 @foreach($cursos as $curso)
                     <option value="{{$curso->id_curso}}">{{ $curso->designacao_curso }}</option>
                 @endforeach
                 
                 </select>
             </div>
                <div class="col-md-3">
                    <label>Ano<span style="color:red">*</span></label>
                    <select id="ano" name="ano" class="form-select"  required>
                    <option selected disabled value="">Ano</option>
                    <option value="1">1 Ano</option>
                    <option value="2">2 Ano</option>
                    <option value="3">3 Ano</option>
                    <option value="4">4 Ano</option>
                    </select>
                </div>
                <div class="col-md-3">
                  <label>Semestre<label>Curso<span style="color:red">*</span></label></label>
                    <select id="semestre" name="semestre" class="form-select"required>
                    <option selected disabled value="">Semestre</option>
                    <option value="1">1 semestre</option>
                    <option value="2">2 semestre</option>
                    
                    </select>
                </div>
                <!--</div>-->
                <!--<div class="column">-->
                <div class="col-md-3">
                    <label>Disciplina/Modulo<label>Curso<span style="color:red">*</span></label></label>
                    <select id="disciplina" name="disciplina" class="form-select" required>
                    <option selected disabled value="">Disciplinas</option>   
                    </select>
                </div>
                <!--</div>-->
                
            </div>
        <!--</form>-->
           
       
        <div class="div-button" style="margin-left:50px">
            <div class="col-md-3">
                <button width="fit-content" class="rounded bg-green-600 text-white px-2 py-1" onclick="addDisciplina()">Adicionar disciplina</button>
            </div>
        </div>

            <form method="POST" id="form">
            @csrf
            <table id="tb-data" class="table table-striped" width="60%">
                <thead>
                    <tr><th id="header" colspan="6" scope="col">Modulos Lecionados</th></tr>
                    <tr>
                        <th scope="col">Modulo</th><th scope="col">Horas de Contacto</th><th scope="col">Curso</th><th scope="col">Ano</th><th scope="col">Semestre</th><th scope="col">action</th>
                    </tr>
                </thead>
                    <tbody>
                        
                    </tbody>
                
            </table>
            <input type="hidden" name="id_docente" id="id_docente">
            <input type="hidden" name="id_nivel" id="id_nivel">
            <input type="hidden" name="valor_nivel" id="valor_nivel">
            <input type="hidden" name="designacao_nivel" id="designacao_nivel">
            
            </form>
            <div class="col-md-3" style="margin-left:50px">
                <button type="submit" width="fit-content"  onclick="gerar_pdf()" class="rounded bg-green-600 text-white px-2 py-1">Gerar contrato</button>
            </div>
        </div>
    </div>
    
</main>
<div class="modal" style="margin-top:100px">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mensagem</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="msg">O contrato já existe.</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="close-modal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
@include('../footer')
<script>

  function gerar_pdf()
  {
    //window.location.href = "/cead_template/contrato/gerar_pdf?id_docente="+document.getElementById('id_docente').value;
   
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
        url: '/cead_template2/contrato/create',
        data: {id_docente: document.getElementById('id_docente').value, tipo_contrato: document.getElementById('tipo_contrato').value, ano: document.getElementById("ano_contrato").value},
        success: function (data) {
            console.log(data.response);
           // $('#feedback').html('alert(<div class="alert alert-success">' + data.response + '</div>)');
           //alert(data.response);
           if(data.status == "success"){
            $('.modal-body').html('<div class="alert alert-success">' + data.response + '</div>');
           }else{
            $('.modal-body').html('<div class="alert alert-danger">' + data.response + '</div>');
           }
          
          $('.modal').show();
        },
        error: function () {
            alert("error");
        }
    });
  }
    
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

</script>
<!--<script src="{{ asset('javascript/funcoes_alocar.js') }}"></script>-->
</body>
            

<?php
//}
