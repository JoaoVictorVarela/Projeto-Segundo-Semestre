<?php

if (!empty($_GET['id'])){
    include_once('conexao.php');

    $id = $_GET['id'];

    $sql = "SELECT * FROM usuarios where id=$id";

    $resultado = $con->query($sql);

    if ($resultado ->  num_rows >0){
        $sql_delete = "DELETE  FROM usuarios WHERE id=$id";

        $resultado_delete = $con ->query($sql_delete);
    }
}

header('Location: paginatop.php')

?>