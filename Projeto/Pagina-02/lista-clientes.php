<?php
include '../conexao.php';

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="estilo-cliente.css">
</head>
<body>
    <header>
        <button class="nav-button" id="voltar-btn-left" onclick="location.href='../Pagina-01/tela-cadastro.html';">Cadastro</button>
    </header>

    <div class="container">
        <h1>Lista de Clientes</h1>
        <table id="listaClientes">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Modelo de Celular</th>
                    <th>Problema/Pedido</th>
                    <th>Valor (R$)</th>
                    <th>Data de Entrada</th>
                    <th>Data de Entrega</th>
                    <th>Progresso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $progresso = calcularProgresso($row["dataEntrada"], $row["dataEntrega"]);
                        $cor = calcularCor($progresso);
                        echo "<tr>
                                <td>{$row["nome"]}</td>
                                <td>{$row["modeloCelular"]}</td>
                                <td>{$row["problemaPedido"]}</td>
                                <td>R$ {$row["valor"]}</td>
                                <td>{$row["dataEntrada"]}</td>
                                <td>{$row["dataEntrega"]}</td>
                                <td><div class='progresso' style='width: $progresso%; background-color: $cor;'></div></td>
                                <td><button onclick='editarRegistro({$row["id"]})'>Editar</button>
                                    <button onclick='excluirRegistro({$row["id"]})'>Excluir</button></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum registro encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>Andre Junior<br>
        <a href="https://github.com/anndrehjr"><img src="/Imagens/image.png" width="30" height="30" alt="GitHub"></a></p>
    </footer>
</body>
</html>

<?php
$conn->close();

function calcularProgresso($dataEntrada, $dataEntrega) {
    $entrada = new DateTime($dataEntrada);
    $entrega = new DateTime($dataEntrega);
    $hoje = new DateTime();
    $totalDias = $entrega->diff($entrada)->days;
    $diasPassados = $hoje->diff($entrada)->days;

    $progresso = ($diasPassados / $totalDias) * 100;
    return min(max($progresso, 0), 100);
}

function calcularCor($progresso) {
    if ($progresso < 50) {
        return 'green';
    } elseif ($progresso < 75) {
        return 'yellow';
    } else {
        return 'red';
    }
}
?>
