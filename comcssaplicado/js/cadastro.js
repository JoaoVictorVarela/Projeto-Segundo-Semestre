// =========================
// FUNÇÃO DE VALIDAR CEP
// =========================
async function validarCEP() {

    const cep =
        document.getElementById("CEP")
            .value.replace(/\D/g, "");

    const erroCEP =
        document.getElementById("erro-cep");

    // Limpa mensagem antiga
    erroCEP.textContent = "";

    // Verifica tamanho
    if (cep.length !== 8) {

        erroCEP.textContent =
            "CEP inválido!";

        limparCamposCEP();

        return false;
    }

    try {

        const resposta =
            await fetch(`https://viacep.com.br/ws/${cep}/json/`);

        const dados =
            await resposta.json();

        // CEP não encontrado
        if (dados.erro) {

            erroCEP.textContent =
                "CEP não encontrado!";

            limparCamposCEP();

            return false;

        } else {

            // =========================
            // PREENCHE OS CAMPOS
            // =========================

            document.getElementById("logradouro").value =
                dados.logradouro;

            document.getElementById("bairro").value =
                dados.bairro;

            document.getElementById("cidade").value =
                dados.localidade;

            document.getElementById("estado").value =
                dados.uf;

            return true;
        }

    } catch {

        erroCEP.textContent =
            "Erro ao validar CEP!";

        limparCamposCEP();

        return false;
    }
}


// =========================
// LIMPAR CAMPOS DO CEP
// =========================
function limparCamposCEP() {

    document.getElementById("logradouro").value = "";
    document.getElementById("bairro").value = "";
    document.getElementById("cidade").value = "";
    document.getElementById("estado").value = "";
}


// =========================
// FUNÇÃO DE CADASTRO
// =========================
async function cadastrar(event) {

    // Impede o envio automático do formulário
    event.preventDefault();

    // Referência ao formulário
    const formulario =
        document.getElementById('formulario');

    // =========================
    // PEGA OS VALORES
    // =========================

    const email =
        document.getElementById('email').value;

    const senha =
        document.getElementById('senha').value;

    const senha2 =
        document.getElementById('senha2').value;

    const cpf =
        document.getElementById('CPF').value;

    const celular =
        document.getElementById('celular').value;

    const telefone =
        document.getElementById('telefone').value;


    // =========================
    // MENSAGENS DE ERRO
    // =========================

    const erroCPF =
        document.getElementById('erro-cpf');

    const erroSenha =
        document.getElementById('erro-senha');

    const erroCelular =
        document.getElementById('erro-celular');

    const erroTelefone =
        document.getElementById('erro-telefone');

    const mensagemGeral =
        document.getElementById('mensagem-geral');


    // Limpa mensagens antigas
    erroCPF.textContent = "";
    erroSenha.textContent = "";
    erroCelular.textContent = "";
    erroTelefone.textContent = "";

    mensagemGeral.textContent = "";
    mensagemGeral.className = "";


    // =========================
    // VALIDAÇÃO DOS CAMPOS HTML
    // =========================

    if (!formulario.checkValidity()) {

        formulario.reportValidity();

        return;
    }


    // =========================
    // VALIDAÇÃO CEP
    // =========================

    const cepValido =
        await validarCEP();

    if (!cepValido) {

        mensagemGeral.textContent =
            "Corrija os campos destacados.";

        mensagemGeral.className =
            "mensagem-erro";

        return;
    }


    // =========================
    // VALIDAÇÃO CPF
    // =========================

    if (!validaCPF(cpf)) {

        erroCPF.textContent =
            "CPF inválido!";

        mensagemGeral.textContent =
            "Corrija os campos destacados.";

        mensagemGeral.className =
            "mensagem-erro";

        return;
    }


    // =========================
    // VALIDAÇÃO CELULAR
    // =========================

    if (celular.length != 16) {

        erroCelular.textContent =
            "Insira um número válido!";

        mensagemGeral.textContent =
            "Corrija os campos destacados.";

        mensagemGeral.className =
            "mensagem-erro";

        return;
    }


    // =========================
    // VALIDAÇÃO TELEFONE
    // =========================

    if (telefone.length != 16) {

        erroTelefone.textContent =
            "Insira um número válido!";

        mensagemGeral.textContent =
            "Corrija os campos destacados.";

        mensagemGeral.className =
            "mensagem-erro";

        return;
    }


    // =========================
    // VALIDAÇÃO SENHAS
    // =========================

    if (senha !== senha2) {

        erroSenha.textContent =
            "As senhas precisam ser iguais!";

        mensagemGeral.textContent =
            "Corrija os campos destacados.";

        mensagemGeral.className =
            "mensagem-erro";

        return;
    }


    // =========================================
    // TODAS AS VALIDAÇÕES FORAM APROVADAS
    // =========================================

    mensagemGeral.textContent =
        "Cadastro realizado com sucesso!";

    mensagemGeral.className =
        "mensagem-sucesso";


    // =========================================
    // ENVIA OS DADOS PARA banco.php
    // =========================================

    formulario.submit();
}


// =========================
// FUNÇÃO VALIDAR CPF
// =========================
function validaCPF(cpf) {

    cpf =
        String(cpf).replace(/\D/g, '');

    // CPF precisa ter 11 números
    if (cpf.length !== 11) {

        return false;
    }

    // Impede CPFs com todos os números iguais
    if (/^(\d)\1{10}$/.test(cpf)) {

        return false;
    }


    // =========================
    // CALCULA DÍGITO
    // =========================
    function calculaDigito(cpfParcial) {

        let soma = 0;

        for (let i = 0; i < cpfParcial.length; i++) {

            soma +=
                Number(cpfParcial.charAt(i))
                *
                ((cpfParcial.length + 1) - i);
        }

        let resto =
            soma % 11;

        return resto < 2
            ? 0
            : 11 - resto;
    }


    // Calcula primeiro dígito
    const digito1 =
        calculaDigito(
            cpf.substring(0, 9)
        );


    // Calcula segundo dígito
    const digito2 =
        calculaDigito(
            cpf.substring(0, 9) + digito1
        );


    // Monta CPF calculado
    const cpfFinal =
        cpf.substring(0, 9)
        + digito1
        + digito2;


    // Compara com CPF informado
    return cpf === cpfFinal;
}


// =========================
// EVENTO AUTOMÁTICO DO CEP
// =========================
document.getElementById("CEP")
    .addEventListener(
        "blur",
        validarCEP
    );

