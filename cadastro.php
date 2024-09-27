<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap"> <!-- Importando fonte Roboto -->
    <link rel="stylesheet" type="text/css" href="cadastro.css">
</head>
<body>
    <h1>Cadastro de Novo Cliente</h1>
    <form action="processar_cadastro.php" method="post" class="form-container">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required placeholder="Digite seu nome completo">

        <label for="endereco">Endereço (Rua, Número):</label>
        <input type="text" id="endereco" name="endereco" required placeholder="Digite o endereço completo, incluindo o número">

        <label for="telefone">Celular:</label>
        <input type="tel" id="telefone" name="telefone" required placeholder="(XX) XXXXX-XXXX" 
           pattern="\(\d{2}\) \d{5}-\d{4}" title="Digite o celular no formato: (XX) XXXXX-XXXX">

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>

        <label for="documento">CPF:</label>
        <input type="text" id="documento" name="documento" required placeholder="000.000.000-00" 
           pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite o CPF no formato: 000.000.000-00">

        <input type="submit" value="Cadastrar" class="fade-button">
    </form>

    <footer>
        <p>&copy; 2024 Sistema de Cadastro de Clientes. Todos os direitos reservados.</p>
    </footer>

    <script src="script.js"></script> 
</body>
</html>
