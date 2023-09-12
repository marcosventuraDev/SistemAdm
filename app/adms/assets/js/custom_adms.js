
const formNewUser = document.getElementById("form-new-user");

if(formNewUser){

    formNewUser.addEventListener("submit", async(e)=>{
           
        document.getElementById("msg").innerHTML = "<p style='color:green'>Acessou!</p>"


        var name = document.querySelector('#name').value;
        var email = document.querySelector('#email').value;
        var password = document.querySelector('#password').value;

        if(name === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo nome!</p>"
            return
        }
        if(email === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo E-mail!</p>"
            return
        }
        if(password === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo Password!</p>"
            return
        }
    });
}

const formLorgin = document.getElementById("form-login");
if(formLorgin){

    formLorgin.addEventListener("submit", async(e)=>{
        e.preventDefault();
    
        document.getElementById("msg").innerHTML = "<p style='color:green'>Acessou!</p>"

        
    
        var user = document.querySelector('#user').value;
        var password = document.querySelector('#password').value;
        if(user === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo E-mail!</p>"
            return
        }
        if(password === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo password!</p>"
            return
        }
    });
}

