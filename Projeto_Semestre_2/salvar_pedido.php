<?php
session_start();

include_once('conexao.php');

if ($con->connect_error) {
    die('Erro na conexão: ' . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$cliente = trim($_SESSION['nome'] ?? '');
$quantidades = $_POST['qtd'] ?? [];

if (
    $cliente === '' ||
    mb_strlen($cliente) > 120 ||
    !is_array($quantidades)
) {
    exit('Dados inválidos. <a href="index.php">Voltar</a>');
}

try {

    // Inicia a transação.
    $con->begin_transaction();

    // Busca os preços oficiais no banco.
    $resultado = $con->query(
        "SELECT id, nome, preco
         FROM pratos
         WHERE ativo = 1"
    );

    if (!$resultado) {
        throw new Exception('Erro ao buscar pratos.');
    }

    $pratos = $resultado->fetch_all(MYSQLI_ASSOC);

    $itens = [];
    $total = 0;

    foreach ($pratos as $prato) {
        $id = (int)$prato['id'];
        $quantidade = $quantidades[$id] ?? 0;

        if (
            !is_scalar($quantidade) ||
            filter_var(
                $quantidade,
                FILTER_VALIDATE_INT
            ) === false
        ) {
            throw new RuntimeException(
                'Quantidade inválida.'
            );
        }

        $quantidade = (int)$quantidade;

        if ($quantidade < 0 || $quantidade > 99) {
            throw new RuntimeException(
                'Quantidade fora do limite.'
            );
        }

        if ($quantidade === 0) {
            continue;
        }

        $preco = (float)$prato['preco'];
        $subtotal = round($preco * $quantidade, 2);

        $itens[] = [
            'id' => $id,
            'quantidade' => $quantidade,
            'preco' => $preco,
            'subtotal' => $subtotal
        ];

        $total = round($total + $subtotal, 2);
    }

    if (count($itens) === 0) {
        throw new RuntimeException(
            'Selecione pelo menos um prato.'
        );
    }

    // Grava o pedido principal.
    $stmt = $con->prepare(
        "INSERT INTO pedidos (cliente, total)
         VALUES (?, ?)"
    );

    $stmt->bind_param("sd", $cliente, $total);
    $stmt->execute();

    $pedidoId = (int)$con->insert_id;

    // Grava cada prato escolhido.
    $stmtItem = $con->prepare(
        "INSERT INTO itens_pedido
         (pedido_id, prato_id, quantidade,
          preco_unitario, subtotal)
         VALUES (?, ?, ?, ?, ?)"
    );

    foreach ($itens as $item) {

        $idPrato = $item['id'];
        $quantidade = $item['quantidade'];
        $preco = $item['preco'];
        $subtotal = $item['subtotal'];

        $stmtItem->bind_param(
            "iiidd",
            $pedidoId,
            $idPrato,
            $quantidade,
            $preco,
            $subtotal
        );

        $stmtItem->execute();
    }

    // Confirma a transação.
    $con->commit();

} catch (Throwable $e) {

    // Desfaz as alterações em caso de erro.
    $con->rollback();

    if ($e instanceof RuntimeException) {
        http_response_code(400);

        exit(
            htmlspecialchars(
                $e->getMessage(),
                ENT_QUOTES,
                'UTF-8'
            ) . ' <a href="index.php">Voltar</a>'
        );
    }

    error_log($e->getMessage());

    http_response_code(500);

    exit('Não foi possível salvar o pedido. Tente novamente.');
}

function h($valor) {
    return htmlspecialchars(
        (string)$valor,
        ENT_QUOTES,
        'UTF-8'
    );
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido confirmado</title>
    <link rel="stylesheet" href="css/salva_pedido.css">
</head>
<body>
<div class="container">
    <h1 class="sucesso">Pedido confirmado!</h1>

    <p>Obrigado, <?= h($cliente) ?>.</p>

    <p>
        <strong>Número do pedido:</strong>
        <?= $pedidoId ?>
    </p>

    <h3>Resumo do pedido</h3>

    <ul>
        <?php foreach ($itens as $item): ?>
            <?php
            $nome = '';

            foreach ($pratos as $prato) {
                if ((int)$prato['id'] === $item['id']) {
                    $nome = $prato['nome'];
                    break;
                }
            }
            ?>

            <li>
                <?= h($nome) ?> —
                <?= $item['quantidade'] ?> unidade(s) —
                R$ <?= number_format(
                    $item['subtotal'], 2, ',', '.'
                ) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>
        Total: R$ <?= number_format(
            $total, 2, ',', '.'
        ) ?>
    </h2>

    <a href="fazerPedido.php">Fazer novo pedido</a>
    <a href="index.php">Voltar para a página principal</a>
</div>
</body>
</html>