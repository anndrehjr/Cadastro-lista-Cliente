<?php
// Arquivo: processar_cadastro.php
include 'conexao.php'; // Incluindo a conexão

// Receber dados do formulário
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$data_nascimento = $_POST['data_nascimento'];
$documento = $_POST['documento'];

// Inserir dados no banco de dados
$sql = "INSERT INTO clientes (nome, endereco, telefone, data_nascimento, documento) VALUES ('$nome', '$endereco', '$telefone', '$data_nascimento', '$documento')";

if ($conexao->query($sql) === TRUE) {
    echo "Cliente cadastrado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conexao->error;
}

$conexao->close(); // Fechar conexão
?>
