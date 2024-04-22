// Função para carregar e exibir a lista de clientes
function carregarListaClientes() {
    // Recupera os dados do localStorage
    var registros = JSON.parse(localStorage.getItem('registros')) || [];

    // Referência à lista onde os clientes serão exibidos
    var listaClientes = document.getElementById('listaClientes');

    // Limpa a lista antes de adicionar os novos itens
    listaClientes.innerHTML = '';

    // Itera sobre os registros e adiciona-os à lista
    registros.forEach(function(registro, index) {
        var listItem = document.createElement('li');
        var dataAtual = new Date().toLocaleDateString();
        listItem.innerHTML = 'Nome: ' + registro.nome + ', Modelo de Celular: ' + registro.modeloCelular + ', Problema/Pedido: ' + registro.problemaPedido + ', Valor: ' + registro.valor + ', Tempo: ' + registro.tempo + ', Data: ' + dataAtual;

        // Botão de editar
        var btnEditar = document.createElement('button');
        btnEditar.textContent = 'Editar';
        btnEditar.onclick = function() {
            editarRegistro(index);
        };
        listItem.appendChild(btnEditar);

        // Botão de excluir
        var btnExcluir = document.createElement('button');
        btnExcluir.textContent = 'Excluir';
        btnExcluir.onclick = function() {
            excluirRegistro(index);
        };
        listItem.appendChild(btnExcluir);

        listaClientes.appendChild(listItem);
    });
}

// Função para editar um registro
function editarRegistro(index) {
    var registros = JSON.parse(localStorage.getItem('registros')) || [];
    var registro = registros[index];

    var novoNome = prompt("Digite o novo nome:", registro.nome);
    if (novoNome !== null) {
        registro.nome = novoNome;
    }

    var novoModeloCelular = prompt("Digite o novo modelo de celular:", registro.modeloCelular);
    if (novoModeloCelular !== null) {
        registro.modeloCelular = novoModeloCelular;
    }

    var novoProblemaPedido = prompt("Digite o novo problema/pedido:", registro.problemaPedido);
    if (novoProblemaPedido !== null) {
        registro.problemaPedido = novoProblemaPedido;
    }

    var novoValor = prompt("Digite o novo valor:", registro.valor);
    if (novoValor !== null) {
        registro.valor = novoValor;
    }

    var novoTempo = prompt("Digite o novo tempo:", registro.tempo);
    if (novoTempo !== null) {
        registro.tempo = novoTempo;
    }

    localStorage.setItem('registros', JSON.stringify(registros));
    carregarListaClientes(); // Atualiza a lista de clientes após editar
}

// Função para excluir um registro
function excluirRegistro(index) {
    if (confirm("Tem certeza que deseja excluir este registro?")) {
        var registros = JSON.parse(localStorage.getItem('registros')) || [];
        registros.splice(index, 1);
        localStorage.setItem('registros', JSON.stringify(registros));
        carregarListaClientes(); // Atualiza a lista de clientes após excluir
    }
}

// Função para inicializar a página
function inicializarPagina() {
    carregarListaClientes();
}

// Chama a função para inicializar a página quando o documento estiver pronto
document.addEventListener('DOMContentLoaded', inicializarPagina);