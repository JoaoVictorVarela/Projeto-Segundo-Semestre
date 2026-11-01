<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: pedidos.php');
    exit;
}

// Verifica a proteção do formulário.
$token = $_POST['csrf_token'] ?? '';

if (
    !is_string($token) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $token)
) {
    http_response_code(403);
    exit('Solicitação inválida. Atualize a página e tente novamente.');
}

// Valida o identificador do pedido.
$idRecebido = $_POST['pedido_id'] ?? '';

if (
    !is_scalar($idRecebido) ||
    filter_var($idRecebido, FILTER_VALIDATE_INT) === false ||
    (int)$idRecebido < 1
) {
    http_response_code(400);
    exit('Número de pedido inválido.');
}

$pedidoId = (int)$idRecebido;

try {

    // Conexão MySQLi.
    include_once('conexao.php');

    if ($con->connect_error) {
        throw new Exception('Erro na conexão com o banco.');
    }

    // Só atualiza pedidos que ainda estão pendentes.
    $stmt = $con->prepare(
        "UPDATE pedidos
         SET status = 'entregue'
         WHERE id = ? AND status = 'pendente'"
    );

    $stmt->bind_param("i", $pedidoId);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {

        // Confere se o pedido já existe.
        $verifica = $con->prepare(
            "SELECT status FROM pedidos WHERE id = ?"
        );

        $verifica->bind_param("i", $pedidoId);
        $verifica->execute();

        $resultado = $verifica->get_result();
        $pedido = $resultado->fetch_assoc();

        if (!$pedido) {
            http_response_code(404);
            exit('Pedido não encontrado.');
        }

        // Se já estava entregue, não precisa atualizar novamente.
    }

    header('Location: pedidos.php');
    exit;

} catch (Throwable $e) {

    error_log($e->getMessage());

    http_response_code(500);

    exit('Erro ao atualizar o pedido. Tente novamente.');
}