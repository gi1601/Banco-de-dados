<?php

include("../config/cabecalho.php");
include("../conexao.php");

//Verificar se o ID foi passado
if(!isset($_GET['id'])){
    die("ID do usuário inválido");
}

//obtem o ID do usuário
$id = $_GET['id'];

$sql = "SELECT * FROM usuario WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindValue(":id", $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//Verifica se retornou alguma coisa
if(!$row){
    die("Usuário não encontrado");
}
?>
<div class="container">
    <h1>Atualizar seus dados</h1>
    <form action="<?php echo "atualizar.php?id={$id}" ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $row["id"]?>">

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Informe seu nome" required value="<?php echo $row['nome'] ?>">

        <label for="login">Login</label>
        <input type="text" name="login" id="login" placeholder="Informe seu login" required value="<?php echo $row['login'] ?>">

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Informe seu e-mail" required value="<?php echo $row['email'] ?>">

        <button type="submit">Atualizar</button>
    </form>

</div>
<?php
    include("../config/rodape.php");
?>
