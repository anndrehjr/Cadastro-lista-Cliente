<?php
// Arquivo: conexao.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro-cliente";

// Criar conexão
$conexao = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}
?>
