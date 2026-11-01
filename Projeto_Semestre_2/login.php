<?php
session_start();

if (!empty($_SESSION['autenticado'])) {
    header('Location: index.php');
    exit();
}

$erro = $_SESSION['erro_login'] ?? '';
unset($_SESSION['erro_login']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main class="auth-card">
        <h1>Tela de Login</h1>

        <?php if ($erro !== ''): ?>
            <p id="mensagem-geral-login" class="mensagem-erro" role="alert"><?= htmlspecialchars((string) $erro, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form action="testeLogin.php" method="post">
            <label for="loginEmail"><h2>Email</h2></label>
            <input name="email" id="loginEmail" type="email" autocomplete="username" placeholder="Digite seu email" required>

            <label for="loginSenha"><h2>Senha</h2></label>
            <input name="senha" id="loginSenha" type="password" autocomplete="current-password" placeholder="Digite sua senha" required>

            <button class="botao" type="reset">Limpar tela</button>
            <button class="botao" type="submit">Logar</button>
        </form>

        <p>Não possui login? <a href="cadastro.php">Clique aqui</a></p>
        <p>Esqueceu a senha? <a href="esqueciSenha.php">Clique aqui</a></p>
    </main>
</body>
</html>
