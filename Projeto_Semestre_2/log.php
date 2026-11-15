<?php
// DADOS DEMONSTRATIVOS
$logs = [
    [
        "nome" => "Carlos Oliveira",
        "cpf" => "123.456.789-00",
        "data" => "12/11/2026",
        "hora" => "14:30:25",
        "metodo" => "Nome materno"
    ],
    [
        "nome" => "Mariana Santos",
        "cpf" => "987.654.321-00",
        "data" => "12/11/2026",
        "hora" => "13:15:42",
        "metodo" => "Data de nascimento"
    ],
    [
        "nome" => "João Pereira",
        "cpf" => "456.789.123-00",
        "data" => "11/11/2026",
        "hora" => "18:45:10",
        "metodo" => "CEP"
    ],
    [
        "nome" => "Ana Costa",
        "cpf" => "321.654.987-00",
        "data" => "10/11/2026",
        "hora" => "09:20:33",
        "metodo" => "Nome materno"
    ]
];

// FILTRO
$busca = $_GET['busca'] ?? '';
$filtro = $_GET['filtro'] ?? 'todos';

$logsFiltrados = array_filter($logs, function($log) use ($busca, $filtro) {
    if ($busca === '') {
        return true;
    }

    if ($filtro === 'nome') {
        return stripos($log['nome'], $busca) !== false;
    }

    if ($filtro === 'cpf') {
        return stripos($log['cpf'], $busca) !== false;
    }

    return stripos($log['nome'], $busca) !== false ||
           stripos($log['cpf'], $busca) !== false;
});

// MAIS RECENTES PRIMEIRO
usort($logsFiltrados, function($a, $b) {
    $dataA = DateTime::createFromFormat(
        'd/m/Y H:i:s', $a['data'] . ' ' . $a['hora']
    );
    $dataB = DateTime::createFromFormat(
        'd/m/Y H:i:s', $b['data'] . ' ' . $b['hora']
    );

    return $dataB <=> $dataA;
});
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logs de Autenticação</title>

<link rel='stylesheet' href='css/log.css'>
</head>

<body>

<header>
    <h2>Meu Sistema</h2>
    <span>Usuário: Master</span>
</header>

<div class="container">

    <div class="titulo">
        <h1>Logs de Autenticação</h1>
        <p>Consulte o histórico de acessos dos usuários.</p>
    </div>

    <div class="painel">

        <form method="GET" class="pesquisa">
            <select name="filtro">
                <option value="todos"
                    <?= $filtro === 'todos' ? 'selected' : '' ?>>
                    Todos
                </option>

                <option value="nome"
                    <?= $filtro === 'nome' ? 'selected' : '' ?>>
                    Nome
                </option>

                <option value="cpf"
                    <?= $filtro === 'cpf' ? 'selected' : '' ?>>
                    CPF
                </option>
            </select>

            <input
                type="text"
                name="busca"
                placeholder="Digite o nome ou CPF..."
                value="<?= htmlspecialchars($busca) ?>"
            >

            <button type="submit">Pesquisar</button>
        </form>

        <div class="resultado">
            Registros encontrados: <?= count($logsFiltrados) ?>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>CPF</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Método 2FA</th>
                </tr>
            </thead>

            <tbody>
            <?php if (count($logsFiltrados) > 0): ?>
                <?php foreach ($logsFiltrados as $log): ?>
                <tr>
                    <td><?= htmlspecialchars($log['nome']) ?></td>
                    <td><?= htmlspecialchars($log['cpf']) ?></td>
                    <td><?= htmlspecialchars($log['data']) ?></td>
                    <td><?= htmlspecialchars($log['hora']) ?></td>
                    <td>
                        <span class="metodo">
                            <?= htmlspecialchars($log['metodo']) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="vazio">
                        Nenhum registro encontrado.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
