<?php

    include("../conexao.php");

    if(!isset($_GET["id"])){
        die("ID do usuário não fornecido");
    }

    if(isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['razaosocial']) && isset($_POST['cnpj']) && isset($_POST['tipoempresa']) && isset($_POST['cpf'])){

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $razaosocial = $_POST['razaosocial'];
        $cnpj = $_POST['cnpj'];
        $tipoempresa = $_POST['tipoempresa'];
        $cpf = $_POST['cpf'];

        $sql = "UPDATE fornecedores SET nome = :nome, razaosocial = :razaosocial, cnpj = :cnpj, tipoempresa = :tipoempresa, cpf = :cpf WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":razaosocial", $razaosocial);
        $stmt->bindValue(":cnpj", $cnpj);
        $stmt->bindValue(":tipoempresa", $tipoempresa);
        $stmt->bindValue(":cpf", $cpf);
        $stmt->execute();

        header("Location: TelaListagemFornecedor.php");
        exit();
    }else{
        die("Dados do formulário não fonecido!");
    }

?>