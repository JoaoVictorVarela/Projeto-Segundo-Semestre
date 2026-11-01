<?php
session_start();

if (empty($_SESSION['autenticado']) || ($_SESSION['tipo_usuario'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: usuarios.php');
    exit();
}

require __DIR__ . '/conexao.php';
if (!isset($con) || $con->connect_error) {
    header('Location: usuarios.php');
    exit();
}

$stmt = $con->prepare("DELETE FROM usuarios WHERE id = ? AND tipo_usuario <> 'admin'");
if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

header('Location: usuarios.php');
exit();
