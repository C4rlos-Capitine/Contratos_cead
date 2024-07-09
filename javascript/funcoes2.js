var input;
var input2;
var cursos = []; // Global variable
var disciplinas = [];
var arrCursos = [];
var arrDisciplinas = [];
var sortedCursos = [];
var sortedDisciplinas = [];

input = document.getElementById("curso");
input2 = document.getElementById("disciplina");

function getCurso(callback) {
  $.ajax({
    type: "GET",
    url: "/cead_template2/curso/get",
    dataType: "json",
    success: function (dados) {
      cursos = dados;
      callback();
    },
    error: function () {
      console.log("Error fetching cursos");
    }
  });
}

function imprimirCursos() {
  arrCursos = cursos.map(curso => curso.designacao_curso);
  sortedCursos = arrCursos.sort();
}

function getDisciplina(callback) {
  $.ajax({
    type: "GET",
    url: "/cead_template2/disciplina/get_disciplinas_only",
    dataType: "json",
    success: function (data) {
      disciplinas = data;
      callback();
    },
    error: function () {
      console.log("Error fetching disciplinas");
    }
  });
}

function imprimeDisciplinas() {
  arrDisciplinas = disciplinas.map(disciplina => disciplina.nome_disciplina);
  sortedDisciplinas = arrDisciplinas.sort();
}

function displayNames(value, inputElement) {
  inputElement.value = value;
  removeElements();
}

function displayNames2(value, inputElement) {
  inputElement.value = value;
  removeElements2();
}

function removeElements() {
  let items = document.querySelectorAll(".list-items");
  items.forEach(item => {
    item.remove();
  });
}

function removeElements2() {
  let items = document.querySelectorAll(".list-items2");
  items.forEach(item => {
    item.remove();
  });
}

function validarForm() {
  var nome_curso = document.getElementById("curso").value;
  var nome_disciplina = document.getElementById("disciplina").value;

  cursos.forEach(curso => {
    if (curso.designacao_curso === nome_curso) {
      document.getElementById("id_curso").value = curso.id_curso;
      console.log("Found curso ID: " + curso.id_curso);
      return;
    }
  });

  disciplinas.forEach(disciplina => {
    if (disciplina.nome_disciplina === nome_disciplina) {
      document.getElementById("codigo_disciplina").value = disciplina.codigo_disciplina;
      console.log("Found disciplina code: " + disciplina.codigo_disciplina);
      return;
    }
  });

  $.ajax({
    type: 'POST',
    url: '/cead_template2/disciplina/associar_save',
    data: $('#associar').serialize(),
    success: function (data) {
      console.log(data.response);
      $('#feedback').html('<div class="alert alert-success">' + data.response + '</div>');
      $('#feedback').delay(5000).hide(0);
      $('#faculdade-reg')[0].reset();
    },
    error: function () {
      alert("Error while saving data");
    }
  });
}

function checkDisciplina(inputElement) {
  removeElements2();
  let inputValue = inputElement.value.toLowerCase();
  for (let i of sortedDisciplinas) {
    if (i.toLowerCase().startsWith(inputValue) && inputValue !== "") {
      let listItem2 = document.createElement("li");
      listItem2.classList.add("list-items2");
      listItem2.style.cursor = "pointer";
      listItem2.onclick = () => {
        console.log(i);
        inputElement.value = i;
        removeElements2();
      }
      let word = "<b>" + i.substr(0, inputValue.length) + "</b>";
      word += i.substr(inputValue.length);
      listItem2.innerHTML = word;
      document.querySelector(".list2").appendChild(listItem2);
    }
  }
}

function checkCurso(inputElement) {
  removeElements();
  let inputValue = inputElement.value.toLowerCase();
  for (let i of sortedCursos) {
    if (i.toLowerCase().startsWith(inputValue) && inputValue !== "") {
      let listItem = document.createElement("li");
      listItem.classList.add("list-items");
      listItem.style.cursor = "pointer";
      listItem.onclick = () => {
        console.log(i);
        inputElement.value = i;
        removeElements();
      }
      let word = "<b>" + i.substr(0, inputValue.length) + "</b>";
      word += i.substr(inputValue.length);
      listItem.innerHTML = word;
      document.querySelector(".list").appendChild(listItem);
    }
  }
}

getCurso(imprimirCursos);
getDisciplina(imprimeDisciplinas);

input.addEventListener('input', () => checkCurso(input));
input2.addEventListener('input', () => checkDisciplina(input2));
