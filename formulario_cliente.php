<?php
// Verifica se o ID do cliente está sendo passado (para edição)
$nome = $endereco = $telefone = $data_nascimento = $documento = "";
$is_editing = false;

if (isset($cliente)) {
    // Supondo que $cliente seja um array com os dados do cliente
    $nome = $cliente['nome'];
    $endereco = $cliente['endereco'];
    $telefone = $cliente['telefone'];
    $data_nascimento = $cliente['data_nascimento'];
    $documento = $cliente['documento'];
    $is_editing = true;
}
?>

<form action="<?= $is_editing ? 'processar_edicao.php' : 'processar_cadastro.php' ?>" method="post" class="form-container">
    <?php if ($is_editing): ?>
        <input type="hidden" name="id" value="<?= $cliente['id'] ?>"> <!-- Campo oculto com o ID para a edição -->
    <?php endif; ?>

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required value="<?= $nome ?>" placeholder="Digite seu nome completo">

    <label for="endereco">Endereço (Rua, Número):</label>
    <input type="text" id="endereco" name="endereco" required value="<?= $endereco ?>" placeholder="Digite o endereço completo, incluindo o número">

    <label for="telefone">Celular:</label>
    <input type="tel" id="telefone" name="telefone" required value="<?= $telefone ?>" placeholder="(XX) XXXXX-XXXX" 
       pattern="\(\d{2}\) \d{5}-\d{4}" title="Digite o celular no formato: (XX) XXXXX-XXXX">

    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="date" id="data_nascimento" name="data_nascimento" required value="<?= $data_nascimento ?>">

    <label for="documento">CPF:</label>
    <input type="text" id="documento" name="documento" required value="<?= $documento ?>" placeholder="000.000.000-00" 
       pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite o CPF no formato: 000.000.000-00">

    <input type="submit" value="<?= $is_editing ? 'Atualizar' : 'Cadastrar' ?>" class="fade-button">
</form>
