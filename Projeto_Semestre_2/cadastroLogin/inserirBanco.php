 <?php

    include('../conexao.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = htmlspecialchars(trim($_POST['nome']));

        $data_nascimento = htmlspecialchars(trim($_POST['data_nascimento']));

        $genero = htmlspecialchars(trim($_POST['genero']));

        $nome_materno = htmlspecialchars(trim($_POST['nome_materno']));

        $email = htmlspecialchars(trim($_POST['email']));
  
        $cep = htmlspecialchars(trim($_POST['cep']));

        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        // Concatena todos os dados de endereço e junta numa só variável para mandar pro banco
        $endereco = $rua . ", " . $bairro . " - " . $cidade . "/" . $estado;

        $cpf = htmlspecialchars(trim($_POST['cpf']));


        $telefone_celular = htmlspecialchars(trim($_POST['telefone_celular']));

        $telefone_fixo = htmlspecialchars(trim($_POST['telefone_fixo']));

        $senha = htmlspecialchars(trim($_POST['senha']));

        // Senha criptografada
        $senha_cript = password_hash($senha, PASSWORD_DEFAULT);


        // query para inserir os usuários (teste)
        // primeiro fala o nome da tabela e as colunas que quer preencher, depois usa values para disse da onde vem os valores que  vão entrar na tabela(na ordem que esta na tabela)
        $sql = "INSERT INTO usuarios(tipo_usuario,nome,data_nascimento,genero,nome_materno,email,cep,endereco,cpf,telefone_celular,telefone_fixo,senha) 
        
        values('comum','$nome','$data_nascimento','$genero','$nome_materno','$email','$cep','$endereco','$cpf','$telefone_celular','$telefone_fixo','$senha_cript')";

        $retorno = $con->query($sql);

        if ($retorno == true) {
            echo "<h1>Cadastro realizado com sucesso</h1>";
            header('Location: login.php');
        } else {
            echo "<h1>Cadastro não efetuado </h1>";
            echo "<p>Erro: " . $con->error . "</p>";
        }
    }

    ?>