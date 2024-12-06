function verificar(input){
    //console.log(input);
    
    console.log(input.value);
    if(input.value.length < 13){
        
        return {
            "msg": "faltam "+(13-input.value.length)+" caracteres",
            "status":"0",
            "color":"red"
        }
    }else if(input.value.length > 13){
        return {
            "msg": "excesso "+(input.value.length-13)+" caracteres",
            "status":"0",
            "color":"red"
        }
    }else{
        return {
            "msg": "13/13 certo",
            "status":"1",
            "color":"green"
        }
    }
}

function verificar_nuit(input){
    console.log(input.value);
    if(input.value.length < 8){
        
        return {
            "msg": "faltam "+(8-input.value.length)+" caracteres",
            "status":"0",
            "color":"red"
        }
    }else if(input.value.length > 8){
        return {
            "msg": "excesso "+(input.value.length-8)+" caracteres",
            "status":"0",
            "color":"red"
        }
    }else{
        return {
            "msg": "8/8 certo",
            "status":"1",
            "color":"green"
        }
    }
}

function verifica_digitos(input){
    
    var count_none_int = 0;
    var last_caracter;
    for (var i = 0; i < input.length; i++) {
        //console.log(input[i]);
        if(!isNaN(parseFloat(input[i]))){
            count_none_int++;
        }
        last_caracter = input[i];
    }

    return {
        "tamanho":input.length,
        "nr_chars":(input.length - count_none_int),
        "last_char":last_caracter
    }

}

var mensagens = {
    "caracteres_invalidos_bi": "Caracteres inválidos para BI",
    "caracteres_invalidos_nuit": "Caracteres inválidos para nuit, insira 8 números",
    "ultimo_carater_error_bi": "O ultimo caractere deve ser uma letra"
}
