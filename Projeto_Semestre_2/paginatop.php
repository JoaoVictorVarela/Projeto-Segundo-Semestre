<?php
include_once("conexao.php");
session_start();
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}

if (!empty($_GET['search'])){
    $pesquisa = $_GET['search'];
    $sql = "SELECT * FROM usuarios WHERE nome LIKE '%$pesquisa%' ORDER BY id";

}
else{
    echo "tem coisa ai nao doido";
    $sql = 'SELECT * FROM usuarios ORDER BY id';
}


$conexao = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <h1> Se você está lendo isso, significa que você está logado. Parabens!!</h1>





    <div class="box-search">

        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">

        <button class="btn btn-primary" onclick="searchData()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
        </button>
    </div>





    <div>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nome</th>
      <th scope="col">data_nascimento</th>
      <th scope="col">genero</th>
      <th scope="col">nome_materno</th>
      <th scope="col">email</th>
      <th scope="col">cep</th>
      <th scope="col">endereco</th>
      <th scope="col">cpf</th>
      <th scope="col">telefone_celular</th>
      <th scope="col">telefone_fixo</th>
      <th scope="col">senha</th>
      <th scope="col">Excluir</th>
    </tr>
  </thead>
  <tbody>


  
  <?php
    // Loop que atualiza a tabela dos registros
    while($dados_user = mysqli_fetch_assoc($conexao)){
        echo "<tr>";
        echo "<td>" . $dados_user['id'] . "</td>"; 
        echo "<td>" . $dados_user['nome'] . "</td>"; 
        echo "<td>" . $dados_user['data_nascimento'] . "</td>"; 
        echo "<td>" . $dados_user['genero'] . "</td>"; 
        echo "<td>" . $dados_user['nome_materno'] . "</td>"; 
        echo "<td>" . $dados_user['email'] . "</td>"; 
        echo "<td>" . $dados_user['cep'] . "</td>"; 
        echo "<td>" . $dados_user['endereco'] . "</td>"; 
        echo "<td>" . $dados_user['cpf'] . "</td>"; 
        echo "<td>" . $dados_user['telefone_celular'] . "</td>"; 
        echo "<td>" . $dados_user['telefone_fixo'] . "</td>"; 
        echo "<td>" . $dados_user['senha'] . "</td>"; 
        echo "<td> 
        <a class='btn btn-sm btn-danger' href='deletar.php?id=$dados_user[id]'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
        <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/>
        </svg>
        </a> 
        </td>";
        echo "</tr>";
    }
  ?>






  </tbody>
</table>
    </div>

    <a href="sair.php"> Sair </a>
</body>

<script src="js/pesquisa.js"></script>

</html>