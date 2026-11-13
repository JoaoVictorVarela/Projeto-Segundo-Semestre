<?php
include_once('../conexao.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
     
    $email= htmlspecialchars(trim($_POST['email']));

    $cpf= htmlspecialchars(trim($_POST['cpf']));

    $cep= htmlspecialchars(trim($_POST['cep']));

    $data_nascimento= htmlspecialchars(trim($_POST['data_nascimento']));

    $nome_materno = htmlspecialchars(trim($_POST['nome_materno']));

    $senha = htmlspecialchars(trim($_POST['senha']));

    $sql = "SELECT * FROM usuarios where email = '$email' and tipo_usuario = 'comum' LIMIT 1" ;

    $resultado = $con->query($sql); 

    if (mysqli_num_rows($resultado) < 1){
        echo '<h2>usuario não encontrado</h2>';
        
        
    } 
    else if (mysqli_num_rows($resultado) > 1) {
        $usuario = $resultado->fetch_assoc(); 

        $email_sql = $usuario['email'];
        $cpf_sql = $usuario['cpf'];
        $cep_sql = $usuario['cep'];
        $data_nasc_sql = $usuario['data_nascimento'];
        $nome_materno_sql = $usuario['nome_materno'];

        if($email===$email_sql && $cpf===$cpf_sql && $cep===$cep_sql && $data_nascimento===$data_nasc_sql && $nome_materno===$nome_materno_sql){

        $hashsenha = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET senha='$hashsenha' where email='$email' ";

        $resultado = $con->query($sql);

        echo '<h2>Senha alterada com sucesso</h2>';
        header('Location: senhaAlterada.php');

        }else{
            echo '<h2>Dados estão incorretos</h2>';
            

        }

    }

}

?>
