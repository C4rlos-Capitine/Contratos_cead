
function verDisciplinas(id){
    //window.location.href = "docente-ver-disciplinas.php?id_docente="+id;
    console.log(id);
    var ajax = new XMLHttpRequest();
    var method = "GET";
    var url = "get-disciplina-contrato?id_docente="+id;
    var asynchronous = true;
    ajax.open(method, url, asynchronous); 
    ajax.send();
    ajax.onreadystatechange = function(){
  
        if(this.readyState == 4 && this.status == 200){
            var disciplina = JSON.parse(this.responseText);
            console.log(disciplina);
        
            //select = document.getElementById("trabalho");
            var html = "";
            for(var a = 0; a< disciplina.length; a++){
                
                  html += "<tr><td>"+disciplina[a].ano_academico+"</td><td>"+disciplina[a].designacao+"</td><td>"+disciplina[a].nome_disciplina+"</td><td>"+disciplina[a].horas_contacto+"</td><td>"+disciplina[a].ano_academico+"</td><td>"+disciplina[a].semestre+"</td></tr>"
              }
             //var main =  document.querySelector(".main")
              document.getElementById("nome").innerHTML = "<label>Disciplinas lecionadas por "+disciplina[0].nome+"</label>";
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

  function ver_contrato(){

    var ajax = new XMLHttpRequest();
    var method = "GET";
    var url = "get-contrato.php?ano="+document.getElementById("ano").value;
    var asynchronous = true;
    ajax.open(method, url, asynchronous); 
    ajax.send();
    ajax.onreadystatechange = function(){

        if(this.readyState == 4 && this.status == 200){
            var contracto = JSON.parse(this.responseText);
            console.log(contracto);
        
            //select = document.getElementById("trabalho");
            var html = '';
            for(var i = 0; i< contracto.length; i++){      
					    html += '<tr><td>'+contracto[i].nome+' '+contracto[i].apelido+'</td><td>'+contracto[i].total_horas_contacto+'</td><td>'+contracto[i].data+'</td><td>'+contracto[i].ano+'</td><td>'+contracto[i].remuneracao_total+'</td><td><button type="button" id="'+contracto[i].id_docente+'" onclick="verDisciplinas(this.id)" class="btn btn-primary btn-sm">Ver disciplinas</button><button type="button" id="'+contracto[i].id_docente+'" onclick="gerarPDF(this.id)" class="btn btn-primary btn-sm">gerar pdf</button></td></tr>';
            }
        
            document.getElementById("tb-data").innerHTML = html;
            document.getElementById("header-table").innerHTML = "Contratos de "+document.getElementById("ano").value;
            //document.body.classList.add("active-popup");
            }else{
                console.log("erro");
            }
    }
    
  }

  function gerarPDF(id_docente){
    console.log(document.getElementById("ano").value);
    if(document.getElementById("ano").value != ""){ 
      location.href = "contrato-ficheiro.php?id_docente="+id_docente+"&ano="+document.getElementById("ano").value;
    }else{
      alert("O campo do ano está vazio");
    }
  }

  