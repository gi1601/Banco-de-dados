<?php

    include("../conexao.php");

    if (!isset($_GET['id'])){
        die("ID do usuário não foi fonecido");
    }

    $id = $_GET['id'];

    $sql = "DELETE FROM fornecedores WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    header("Location: TelaListagemFornecedor.php");
    exit;

?>