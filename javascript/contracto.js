var input;
var arrDocentes = [];
var docentes = [];
console.log("ola");
document.addEventListener("DOMContentLoaded", function () {
  input = document.getElementById("docente");
  setupInputListener();
  getDocentes(imprimirDocentes);
});

function getDocentes(callback) {
  var ajax = new XMLHttpRequest();
  var method = "GET";
  var url = "docentes-get.php";
  var asynchronous = true;

  ajax.open(method, url, asynchronous);
  ajax.send();
  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      docentes = JSON.parse(this.responseText);
      console.log(docentes);
      arrDocentes = docentes.map(function (docente) {
        return docente.nome;
      });
      callback();
    }
  };
}

function imprimirDocentes() {
  arrDocentes.sort();
}

function setupInputListener() {
  input.addEventListener("keyup", function (e) {
    removeElements();
    for (let i of arrDocentes) {
      if (
        i.toLowerCase().startsWith(input.value.toLowerCase()) &&
        input.value !== ""
      ) {
        let listItem = document.createElement("li");
        listItem.classList.add("list-items");
        listItem.style.cursor = "pointer";
        listItem.setAttribute("onclick", "displayNames('" + i + "')");
        let word =
          "<b>" +
          i.substr(0, input.value.length) +
          "</b>" +
          i.substr(input.value.length);
        listItem.innerHTML = word;
        document.querySelector(".list").appendChild(listItem);
      }
    }
  });
}

function displayNames(value) {
  input.value = value;
  for(var i=0; i<docentes.length; i++){
    if(value == docentes[i].nome){
      document.getElementById("id_docente").value = docentes[i].id_docente;
      //console.log(document.getElementById("id_docente").value);
      document.getElementById("id_nivel").value = docentes[i].id_nivel;
      document.getElementById("valor_nivel").value = docentes[i].valor;
      document.getElementById("designacao_nivel").value = docentes[i].designacao_nivel;
      break;
    }
  }
  removeElements();
}

function removeElements() {
  let items = document.querySelectorAll(".list-items");
  items.forEach(function (item) {
    item.remove();
  });
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
document.getElementById("ano_academico").addEventListener('change', (event) => {
    //console.log("val "+event.target.value)
//console.log(document.getElementById('curso').value);

    var ajax = new XMLHttpRequest();
    var method = "GET";
    var url = "disciplina-get-curso.php?ano="+event.target.value+"&id_curso="+document.getElementById('curso').value;
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
   
    
});
document.getElementById("submit").addEventListener('click', (event)=>{
console.log('ok');
   var horas_contacto = "";
   var semestre = "";
   var curso = "";
   var id_curso = "";
   var id_disciplina = "";
    for(var i=0; i<arrDisciplinas.length; i++){
        if(arrDisciplinas[i].codigo_disciplina == document.getElementById("disciplina").value){
            horas_contacto = arrDisciplinas[i].horas_contacto;
            semestre = arrDisciplinas[i].semestre;
            curso = arrDisciplinas[i].designacao;
            id_curso = arrDisciplinas[i].id_curso;
            id_disciplina = arrDisciplinas[i].codigo_disciplina;
            break;
        }
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "verificar_disciplina.php?id_curso="+id_curso+"&id_disciplina="+id_disciplina, true);
    xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            console.log(data);
            if(data == "existe"){
                alert("disciplina deste curso ja associada a um contrato")
            }else{
                var selectobject = document.getElementById("disciplina");
                var text= selectobject.options[selectobject.selectedIndex].text;
                var table = document.getElementById("tb-data");
                var row = table.insertRow(table.rows.length);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);

                
                cell1.innerHTML = text + '<input type="hidden" name="disciplina1[]" value="' + id_disciplina + '">';
                cell2.innerHTML = horas_contacto + '<input type="hidden" name="horas_contacto[]" value="' + horas_contacto + '">';
                cell3.innerHTML = curso + '<input type="hidden" name="curso1[]" value="' + id_curso + '">';
                cell4.innerHTML = document.getElementById("ano_academico").value + '<input type="hidden" name[]="ano" value="' + document.getElementById("ano_academico").value + '">';
                cell5.innerHTML = semestre + '<input type="hidden" name="semestre[]" value="' + semestre + '">';
                cell6.innerHTML = '<button type="hidden" id="'+id_disciplina+'" onclick="remover(this.id)">Remover</button>';
                document.getElementById("header").innerHTML = "Modulos Lecionados lecionados por "+document.getElementById("docente").value;
            }
        }
    }
    }
    xhr.send();
    

});


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
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "contracto-criar.php", true);
    xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            console.log(data);
        }
    }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

