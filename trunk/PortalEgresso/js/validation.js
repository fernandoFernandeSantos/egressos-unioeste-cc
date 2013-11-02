/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function loginValidation(session) {
//    var user = document.getElementById("user").value;
    //document.write("user");

    var x = document.forms["form_validation"]["user"].value;
    var y = document.forms["form_validation"]["senha"].value;

    if (x == null || x == "")
    {
        alert("Usuario não Inserido!");
        return false;
    }

}

function loginValidation2(check) {
    alert(check);
}


function perfilValidation(v) {

    var x = document.forms["form_open_alterar"];

    if (x.elements[0].value == "" || x.elements[0].value == null) {
        alert("Nome Invalido");
        return false;
    }else{
        var y = new String(x.elements[1].value);
        var z = new String(x.elements[4].value);
      if(y.length>1 || z.length>2){
            alert("Erro tamanho da palavra");
            return false;
        }
    }
}

function trabalhoValidation(v) {

    var x = document.forms["form_alterar_trabalha"];
    var y = document.forms["form_alterar_trabalha"][2];
//    for (var i = 0; i < x.length; i++)
//    {
//        document.write(x.elements[i].value);
//        document.write("<br>");
//    }
    if ((x.elements[1].value == "" || x.elements[1].value == null) && x.elements[1].value === "Selecione") {
        alert("Preencha o campo corretamente");
        return false;
    }
}

function especializacaoValidation(v) {

    var x = document.forms["form_adicionar_especializacao_open"];

//    for (var i = 0; i < x.length; i++)
//    {
//        document.write(x.elements[i].value);
//        document.write("<br>");
//    }

    if (x.elements[0].value === "" || x.elements[1].value === ""
            || x.elements[4].value === "" || x.elements[5].value === "") {



        alert("Nome Invalido");
        return false;
    } else {
        if (x.elements[2] === "Selecione" && x.elements[3] === "")
        {
            alert("selecione uma instituicao");
            return false;
        }
    }
}


function registerValidation() {
    var x = document.forms["form_open_registrar"];

//    for (var i = 0; i < x.length; i++)
//    {
//        document.write(x.elements[i].value);
//        document.write("<br>");
//    }
    if (x.elements[0].value === "" || x.elements[1].value === "" || x.elements[2].value === ""
            || x.elements[3].value === "") {
        alert("Preencha todos os campos");
        return false;
    }

}


function removerEspecializacao() {

    var x = document.forms["form_remover_especializacao_open"];

//    for (var i = 0; i < x.length; i++)
//    {
//        document.write(x.elements[i].value);
//        document.write("<br>");
//    }

    if (x.elements[0].value === "Selecione") {
        alert("Selecione uma especialização para remover");
        return false;
    }

}


