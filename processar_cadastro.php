<?php
// Arquivo: processar_cadastro.php
include 'conexao.php'; // Incluindo a conexão

// Receber dados do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';
$documento = isset($_POST['documento']) ? $_POST['documento'] : '';

// Inserir dados no banco de dados
$sql = "INSERT INTO clientes (nome, endereco, telefone, data_nascimento, documento) VALUES ('$nome', '$endereco', '$telefone', '$data_nascimento', '$documento')";

if ($conexao->query($sql) === TRUE) {
    $mensagem = "Cliente cadastrado com sucesso!";
    $tipo_mensagem = "sucesso"; // Define o tipo de mensagem como sucesso
} else {
    $mensagem = "Erro: " . $conexao->error;
    $tipo_mensagem = "erro"; // Define o tipo de mensagem como erro
}

$conexao->close(); // Fechar conexão
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            background: linear-gradient(to right, rgba(255, 103, 102, 0.8), rgba(255, 255, 255, 0.8));
        }

        .mensagem {
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            margin-bottom: 20px;
            display: inline-block;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.5s forwards; /* Animação ao aparecer */
            opacity: 0;
            transform: translateY(-20px);
        }

        .sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert() {
            Swal.fire({
                title: 'Sucesso!',
                text: "Você foi cadastrado com sucesso!",
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redireciona para index.php
                    window.location.href = "index.php";
                }
            });
        }
    </script>
</head>
<body onload="showAlert()">
    <div class="text-center">
        <div class="mensagem <?php echo $tipo_mensagem; ?>">
            <?php echo $mensagem; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



