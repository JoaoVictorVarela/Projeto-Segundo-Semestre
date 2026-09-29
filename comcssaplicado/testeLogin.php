<?php
session_start();

// só vai entrar se tiver preechido o campo email, senha e tiver apertado enviar
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){
    include_once('conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $senha_cript = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha ='$senha' ";

    $resultado = $con->query($sql);

if (mysqli_num_rows($resultado) < 1){
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    print_r("Usuário não cadastrado");
    header('Location: login.php');
    
}

else{
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    print_r("Usuário cadastrado");
    header('Location: paginatop.php');
}

}
else{
    header('Location: login.php');
}

?>