<?php
session_start();

$perguntas = require __DIR__ . '/perguntas2fa.php';

if (
    !isset($_SESSION['pending_user_id'], $_SESSION['pending_question'], $_SESSION['pending_attempts'], $_SESSION['pending_csrf']) ||
    !isset($perguntas[$_SESSION['pending_question']])
) {
    header('Location: login.php');
    exit();
}

$pergunta = $perguntas[$_SESSION['pending_question']];
$erro = $_SESSION['erro_2fa'] ?? '';
unset($_SESSION['erro_2fa']);
$tentativasRestantes = max(0, 3 - (int) $_SESSION['pending_attempts']);
$mensagemEscapada = htmlspecialchars((string) $erro, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação em duas etapas</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main class="auth-card">
        <h1>Verificação em duas etapas</h1>
        <p class="challenge-intro">Para concluir o login, responda à pergunta de segurança:</p>
        <h2 class="challenge-question"><?= htmlspecialchars($pergunta['pergunta'], ENT_QUOTES, 'UTF-8') ?></h2>

        <?php if ($erro !== ''): ?>
            <p class="mensagem-erro" role="alert"><?= $mensagemEscapada ?></p>
        <?php endif; ?>

        <form action="verifica2fa.php" method="post">
            <label class="challenge-label" for="resposta">Resposta</label>
            <input
                id="resposta"
                name="resposta"
                type="<?= htmlspecialchars($pergunta['tipo'], ENT_QUOTES, 'UTF-8') ?>"
                <?= $pergunta['tipo'] === 'text' ? 'maxlength="120" autocomplete="off"' : '' ?>
                required
                autofocus
            >
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['pending_csrf'], ENT_QUOTES, 'UTF-8') ?>">
            <p class="attempts-info">Tentativas restantes: <?= $tentativasRestantes ?> de 3.</p>
            <button class="botao" type="submit">Enviar</button>
        </form>

        <p class="auth-links"><a href="sair.php">Cancelar e voltar ao login</a></p>
    </main>
</body>
</html>
