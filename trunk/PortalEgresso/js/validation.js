/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function loginValidation(session){
//    var user = document.getElementById("user").value;
    //document.write("user");
    
    var x = document.forms["form_validation"]["user"].value;
    var y = document.forms["form_validation"]["senha"].value;
    
                if (x == null || x == "")
                {
                    alert("Usuario não Inserido!");
                    return false;
                }
                else{
                    alert("Nome ou usuário Inválido!");
                }
                
}

function loginValidation2(check){
    alert(check);
}
