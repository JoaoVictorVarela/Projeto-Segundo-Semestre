<?php
session_start();
  include_once('conexao.php');


if ($con->connect_error) {
    die('Erro na conexão: ' . $con->connect_error);
}

// Token de segurança dos formulários.
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Busca todos os pedidos.
$sql = "
    SELECT
        p.id AS pedido_id,
        p.cliente,
        p.total,
        p.status,
        p.data_pedido,
        i.quantidade,
        i.preco_unitario,
        i.subtotal,
        pr.nome AS prato
    FROM pedidos p
    LEFT JOIN itens_pedido i ON i.pedido_id = p.id
    LEFT JOIN pratos pr ON pr.id = i.prato_id
    ORDER BY
        CASE WHEN p.status = 'pendente' THEN 0 ELSE 1 END,
        p.data_pedido DESC,
        p.id DESC
";

$resultado = $con->query($sql);

if (!$resultado) {
    die('Erro ao buscar pedidos: ' . $con->error);
}

$linhas = $resultado->fetch_all(MYSQLI_ASSOC);

// Agrupa os pratos por pedido.
$pedidos = [];

foreach ($linhas as $linha) {
    $id = $linha['pedido_id'];

    if (!isset($pedidos[$id])) {
        $pedidos[$id] = [
            'id' => $id,
            'cliente' => $linha['cliente'],
            'total' => $linha['total'],
            'status' => $linha['status'],
            'data' => $linha['data_pedido'],
            'itens' => []
        ];
    }

    if ($linha['prato'] !== null) {
        $pedidos[$id]['itens'][] = [
            'nome' => $linha['prato'],
            'quantidade' => $linha['quantidade'],
            'preco' => $linha['preco_unitario'],
            'subtotal' => $linha['subtotal']
        ];
    }
}

function h($valor) {
    return htmlspecialchars(
        (string)$valor,
        ENT_QUOTES,
        'UTF-8'
    );
}

function dinheiro($valor) {
    return 'R$ ' . number_format(
        (float)$valor, 2, ',', '.'
    );
}

$pendentes = count(array_filter(
    $pedidos,
    fn($p) => $p['status'] === 'pendente'
));

$entregues = count($pedidos) - $pendentes;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciamento de pedidos</title>
    <link rel="stylesheet" href="css/pedidos.css">
</head>
<body>

<div class="container">

    <header>
        <h1>📋 Gerenciamento de pedidos</h1>
        <a class="novo-pedido" href="index.php">
            Home
        </a>
    </header>

    <div class="resumo">
        <div class="indicador">
            <strong><?= count($pedidos) ?></strong>
            Total de pedidos
        </div>

        <div class="indicador">
            <strong><?= $pendentes ?></strong>
            Pendentes
        </div>

        <div class="indicador">
            <strong><?= $entregues ?></strong>
            Entregues
        </div>
    </div>

    <div class="lista">

    <?php if (empty($pedidos)): ?>

        <div class="vazio">
            <h2>Nenhum pedido encontrado</h2>
            <p>Os novos pedidos aparecerão aqui.</p>
        </div>

    <?php else: ?>

        <?php foreach ($pedidos as $pedido): ?>
            <?php
            $entregue = $pedido['status'] === 'entregue';
            ?>

            <article class="pedido <?= $entregue ? 'entregue' : '' ?>">

                <div class="topo-pedido">
                    <div>
                        <h2>
                            Pedido #<?= (int)$pedido['id'] ?>
                            — <?= h($pedido['cliente']) ?>
                        </h2>

                        <div class="data">
                            <?= h(date(
                                'd/m/Y H:i',
                                strtotime($pedido['data'])
                            )) ?>
                        </div>
                    </div>

                    <span class="status <?= $entregue ? 'entregue' : '' ?>">
                        <?= $entregue ? '✓ Entregue' : '● Pendente' ?>
                    </span>
                </div>

                <h3>Pratos pedidos</h3>

                <?php if (empty($pedido['itens'])): ?>
                    <p>Nenhum item registrado.</p>
                <?php else: ?>

                    <?php foreach ($pedido['itens'] as $item): ?>
                        <div class="item">
                            <div>
                                <strong><?= h($item['nome']) ?></strong>

                                <div class="detalhe">
                                    <?= (int)$item['quantidade'] ?>
                                    unidade(s) ×
                                    <?= dinheiro($item['preco']) ?>
                                </div>
                            </div>

                            <strong>
                                <?= dinheiro($item['subtotal']) ?>
                            </strong>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>

                <div class="rodape-pedido">
                    <div class="total">
                        Total: <?= dinheiro($pedido['total']) ?>
                    </div>

                    <?php if (!$entregue): ?>
                        <form
                            action="finalizar_pedido.php"
                            method="POST"
                            onsubmit="return confirm(
                                'Confirma que o pedido #<?= (int)$pedido['id'] ?> foi entregue?'
                            );"
                        >
                            <input
                                type="hidden"
                                name="pedido_id"
                                value="<?= (int)$pedido['id'] ?>"
                            >

                            <input
                                type="hidden"
                                name="csrf_token"
                                value="<?= h($_SESSION['csrf_token']) ?>"
                            >

                            <button type="submit">
                                ✓ Finalizar pedido
                            </button>
                        </form>
                    <?php else: ?>
                        <span class="status entregue">
                            Pedido finalizado
                        </span>
                    <?php endif; ?>
                </div>

            </article>

        <?php endforeach; ?>

    <?php endif; ?>

    </div>
</div>

</body>
</html>