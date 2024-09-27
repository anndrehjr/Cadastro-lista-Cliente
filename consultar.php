<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Clientes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Lista de Clientes</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Data de Nascimento</th>
            <th>Documento</th>
        </tr>
        <?php
        include 'conexao.php'; // Incluindo a conexão

        $sql = "SELECT * FROM clientes";
        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_cliente']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['endereco']}</td>
                        <td>{$row['telefone']}</td>
                        <td>{$row['data_nascimento']}</td>
                        <td>{$row['documento']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum cliente encontrado</td></tr>";
        }

        $conexao->close(); // Fechar conexão
        ?>
    </table>
</body>
</html>
