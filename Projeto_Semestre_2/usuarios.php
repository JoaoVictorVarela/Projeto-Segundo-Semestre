<?php
include_once("conexao.php");
session_start();

if (!isset($_SESSION['email'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['tipo_usuario']);
    header('Location: cadastroLogin/login.php');
    exit;
}

$pesquisa = trim($_GET['search'] ?? '');
$pesquisaSql = $con->real_escape_string($pesquisa);

if ($pesquisa !== '') {
    $sql = "SELECT * FROM usuarios
            WHERE nome LIKE '%$pesquisaSql%'
            AND tipo_usuario != 'admin'
            ORDER BY id";
} else {
    $sql = "SELECT * FROM usuarios
            WHERE tipo_usuario != 'admin'
            ORDER BY id";
}

$conexao = $con->query($sql);

function h($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuários | La Fome</title>
    <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>
    <main class="pagina-usuarios">
        <header class="cabecalho-usuarios">
            <a class="logo" href="index.php" aria-label="Voltar para a página inicial">La Fome</a>
            <div>
                <h1>Lista de usuários</h1>
                <p class="subtitulo">Gerencie os cadastros do restaurante</p>
            </div>
        </header>

        <section class="painel" aria-labelledby="titulo-lista">
            <h2 id="titulo-lista" class="visualmente-oculto">Usuários cadastrados</h2>

            <div class="box-search">
                <label for="pesquisar">Pesquisar usuário</label>
                <input
                    type="search"
                    id="pesquisar"
                    value="<?= h($pesquisa) ?>"
                    placeholder="Digite o nome do usuário"
                    autocomplete="off"
                >
                <button class="btn-pesquisar" type="button" onclick="searchData()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                    Pesquisar
                </button>
            </div>

            <div class="tabela-wrapper">
                <?php if ($conexao && $conexao->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Nascimento</th>
                                <th scope="col">Gênero</th>
                                <th scope="col">Nome materno</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">CEP</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Telefone fixo</th>
                                <th scope="col">Senha</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($dados_user = $conexao->fetch_assoc()): ?>
                                <tr>
                                    <td data-label="ID"><?= h($dados_user['id']) ?></td>
                                    <td data-label="Tipo"><?= h($dados_user['tipo_usuario']) ?></td>
                                    <td data-label="Nome"><?= h($dados_user['nome']) ?></td>
                                    <td data-label="Nascimento"><?= h($dados_user['data_nascimento']) ?></td>
                                    <td data-label="Gênero"><?= h($dados_user['genero']) ?></td>
                                    <td data-label="Nome materno"><?= h($dados_user['nome_materno']) ?></td>
                                    <td data-label="E-mail"><?= h($dados_user['email']) ?></td>
                                    <td data-label="CEP"><?= h($dados_user['cep']) ?></td>
                                    <td data-label="Endereço"><?= h($dados_user['endereco']) ?></td>
                                    <td data-label="CPF"><?= h($dados_user['cpf']) ?></td>
                                    <td data-label="Celular"><?= h($dados_user['telefone_celular']) ?></td>
                                    <td data-label="Telefone fixo"><?= h($dados_user['telefone_fixo']) ?></td>
                                    <td data-label="Senha"><?= h($dados_user['senha']) ?></td>
                                    <td class="acoes-celular" data-label="Ação">
                                        <a class="btn-excluir" href="deletar.php?id=<?= (int) $dados_user['id'] ?>" aria-label="Excluir <?= h($dados_user['nome']) ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                            </svg>
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="vazio">
                        <h2>Nenhum usuário encontrado</h2>
                        <p>Altere a busca ou aguarde novos cadastros.</p>
                    </div>
                <?php endif; ?>
            </div>

            <nav class="acoes" aria-label="Ações da lista">
                <a class="btn-secundario" href="index.php">Voltar para a Home</a>
                <a class="btn-secundario" href="gerarPdf.php">Baixar lista em PDF</a>
            </nav>
        </section>
    </main>

    <script src="js/pesquisa.js"></script>
</body>
</html>
