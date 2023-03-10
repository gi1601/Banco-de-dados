<?php

    include("../config/cabecalho.php");
    include("../conexao.php");

    $sql = "SELECT id, nome, razaosocial, cnpj, tipoempresa, cpf FROM fornecedores";

    $resultado = $conexao->query($sql);

    if($resultado->rowCount() > 0){
        echo "<table border=1";
        echo "
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Tipo Empresa</th>
                <th>CPF</th>
            </tr>
        ";
        foreach($resultado as $row){
            echo "<tr>";
            echo "<td>" .$row['id']. "</td>";
            echo "<td>" .$row['nome']. "</td>";
            echo "<td>" .$row['razaosocial']. "</td>";
            echo "<td>" .$row['cnpj']. "</td>";
            echo "<td>" .$row['tipoempresa']. "</td>";
            echo "<td>" .$row['cpf']. "</td>";
            echo '<td><a href="TelaEditarFornecedor.php?id='.$row['id'].'">Editar</a></td>';
            echo '<td><a href="ExcluirFornecedor.php?id='.$row['id'].'">Deletar</a></td>';
        }
        echo "</table>";
    }

    include("../config/rodape.php");
?>