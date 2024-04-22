     // Função para adicionar os dados do formulário à lista no localStorage
     function adicionarDados() {
        var nome = document.getElementById('nome').value;
        var modeloCelular = document.getElementById('modeloCelular').value;
        var problemaPedido = document.getElementById('problemaPedido').value;
        var valor = document.getElementById('valor').value;
        var tempo = document.getElementById('tempo').value;

        // Cria um objeto com os dados do formulário
        var novoRegistro = {
            nome: nome,
            modeloCelular: modeloCelular,
            problemaPedido: problemaPedido,
            valor: valor,
            tempo: tempo
        };

        // Recupera a lista de registros do localStorage ou cria uma nova lista vazia
        var registros = JSON.parse(localStorage.getItem('registros')) || [];

        // Adiciona o novo registro à lista
        registros.push(novoRegistro);

        // Salva a lista atualizada no localStorage
        localStorage.setItem('registros', JSON.stringify(registros));

        // Limpa os campos do formulário após adicionar os dados
        document.getElementById('nome').value = '';
        document.getElementById('modeloCelular').value = '';
        document.getElementById('problemaPedido').value = '';
        document.getElementById('valor').value = '';
        document.getElementById('tempo').value = '';

        // Exibe uma mensagem de sucesso
        alert('Dados adicionados com sucesso!');
    }

    // Captura o evento de envio do formulário
    document.getElementById('cadastroForm').addEventListener('submit', function(event) {
        // Impede o envio padrão do formulário
        event.preventDefault();
        // Chama a função para adicionar os dados
        adicionarDados();
    });