
<?php

// Carrega a biblioteca Dompdf
require_once 'vendor/autoload.php';

// Inclui a conexão com o banco de dados
include_once 'conexao.php';

// Importa a classe Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

// Configurações do Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

// Consulta os usuários no banco
$sql = "SELECT id, nome, email, tipo_usuario FROM usuarios";

$resultado = mysqli_query($con, $sql);

// Verifica se a consulta funcionou
if (!$resultado) {
    die("Erro ao consultar usuários: " . mysqli_error($conexao));
}

// Começa a montar o HTML
$html = '
<html>
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>Lista de Usuários</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo de Usuário</th>
        </tr>
';

// Percorre todos os usuários encontrados
while ($usuario = mysqli_fetch_assoc($resultado)) {

    $id = htmlspecialchars($usuario['id']);
    $nome = htmlspecialchars($usuario['nome']);
    $email = htmlspecialchars($usuario['email']);
    $tipo = htmlspecialchars($usuario['tipo_usuario']);

    $html .= "
        <tr>
            <td>$id</td>
            <td>$nome</td>
            <td>$email</td>
            <td>$tipo</td>
        </tr>
    ";
}

// Finaliza o HTML
$html .= '
    </table>

</body>
</html>
';

// Envia o HTML para o Dompdf
$dompdf->loadHtml($html);

// Define o tamanho e orientação da página (landscape é deitado e portrait é em pé)
$dompdf->setPaper('A4', 'landscape');

// Gera o PDF
$dompdf->render();

// Disponibiliza o arquivo para download
$dompdf->stream("lista_usuarios.pdf", [
    "Attachment" => true
]);

exit;
?>
