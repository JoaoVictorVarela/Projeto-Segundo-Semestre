function mudarSenha(event){

event.preventDefault();

let formulario = document.getElementById('formulario')

let senha = document.getElementById('senha')
let senha2 = document.getElementById('senha2')

let erroSenha = document.getElementById('erroSenha')

if (senha !== senha2) {

        erroSenha.textContent =
            "As senhas precisam ser iguais!";

        return;
}

formulario.submit()
}
