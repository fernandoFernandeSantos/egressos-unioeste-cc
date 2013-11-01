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
    }else{
      if(x.elements[1].value.lenght>1){
            alert("Erro tamanho da palavra");
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

    } else {
        if (x.elements[2] === "Selecione" && x.elements[3] === "")
        {
            alert("selecione um instituicao");
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
        alert("Selecione Alguma coisa para remover");
    }

}


