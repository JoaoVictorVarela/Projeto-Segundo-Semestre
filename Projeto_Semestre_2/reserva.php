<?php
session_start();

if (empty($_SESSION['autenticado'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça sua reserva</title>
</head>
<body>
    <h1>PÁGINA ONDE FARIA RESERVA (EM CONSTRUÇÃO)</h1>
    <a href="index.php">Home</a>
</body>
</html>
