
//validação de cadastro de usuário
const formNewUser = document.getElementById("form-new-user");

if (formNewUser) {

    //quando for submetido à um evento o formulario de id form-new-user
    formNewUser.addEventListener("submit", async (e) => {

        //recebe os valores das variáveis no campos correspondente ao ID
        var name = document.querySelector('#name').value;
        var email = document.querySelector('#email').value;
        var password = document.querySelector('#password').value;

        //verifica se o campo name está vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo nome!</p>"
            return
        }
        //verifica se o campo email está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo E-mail!</p>"
            return
        }
        //verifica se o campo password está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo Password!</p>"
            return
        }
        //a senha deve conter 6 ou mais caractéres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: A senha deve ter no mínimo 6 caracteres</p>"
            return
        }
        // a senha não pode ter números repetidos
        if (password.match(/([(1-9)]+)\1{2,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: A senha possui muitos números sequenciais repetidos</p>"
            return
        }

        //verifica se o campo senha não possui letras
        if (!password.match(/[(A-Za-z)]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: A senha deve ter pelo menos 1 letra</p>"
            return
        }

    });
}

//Validação do login
const formLorgin = document.getElementById("form-login");
if (formLorgin) {

    formLorgin.addEventListener("submit", async (e) => {
        e.preventDefault();

        var user = document.querySelector('#user').value;
        var password = document.querySelector('#password').value;
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo E-mail!</p>"
            return
        }
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color:red'>Erro: Necessário Preencher o campo password!</p>"
            return
        }
    });
}

