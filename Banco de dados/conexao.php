<?php
    
    //conectar com o banco usando PDO
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "app";
    $dsn = "mysql:host=$host;dbname=$banco;";

    try {
        $conexao = new PDO($dsn, $usuario, $senha);
    } catch (\PDOException $e) {
        throw new PDOException($e->getMessage());
    }
?>
