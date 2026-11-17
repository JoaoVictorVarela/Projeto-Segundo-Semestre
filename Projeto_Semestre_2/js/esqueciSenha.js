function mudarSenha(event) {

    // Impede o envio automático do formulário
    event.preventDefault();

    // Referência ao formulário
    const formulario =
        document.getElementById('formulario');

    // =========================
    // PEGA OS VALORES
    // =========================

    const senha =
        document.getElementById('senha').value;

    const senha2 =
        document.getElementById('senha2').value;

   
    // =========================
    // MENSAGENS DE ERRO
    // =========================

    const erroSenha =
        document.getElementById('erro-senha');


    // Limpa mensagens antigas
    erroSenha.textContent = "";
    
    // =========================
    // VALIDAÇÃO DOS CAMPOS HTML
    // =========================

    if (!formulario.checkValidity()) {

        formulario.reportValidity();

        return;
    }

    // =========================
    // VALIDAÇÃO SENHAS
    // =========================

    if (senha !== senha2) {

        erroSenha.textContent =
            "As senhas precisam ser iguais!";
        return;
    }else{
        formulario.submit();
    }

    // =========================================
    // ENVIA OS DADOS PARA banco.php
    // =========================================

    formulario.submit();
}