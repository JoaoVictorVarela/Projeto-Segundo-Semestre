<?php
session_start();

$erro = $_SESSION['erro_login'] ?? '';
unset($_SESSION['erro_login']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/tema.css">
    <title>Mudar Senha</title>
</head>

<body>
    <a id="btn-home" href="../index.php" aria-label="Voltar para a página inicial">Home</a>

    <div class="mudarSenha">
    <h1>Mudança de senha</h1>
    <form id="formulario" action="cadastraNovaSenha.php" method='post' onsubmit="mudarSenha(event)">
        <input type="email" name="email" placeholder="Digite seu email" required><br><br>

        <input id="CPF" type="text" name="cpf" placeholder="Digite seu CPF" required><br><br>

        <input id="CEP" type="text" name="cep" placeholder="Digite seu CEP" required><br><br>

        <label for="data">Insira sua data de nascimento</label><br>

        <input type="date" id="data" name="data_nascimento" required><br><br>

        <input type="text" name="nome_materno" placeholder="Digite o nome da sua mãe" required><br><br>

        <input id="senha" minlength="8" type="password" name="senha" placeholder="Digite sua nova senha" required><br><br>

        <input id="senha2" minlength="8" type="password" name="senha_conf" placeholder="Confirme sua nova senha" required><br><br>
        <p id=erro-senha></p>

        <input type="submit" value="Enviar">

        <p>Login<a href="Login.php"> Clique aqui</a>
        <button id="btnTema" type="button" title="Mudar Tema">
            Tema
        </button>
    </form>

      <?php if ($erro !== ''): ?>
            <p id="mensagem-geral-login" class="mensagem-erro" role="alert"><?= htmlspecialchars((string) $erro, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

    <div>
</body>



<!--Script da submascara-->
<script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>

<!--Script da submascara-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--Script da submascara-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
    integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="../js/mascaras.js"></script>
<script src="../js/esqueciSenha.js"></script>

<script src="../js/tema.js"></script>


</html>
