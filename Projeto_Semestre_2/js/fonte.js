
// =====================================
// CONTROLE DE TAMANHO DA FONTE
// =====================================

const fontePadrao = 16;
const fonteMinima = 12;
const fonteMaxima = 26;

// Recupera o tamanho salvo
let tamanhoFonte = Number(localStorage.getItem("fonte")) || fontePadrao;

// Garante que o valor esteja dentro dos limites
tamanhoFonte = Math.min(
    fonteMaxima,
    Math.max(fonteMinima, tamanhoFonte)
);

// Elementos de texto que terão o tamanho ajustado
const elementosTexto = [
    "h1", "h2", "h3", "h4", "h5", "h6",
    "p", "a", "span", "li", "label",
    "button", "small", "strong", "em",
    ".logo", ".preco", ".estrelas"
];

// Aguarda o carregamento do HTML
function iniciarControleFonte() {

    const raiz = document.documentElement;

    // Guarda o tamanho original de cada elemento
    const elementos = document.querySelectorAll(
        elementosTexto.join(",")
    );

    const tamanhosOriginais = new Map();

    elementos.forEach(elemento => {

        // Não altera os próprios controles de acessibilidade
        if (elemento.closest(".controles")) {
            return;
        }

        const tamanhoOriginal = parseFloat(
            window.getComputedStyle(elemento).fontSize
        );

        tamanhosOriginais.set(elemento, tamanhoOriginal);

    });

    // Atualiza os tamanhos
    function atualizarFonte() {

        const escala = tamanhoFonte / fontePadrao;

        // Atualiza a variável CSS
        raiz.style.setProperty(
            "--tamanho-base",
            `${tamanhoFonte}px`
        );

        // Aplica a escala diretamente nos textos
        tamanhosOriginais.forEach((tamanhoOriginal, elemento) => {

            elemento.style.fontSize =
                `${tamanhoOriginal * escala}px`;

        });

        // Salva a preferência
        localStorage.setItem("fonte", tamanhoFonte);

    }

    // Botão aumentar
    const botaoAumentar = document.getElementById("aumentar");

    if (botaoAumentar) {
        botaoAumentar.addEventListener("click", function () {

            if (tamanhoFonte < fonteMaxima) {
                tamanhoFonte = Math.min(
                    tamanhoFonte + 2,
                    fonteMaxima
                );

                atualizarFonte();
            }

        });
    }

    // Botão diminuir
    const botaoDiminuir = document.getElementById("diminuir");

    if (botaoDiminuir) {
        botaoDiminuir.addEventListener("click", function () {

            if (tamanhoFonte > fonteMinima) {
                tamanhoFonte = Math.max(
                    tamanhoFonte - 2,
                    fonteMinima
                );

                atualizarFonte();
            }

        });
    }

    // Botão resetar
    const botaoResetar = document.getElementById("resetar");

    if (botaoResetar) {
        botaoResetar.addEventListener("click", function () {

            tamanhoFonte = fontePadrao;
            atualizarFonte();

        });
    }

    // Aplica a configuração salva ao abrir a página
    atualizarFonte();

}

// Inicialização segura
if (document.readyState === "loading") {

    document.addEventListener(
        "DOMContentLoaded",
        iniciarControleFonte
    );

} else {

    iniciarControleFonte();

}
