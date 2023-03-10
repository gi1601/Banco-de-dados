<?php
    include("../config/cabecalho.php");
?>

<div class="container">
    <h1>Registro de usuário</h1>
    <form action="" method="POST" >
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required placeholder="Informe o seu nome">

        <label for="login">Login</label>
        <input type="text" name="login" id="login" required placeholder="Informe o login">

        <label for="email">E-Mail</label>
        <input type="email" name="email" id="email" required placeholder="Informe o seu E-mail">

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required placeholder="Informe a sua senha">

        <button type="submit">Registrar</button>
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
        $login = $_POST["login"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        //verificar se o login ou email já existem no banco
        $sql = "SELECT COUNT(*) AS total FROM usuario WHERE login = :login OR email = :email";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            "login" => $login,
            "email" => $email
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['total'] > 0){
            echo "<div class='error'>Login ou email já cadastrados</div>";
        }else{
            //inserir o novo usuário
            $sql = "INSERT INTO usuario(nome,login,email,senha) VALUES (:nome, :login, :email, :senha)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                "nome" => $nome,
                "login" => $login,
                "email" => $email,
                "senha" => $senha
            ]);

            if($stmt->rowCount() > 0){
                echo "<div class='success'>Usuário cadastrado com sucesso</div>";
            }else{
                echo "<div class='error'>Erro ao cadastrar o Usuário</div>";
            }
        }

        $conexao = null;
    }
?>