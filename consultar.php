<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Clientes</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> <!-- SweetAlert CSS -->
    <link rel="stylesheet" type="text/css" href="consulta.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Clientes</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Documento</th>
                <th>Ações</th>
            </tr>
            <?php
            include 'conexao.php'; // Incluindo a conexão

            $sql = "SELECT * FROM clientes";
            $resultado = $conexao->query($sql);

            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    // Formatar a data de nascimento
                    $data_nascimento = DateTime::createFromFormat('Y-m-d', $row['data_nascimento']);
                    $data_formatada = $data_nascimento ? $data_nascimento->format('d/m/Y') : 'Data inválida';

                    echo "<tr>
                            <td>{$row['id_cliente']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['endereco']}</td>
                            <td>{$row['telefone']}</td>
                            <td>{$data_formatada}</td>
                            <td>{$row['documento']}</td>
                            <td>
                                <button onclick='editarCliente({$row['id_cliente']})'>Editar</button>
                                <button onclick='excluirCliente({$row['id_cliente']})'>Excluir</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum cliente encontrado</td></tr>";
            }

            $conexao->close(); // Fechar conexão
            ?>
        </table>

        <!-- Formulário de edição -->
        <div id="form-edicao" style="display:none;">
            <h2>Editar Cliente</h2>
            <?php include 'formulario_cliente.php'; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Sistema de Cadastro de Clientes. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> <!-- SweetAlert JS -->
    <script>
        function editarCliente(id) {
            document.getElementById('form-edicao').style.display = 'block';
            document.getElementById('id_cliente').value = id;
            // Preencher outros campos com os dados do cliente, se necessário
        }

        function excluirCliente(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Chamar um script PHP para excluir o cliente
                    window.location.href = `excluir_cliente.php?id_cliente=${id}`;
                }
            });
        }

        function fecharFormulario() {
            document.getElementById('form-edicao').style.display = 'none';
        }
    </script>
</body>
</html>
