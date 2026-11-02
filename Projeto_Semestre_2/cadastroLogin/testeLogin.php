<?php
session_start();

function limparEtapaPendenteLogin(): void
{
    unset(
        $_SESSION['pending_user_id'],
        $_SESSION['pending_question'],
        $_SESSION['pending_attempts'],
        $_SESSION['pending_csrf'],
        $_SESSION['erro_2fa']
    );
}

function falharLogin(string $mensagem): void
{
    limparEtapaPendenteLogin();
    unset($_SESSION['email'], $_SESSION['tipo_usuario'], $_SESSION['id_usuario'], $_SESSION['autenticado'], $_SESSION['nome']);
    $_SESSION['erro_login'] = $mensagem;
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit();
}

// Remove qualquer autenticação anterior antes de iniciar um novo fluxo.
unset($_SESSION['email'], $_SESSION['tipo_usuario'], $_SESSION['id_usuario'], $_SESSION['autenticado']);
limparEtapaPendenteLogin();

$email = trim((string) ($_POST['email'] ?? ''));
$senha = (string) ($_POST['senha'] ?? '');
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $senha === '') {
    falharLogin('Email ou senha incorretos.');
}

// TALVEZ DE ERRO AQUI (testar)
require '../conexao.php';
if (!isset($con) || $con->connect_error) {
    falharLogin('Não foi possível realizar o login agora. Tente novamente.');
}

$stmt = $con->prepare('SELECT id, email, tipo_usuario, senha FROM usuarios WHERE email = ? LIMIT 1');
if (!$stmt) {
    falharLogin('Não foi possível realizar o login agora. Tente novamente.');
}
$stmt->bind_param('s', $email);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado ? $resultado->fetch_assoc() : null;
$stmt->close();

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    falharLogin('Email ou senha incorretos.');
}

$perguntas = require __DIR__ . '/perguntas2fa.php';
$chaves = array_keys($perguntas);
$chavePergunta = $chaves[random_int(0, count($chaves) - 1)];

// A conta fica pendente: ainda não define email/autenticado na sessão.
$_SESSION['pending_user_id'] = (int) $usuario['id'];
$_SESSION['pending_question'] = $chavePergunta;
$_SESSION['pending_attempts'] = 0;
$_SESSION['pending_csrf'] = bin2hex(random_bytes(32));
unset($_SESSION['erro_login']);

header('Location: verificacao2fa.php');
exit();

?>