<?php
session_start();

$perguntas = require __DIR__ . '/perguntas2fa.php';

function limparEtapaPendente(): void
{
    unset(
        $_SESSION['pending_user_id'],
        $_SESSION['pending_question'],
        $_SESSION['pending_attempts'],
        $_SESSION['pending_csrf'],
        $_SESSION['erro_2fa']
    );
}

function voltarAoLogin(string $mensagem): void
{
    limparEtapaPendente();
    unset($_SESSION['email'], $_SESSION['tipo_usuario'], $_SESSION['id_usuario'], $_SESSION['autenticado']);
    $_SESSION['erro_login'] = $mensagem;
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: verificacao2fa.php');
    exit();
}

$chavePergunta = $_SESSION['pending_question'] ?? '';
$csrfSessao = $_SESSION['pending_csrf'] ?? '';
$csrfRecebido = $_POST['csrf_token'] ?? '';

if (
    !isset($_SESSION['pending_user_id'], $_SESSION['pending_attempts']) ||
    !isset($perguntas[$chavePergunta]) ||
    !is_string($csrfRecebido) ||
    !is_string($csrfSessao) ||
    $csrfSessao === '' ||
    !hash_equals($csrfSessao, $csrfRecebido)
) {
    voltarAoLogin('A verificação expirou. Faça login novamente.');
}

$resposta = trim((string) ($_POST['resposta'] ?? ''));
if ($resposta === '' || strlen($resposta) > 120) {
    $resposta = '';
}

require '../conexao.php';
if (!isset($con) || $con->connect_error) {
    voltarAoLogin('Não foi possível concluir a verificação. Faça login novamente.');
}

$idUsuario = (int) $_SESSION['pending_user_id'];
$stmt = $con->prepare('SELECT id, nome, email, tipo_usuario, nome_materno, data_nascimento, cep FROM usuarios WHERE id = ? LIMIT 1');

if (!$stmt) {
    voltarAoLogin('Não foi possível concluir a verificação. Faça login novamente.');
}
$stmt->bind_param('i', $idUsuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado ? $resultado->fetch_assoc() : null;
$stmt->close();

if (!$usuario) {
    voltarAoLogin('Não foi possível concluir a verificação. Faça login novamente.');
}

$campo = $perguntas[$chavePergunta]['campo'];
$respostaCorreta = false;
$valorSalvo = (string) ($usuario[$campo] ?? '');

if ($resposta !== '') {
    if ($chavePergunta === 'nome_materno') {
        $normalizar = static function (string $valor): string {
            $valor = preg_replace('/\s+/u', ' ', trim($valor)) ?? trim($valor);
            return function_exists('mb_strtolower')
                ? mb_strtolower($valor, 'UTF-8')
                : strtolower($valor);
        };
        $respostaCorreta = hash_equals($normalizar($valorSalvo), $normalizar($resposta));
    } elseif ($chavePergunta === 'data_nascimento') {
        $data = DateTime::createFromFormat('!Y-m-d', $resposta);
        $formatoValido = $data !== false && $data->format('Y-m-d') === $resposta;
        $respostaCorreta = $formatoValido && hash_equals($valorSalvo, $resposta);
    } elseif ($chavePergunta === 'cep') {
        $cepSalvo = preg_replace('/\D+/', '', $valorSalvo) ?? '';
        $cepInformado = preg_replace('/\D+/', '', $resposta) ?? '';
        $respostaCorreta = $cepInformado !== '' && hash_equals($cepSalvo, $cepInformado);
    }
}

if (!$respostaCorreta) {
    $_SESSION['pending_attempts'] = (int) $_SESSION['pending_attempts'] + 1;

    if ($_SESSION['pending_attempts'] >= 3) {
        voltarAoLogin('3 tentativas sem sucesso! Favor realizar login novamente.');
    }

    $restantes = 3 - (int) $_SESSION['pending_attempts'];
    $_SESSION['erro_2fa'] = 'Resposta incorreta. Tentativas restantes: ' . $restantes . '.';
    header('Location: verificacao2fa.php');
    exit();
}

// Só estabelece a sessão autenticada depois da resposta correta.
session_regenerate_id(true);
$_SESSION['autenticado'] = true;
$_SESSION['id_usuario'] = (int) $usuario['id'];
$_SESSION['email'] = $usuario['email'];
$_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
$_SESSION['nome'] = $usuario['nome'];
limparEtapaPendente();

header('Location: ../index.php');
exit();
