    //document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".close-btn").addEventListener("click", function(){
        document.body.classList.remove("active-popup");
        
      });
  
      function loadDisciplinasAlocadas(id){
        console.log(id);
           $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        console.log("ola");
        //event.preventDefault(); // Prevent the form from being submitted traditionally
      
        console.log("ola");
        $.ajax({
          type: 'GET',
          url: '/cead2%20_deployed/docente/get_disciplinas',
          data: { id_docente: id },
          success: function (data) {
            console.log(data.response);
            var html = '<table id="tb-data" class="table table-striped"><tr><th>curso</th><th>modulo</th><th>ano</th></tr>';
                   
            data.response.forEach(function (item) {
              html += '<tr><td scope="col">' + item.designacao_curso + '</td><td scope="col">' + item.nome_disciplina + '</td><td scope="col">' + item.ano + '</td></tr>';
            });
            html += '</table>';
            document.querySelector(".popup").innerHTML = html;
            document.body.classList.add("active-popup");
          },
          
          error: function () {
            alert("error");
          }
        });
         

      }
//});    