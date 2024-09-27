function formatCPF(cpf) {
    // Remove qualquer caractere que não seja número
    cpf = cpf.replace(/\D/g, "");

    // Formata o CPF com pontos e traço: XXX.XXX.XXX-XX
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    return cpf;
}

document.getElementById('documento').addEventListener('input', function (e) {
    e.target.value = formatCPF(e.target.value);
});

function formatarTelefone(telefone) {
    // Remove qualquer caractere que não seja número
    telefone = telefone.replace(/\D/g, "");

    // Formata o telefone no padrão (XX) XXXXX-XXXX
    telefone = telefone.replace(/^(\d{2})(\d)/, "($1) $2");
    telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2");

    return telefone;
}

document.getElementById('telefone').addEventListener('input', function (e) {
    e.target.value = formatarTelefone(e.target.value);
});
