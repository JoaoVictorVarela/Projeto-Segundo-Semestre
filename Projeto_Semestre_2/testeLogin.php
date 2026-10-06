<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

    include_once('conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Procura o usuário apenas pelo e-mail
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";

    $resultado = $con->query($sql);

    if (mysqli_num_rows($resultado) < 1) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);

        header('Location: login.php');
        exit();

    } else {

        // Pega os dados do usuário encontrado
        $usuario = $resultado->fetch_assoc();

        // Verifica se a senha digitada corresponde à senha armazenada
        if (password_verify($senha, $usuario['senha'])) {

            $_SESSION['email'] = $usuario['email'];

            header('Location: index.php');
            exit();

        } else {

            unset($_SESSION['email']);
            unset($_SESSION['senha']);

            header('Location: login.php');
            exit();
        }
    }

} else {

    header('Location: login.php');
    exit();
}
?>
