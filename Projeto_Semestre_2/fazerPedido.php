<?php
session_start();

include_once('conexao.php');

if ($con->connect_error) {
    die('Erro na conexão: ' . $con->connect_error);
}

if (empty($_SESSION['nome'])) {
    header('Location: cadastro/login.php');
    exit;
}

$resultado = $con->query(
    "SELECT id, nome, preco FROM pratos
     WHERE ativo = 1 ORDER BY nome"
);

if (!$resultado) {
    die('Erro ao buscar pratos: ' . $con->error);
}

$pratos = $resultado->fetch_all(MYSQLI_ASSOC);

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
    <title>Pedidos do Restaurante</title>
    <link rel="stylesheet" href="css/fazerPedido.css">
</head>
<body>

<div class="container">
    <h1>🍽️ Faça seu pedido</h1>

    <form action="salvar_pedido.php"
          method="POST"
          id="formPedido">

        <h3>Cardápio</h3>

        <?php foreach ($pratos as $prato): ?>
            <div class="prato">
                <div>
                    <div class="nome">
                        <?= h($prato['nome']) ?>
                    </div>

                    <div class="preco">
                        R$ <?= number_format(
                            (float)$prato['preco'],
                            2, ',', '.'
                        ) ?>
                    </div>
                </div>

                <input
                    class="quantidade"
                    type="number"
                    name="qtd[<?= (int)$prato['id'] ?>]"
                    min="0"
                    max="99"
                    step="1"
                    value="0"
                    data-preco="<?= h($prato['preco']) ?>"
                    aria-label="Quantidade de <?= h($prato['nome']) ?>"
                >

                <div class="subtotal">
                    R$ <span class="valor-subtotal">0,00</span>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="total">
            Total: R$ <span id="total">0,00</span>
        </div>

        <button type="submit">
            Finalizar pedido
        </button>
    </form>
</div>

<script src="js/fazerPedido.js"></script>

</body>
</html>