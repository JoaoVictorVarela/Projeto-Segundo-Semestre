<?php
session_start();

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['tipo_usuario']);
    
    header('Location: login.php');
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
    <h1>PAGINA ONDE FARIA RESERVA (EM CONSTRUÇÃO)</h1>
    <a href="index.php"> Home</a>
</body>
</html>