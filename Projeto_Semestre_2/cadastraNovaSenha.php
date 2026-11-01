<?php
include_once('conexao.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
     
    $email= htmlspecialchars(trim($_POST['email']));

    $cpf= htmlspecialchars(trim($_POST['cpf']));

    $cep= htmlspecialchars(trim($_POST['cep']));

    $data_nascimento= htmlspecialchars(trim($_POST['data_nascimento']));

    $nome_materno = htmlspecialchars(trim($_POST['nome_materno']));

    $senha = htmlspecialchars(trim($_POST['senha']));

    $senha_conf = htmlspecialchars(trim($_POST['senha_conf']));

    $sql = "SELECT * FROM usuarios where email = '$email' and tipo_usuario = 'comum' " ;

    $resultado = $con->query($sql); 

    if (mysqli_num_rows($resultado) < 1){
        echo '<h2>as senhas não conferem ou os dados estão incorretos</h2>';
        

    } 
    else{
        $usuario = $resultado->fetch_assoc(); 

        $email_sql = $usuario['email'];
        $cpf_sql = $usuario['cpf'];
        $cep_sql = $usuario['cep'];
        $data_nasc_sql = $usuario['data_nascimento'];
        $nome_materno_sql = $usuario['nome_materno'];

        if($senha===$senha_conf && $email===$email_sql && $cpf===$cpf_sql && $cep===$cep_sql && $data_nascimento===$data_nasc_sql && $nome_materno===$nome_materno_sql){

        $hashsenha = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET senha='$hashsenha' where email='$email' ";

        $resultado = $con->query($sql);

        echo '<h2>Senha alterada com sucesso</h2>';

        }else{
            echo '<h2>Registro não encontrado</h2>';
        }

    }

}

?>
<a href='index.php'>Tela Principal</a>
<a href='esqueciSenha.php'>Mudar Senha</a>