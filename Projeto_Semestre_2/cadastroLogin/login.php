<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/tema.css">
</head>

<body>
    <a id="btn-home" href="../index.php" aria-label="Voltar para a página inicial">Home</a>

    <div class= "login">
        <h1>Tela de Login</h1>

        <a id="mensagem-geral-login"></a>

        <form action="testeLogin.php" method="post">
            <h2>Email</h2>
            <input name="email" id="loginEmail" type="email" placeholder="Digite seu email" required>
            
            <h2>Senha</h2>
            <input name="senha" id="loginSenha" type="password" placeholder="Digite sua senha" required>
            <br><br>

            <button class="botao" type="reset">Limpar tela</button>
            <br>
            <button name="submit" class="botao" type="submit"> Logar</button>
        </form>

        <p>Não possui login? <a href="cadastro.php">Clique aqui</a>
        <p>Esqueceu a senha? <a href="esqueciSenha.php">Clique aqui</a>
        
    <div class="controles" aria-label="Controles de tamanho da fonte">

    
    <button id="btnTema" type="button" title="Mudar Tema">
    Tema
    </button>
    </div>

    </div>

        
        
</body>

<script src="../js/tema.js"></script>


</html>
