
// ===============================
// CONFIGURAÇÃO DO TEMA
// ===============================

// Recupera o tema salvo no navegador.
// Se não existir nenhum tema salvo,
// utiliza o tema escuro como padrão.

let temaAtual = localStorage.getItem("tema") || "escuro";


// ===============================
// ELEMENTOS DA PÁGINA
// ===============================

const corpo = document.body;
const botaoTema = document.getElementById("btnTema");


// ===============================
// FUNÇÃO PARA APLICAR O TEMA
// ===============================

function aplicarTema(tema) {

    // Verifica se o tema escolhido é claro.
    // Se for, adiciona a classe tema-claro.
    // Caso contrário, remove essa classe.

    corpo.classList.toggle("tema-claro", tema === "claro");


    // Atualiza o texto do botão.

    if (tema === "claro") {

        botaoTema.textContent = "Tema claro";
        botaoTema.title = "Ativar tema escuro";

    } else {

        botaoTema.textContent = "Tema escuro";
        botaoTema.title = "Ativar tema claro";

    }
}


// ===============================
// APLICA O TEMA AO ABRIR A PÁGINA
// ===============================

aplicarTema(temaAtual);


// ===============================
// CLIQUE NO BOTÃO
// Quando o botão for clicado vai mudar o tema
// ===============================

botaoTema.addEventListener("click", function() {

    // Alterna entre claro e escuro.

    if (temaAtual === "escuro") {

        temaAtual = "claro";

    } else {

        temaAtual = "escuro";

    }


    // Salva a escolha do usuário.

    localStorage.setItem("tema", temaAtual);


    // Aplica o novo tema.

    aplicarTema(temaAtual);

});
