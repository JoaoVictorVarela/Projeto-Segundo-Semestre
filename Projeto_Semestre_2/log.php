<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once __DIR__ . '/conexao.php';

// Somente usuários autenticados com perfil administrador podem consultar os logs.
if (
    empty($_SESSION['autenticado']) ||
    !isset($_SESSION['tipo_usuario']) ||
    $_SESSION['tipo_usuario'] !== 'admin'
) {
    header('Location: cadastroLogin/login.php');
    exit();
}

function h($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$busca = trim((string) ($_GET['busca'] ?? ''));
$filtro = (string) ($_GET['filtro'] ?? 'todos');
if (!in_array($filtro, ['todos', 'nome', 'cpf'], true)) {
    $filtro = 'todos';
}

$sql = "SELECT nome_usuario, cpf_usuario, data_hora, metodo_2fa
        FROM logs_acesso";
$parametros = [];
$tipos = '';

if ($busca !== '') {
    if ($filtro === 'nome') {
        $sql .= " WHERE nome_usuario LIKE ?";
        $parametros[] = '%' . $busca . '%';
        $tipos .= 's';
    } elseif ($filtro === 'cpf') {
        $sql .= " WHERE cpf_usuario LIKE ?";
        $parametros[] = '%' . $busca . '%';
        $tipos .= 's';
    } else {
        $sql .= " WHERE nome_usuario LIKE ? OR cpf_usuario LIKE ?";
        $parametros[] = '%' . $busca . '%';
        $parametros[] = '%' . $busca . '%';
        $tipos .= 'ss';
    }
}

$sql .= " ORDER BY data_hora DESC";

$stmt = $con->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    exit('Não foi possível consultar os logs. Verifique se a tabela logs_acesso foi criada no banco de dados.');
}

if ($parametros) {
    $stmt->bind_param($tipos, ...$parametros);
}

$stmt->execute();
$resultado = $stmt->get_result();
$quantidade = $resultado ? $resultado->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs de autenticação | La Fome</title>
    <link rel="stylesheet" href="css/log.css">
    <link rel="stylesheet" href="css/tema.css">
</head>
<body>
    <header class="cabecalho">
        <a class="logo" href="index.php">La Fome</a>
        <div class="usuario-logado">
            <span>Administrador: <?= h($_SESSION['nome'] ?? 'Master') ?></span>
            <a href="sair.php">Sair</a>
        </div>
    </header>

    <main class="container">
        <div class="titulo-pagina">
            <span class="sobretitulo">ÁREA ADMINISTRATIVA</span>
            <h1>Logs de autenticação</h1>
            <p>Consulte o histórico de autenticações concluídas no sistema.</p>
        </div>

        <section class="painel">
            <form method="GET" class="pesquisa">
                <label class="campo-filtro">
                    <span>Pesquisar por</span>
                    <select name="filtro">
                        <option value="todos" <?= $filtro === 'todos' ? 'selected' : '' ?>>Todos</option>
                        <option value="nome" <?= $filtro === 'nome' ? 'selected' : '' ?>>Nome</option>
                        <option value="cpf" <?= $filtro === 'cpf' ? 'selected' : '' ?>>CPF</option>
                    </select>
                </label>

                <label class="campo-busca">
                    <span>Busca</span>
                    <input
                        type="search"
                        name="busca"
                        placeholder="Digite o nome ou CPF..."
                        value="<?= h($busca) ?>"
                    >
                </label>

                <button type="submit" class="btn-pesquisar">Pesquisar</button>
                <a class="btn-limpar" href="log.php">Limpar</a>
            </form>

            <div class="resumo">
                <span>Registros encontrados</span>
                <strong><?= (int) $quantidade ?></strong>
            </div>

            <div class="tabela-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nome do usuário</th>
                            <th>CPF</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Segundo fator (2FA)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($quantidade > 0): ?>
                        <?php while ($log = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td data-label="Nome"><?= h($log['nome_usuario']) ?></td>
                                <td data-label="CPF"><?= h($log['cpf_usuario']) ?></td>
                                <td data-label="Data"><?= date('d/m/Y', strtotime($log['data_hora'])) ?></td>
                                <td data-label="Horário"><?= date('H:i:s', strtotime($log['data_hora'])) ?></td>
                                <td data-label="Segundo fator">
                                    <span class="metodo"><?= h($log['metodo_2fa']) ?></span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="vazio">
                                Nenhum registro de autenticação encontrado.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="acoes">
                <a href="index.php" class="btn-voltar">Voltar para a página inicial</a>
            </div>
        </section>
    </main>
</body>
</html>
<?php
$stmt->close();
?>
