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
/*

*/
var buscar_docente = val => {
  //input.addEventListener("keyup", function(){
    console.log(val);
  
    removeElements();
    //console.log(arrDocentes.length);
    for (let i of arrDocentes) {
      if (i.toLowerCase().startsWith(this.value.toLowerCase()) && this.value !== "") { 
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
          removeElements();
        };
        let word =
          "<b>" +
          i.substr(0, this.value.length) +
          "</b>" +
          i.substr(this.value.length);
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

function checkByAno(input){ 

  var ajax = new XMLHttpRequest();
  var method = "GET";
  var url = "disciplina-get-curso.php?ano="+input.value+"&id_curso="+document.getElementById('curso').value;
  var asynchronous = true;
  ajax.open(method, url, asynchronous); 
  ajax.send();
  ajax.onreadystatechange = function(){

      if(this.readyState == 4 && this.status == 200){
          var data = JSON.parse(this.responseText);
          arrDisciplinas = data;
          console.log(arrDisciplinas);
      
          
          var html = "";
          for(var a = 0; a< data.length; a++){
              //if(data[a].codigo_docente="null"){
                  html += "<option value="+data[a].codigo_disciplina+">"+data[a].nome_disciplina+"</option>";
              //}
              
          }
          document.getElementById("disciplina").innerHTML = html;
          }else{
              console.log("erro");
          }
    }
    
    
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


function gerarContracto(){
  const form = document.getElementById("form");
  document.getElementById("ano-contrato2").value = document.getElementById("ano-contrato").value;
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "contracto-criar.php", true);
  xhr.onload = ()=>{
  if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
          let data = xhr.response;
          console.log(data);
          //feedback = 
          document.getElementById("feedback").innerHTML = data;
      }
  }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}

function verDisciplinasNaoAssociadas(){
  var ajax = new XMLHttpRequest();
  var method = "GET";
  var url = "get-disciplinas-nao-associadas.php?id_curso="+document.getElementById('curso').value+"&ano-contrato="+document.getElementById("ano-contrato").value;
  var asynchronous = true;
  ajax.open(method, url, asynchronous); 
  ajax.send();
  ajax.onreadystatechange = function(){

      if(this.readyState == 4 && this.status == 200){
          var data = JSON.parse(this.responseText);
          arrDisciplinas = data;
          console.log(arrDisciplinas);
      
          
          var html = "";
          for(var a = 0; a< data.length; a++){
              //if(data[a].codigo_docente="null"){
                  html += "<option value="+data[a].codigo_disciplina+">"+data[a].nome_disciplina+"</option>";
              //}
              
          }
          document.getElementById("tbody").innerHTML = html;
          document.body.classList.add("active-popup");
          }else{
              console.log("erro");
          }
    }
}
function closeBox(){
  document.body.classList.remove("active-popup");
  
}
