<?php

include("../config/cabecalho.php");
include("../conexao.php");


if(!isset($_GET['id'])){
    die("ID do fornecedor inválido");
}

$id = $_GET['id'];

$sql = "SELECT * FROM fornecedores WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindValue(":id", $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$row){
    die("Fornecedor não encontrado");
}
?>
<div class="container">
    <h1>Atualizar dados do fornecedor</h1>
    <form action="<?php echo "atualizar.php?id={$id}" ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $row["id"]?>">

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Informe o nome do fornecedor" required value="<?php echo $row['nome'] ?>">

        <label for="razaosocial">Razão Social</label>
        <input type="text" name="razaosocial" id="razaosocial" placeholder="Informe a razão social do fornecedor" required value="<?php echo $row['razaosocial'] ?>">

        <label for="cnpj">CNPJ</label>
        <input type="text" name="cnpj" id="cnpj" placeholder="Informe o CNPJ do fornecedor" required value="<?php echo $row['cnpj'] ?>">

        <label for="tipoempresa">Tipo de Empresa</label>
        <input type="text" name="tipoempresa" id="tipoempresa" placeholder="Informe o tipo de empresa do fornecedor" required value="<?php echo $row['tipoempresa'] ?>">

        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" placeholder="Informe o CPF do fornecedor" required value="<?php echo $row['cpf'] ?>">

        <button type="submit">Atualizar</button>
    </form>

</div>
<?php
    include("../config/rodape.php");
?>