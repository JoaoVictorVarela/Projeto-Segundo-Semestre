<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Esqueci a senha</h2>
    <form action="cadastraNovaSenha.php" method='post'>
        <input type="email" name="email" placeholder="Digite seu email" required><br><br>
        <input type="text" name="cpf" placeholder="Digite seu CPF" required><br><br>
        <input type="text" name="cep" placeholder="Digite seu CEP" required><br><br>
        <label for="data">Insira sua data de nascimento</label><br>
        <input type="date" id="data" name="data_nascimento" required><br><br>
        <input type="text" name="nome_materno" placeholder="Digite o nome da sua mãe" required><br><br>
        <input type="password" name="senha" placeholder="Digite sua nova senha" required><br><br>
        <input type="password" name="senha_conf" placeholder="Confirme sua nova senha" required><br><br>

        <input type="submit" value="enviar">

        <a href='index.php'>Tela Principal</a>
        <a href='login.php'>Login</a>

    </form>
</body>
</html>