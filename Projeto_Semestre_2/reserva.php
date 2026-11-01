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
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div>
        <h1>Faça sua reserva</h1>
    <form action="" method='post'>
        <input type="text" name="nome_reserva" placeholder="Digite o nome da reserva" required><br><br>

        <label for="data">Insira a data da sua reserva</label><br>
        <input id="data" type="date" name="data" required><br><br>

        <input type="text" name="horario" placeholder="digite o horario da sua reserva" required><br><br>

        <input type="number" name="qtd_pessoas" placeholder="Digite quantas pessoas vão na reserva" required><br><br>

        <input type="text" name="observacao" placeholder="Alguma Observação? (opcional)"><br><br>

        <input type="submit" value="enviar">

        <p>Tela Principal<a href="index.php"> Clique aqui</a>
    </form>

    <div>

<script src="js/data_reserva.js"></script>
</body>
</html>