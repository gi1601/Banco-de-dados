<?php
    include("../config/cabecalho.php");
?>

<div class="container">
    <h1>Cadastro de fornecedor</h1>
    <form action="" method="POST">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required placeholder="Informe o nome do fornecedor">

        <label for="razaosocial">Razão Social</label>
        <input type="text" name="razaosocial" id="razaosocial" required placeholder="Informe a razão social do fornecedor">

        <label for="cnpj">CNPJ</label>
        <input type="text" name="cnpj" id="cnpj" required placeholder="Informe o CNPJ do fornecedor">

        <label for="tipoempresa">Tipo da Empresa</label>
        <input type="text" name="tipoempresa" id="tipoempresa" required placeholder="Informe o tipo de empresa do fornecedor">

        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" required placeholder="Informe o CPF do fornecedor">

        <button type="submit">Cadastrar fornecedor</button>
    </form>




<?php
    include("../config/rodape.php");
?>

<?php
    //conectar com o banco
    include("../conexao.php");

    //formulario foi enviado?
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $razaosocial = $_POST["razaosocial"];
        $cnpj = $_POST["cnpj"];
        $tipoempresa = $_POST["tipoempresa"];
        $cpf = $_POST["cpf"];

        //verificar se o login ou email já existem no banco
        $sql = "SELECT COUNT(*) AS total FROM fornecedores WHERE razaosocial = :razaosocial OR cnpj = :cnpj";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            "razaosocial" => $razaosocial,
            "cnpj" => $cnpj
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['total'] > 0){
            echo "<div class='error'>Razão social ou CNPJ já cadastrados</div>";
        }else{
            //inserir o novo usuário
            $sql = "INSERT INTO fornecedores(nome,razaosocial,cnpj,tipoempresa,cpf) VALUES (:nome, :razaosocial, :cnpj, :tipoempresa, :cpf)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                "nome" => $nome,
                "razaosocial" => $razaosocial,
                "cnpj" => $cnpj,
                "tipoempresa" => $tipoempresa,
                "cpf" => $cpf
            ]);

            if($stmt->rowCount() > 0){
                echo "<div class='success'>Fornecedor cadastrado com sucesso</div>";
            }else{
                echo "<div class='error'>Erro ao cadastrar o Fornecedor</div>";
            }
        }

        $conexao = null;
    }
?>

</div>