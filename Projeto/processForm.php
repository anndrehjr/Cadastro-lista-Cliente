<?php
// Substitua 'your_username' e 'your_password' pelas credenciais corretas
$conn = new mysqli('localhost', 'your_username', 'your_password', 'meubanco');

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receber dados do formulário
$nome = $_POST['nome'];
$modeloCelular = $_POST['modeloCelular'];
$problemaPedido = $_POST['problemaPedido'];
$valor = $_POST['valor'];
$dataEntrada = $_POST['dataEntrada'];

// Calcular a data de entrega
$tempoGasto = $_POST['tempoGasto'];
$dataEntradaObj = new DateTime($dataEntrada);
$dataEntregaObj = clone $dataEntradaObj;
$dataEntregaObj->modify("+$tempoGasto days");
$dataEntrega = $dataEntregaObj->format('Y-m-d');

// Inserir dados na tabela
$sql = "INSERT INTO clientes (nome, modeloCelular, problemaPedido, valor, dataEntrada, dataEntrega) VALUES ('$nome', '$modeloCelular', '$problemaPedido', '$valor', '$dataEntrada', '$dataEntrega')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
