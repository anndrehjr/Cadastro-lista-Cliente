<?php
// Incluir o arquivo de conexão
include 'conexao.php';

// Inicializar variáveis de mensagem
$mensagem = "";
$tipo_mensagem = "";

// Verificar se o ID do cliente foi passado
if (isset($_GET['id_cliente'])) {
    // Sanitize o ID do cliente para evitar SQL Injection
    $id_cliente = intval($_GET['id_cliente']); // Converte para inteiro

    // Preparar a instrução SQL para excluir o cliente
    $sql = "DELETE FROM clientes WHERE id_cliente = ?";
    
    // Usar uma declaração preparada para evitar SQL Injection
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_cliente); // 'i' indica que estamos passando um inteiro

    // Executar a consulta
    if ($stmt->execute()) {
        // Exclusão bem-sucedida
        $mensagem = "Cliente excluído com sucesso.";
        $tipo_mensagem = "sucesso";
    } else {
        // Em caso de erro ao excluir
        $mensagem = "Erro ao excluir cliente.";
        $tipo_mensagem = "erro";
    }

    $stmt->close(); // Fechar a declaração
}

// Fechar a conexão
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Exclusão</title>
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
        function showAlert(mensagem, tipo) {
            Swal.fire({
                title: tipo === 'sucesso' ? 'Sucesso!' : 'Erro!',
                text: mensagem,
                icon: tipo,
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
<body onload="showAlert('<?php echo $mensagem; ?>', '<?php echo $tipo_mensagem; ?>')">
    <div class="text-center">
        <div class="mensagem <?php echo $tipo_mensagem; ?>">
            <?php echo $mensagem; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
