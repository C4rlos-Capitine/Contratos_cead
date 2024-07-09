document.addEventListener("DOMContentLoaded", function () {
    var ajax = new XMLHttpRequest();
    var method = "GET";
    var url = "contrato-get-count.php";
    var asynchronous = true;
    console.log("ola");
    ajax.open(method, url, asynchronous);
    ajax.send();
    ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        estatiscas = JSON.parse(this.responseText);
        console.log(estatiscas);
        document.getElementById("total-contratos").innerHTML = estatiscas.total;
        
    }
    };

});