const listaClientes = document.getElementById('listaClientes');

async function carregarListaClientes() {
  const response = await fetch('/api/registros');
  const registros = await response.json();

  listaClientes.querySelector('tbody').innerHTML = '';

  registros.forEach((registro) => {
    const listItem = document.createElement('tr');

    listItem.innerHTML = `
      <td>${registro.nome}</td>
      <td>${registro.modeloCelular}</td>
      <td>${registro.problemaPedido}</td>
      <td>R$ ${registro.valor}</td>
      <td>${registro.dataEntrada}</td>
      <td>${registro.dataEntrega}</td>
      <td>
        <div class="progresso" style="width: ${calcularProgresso(registro.dataEntrada, registro.dataEntrega)}%; background-color: ${calcularCor(registro.dataEntrada, registro.dataEntrega)};"></div>
      </td>
      <td>
        <button onclick="editarRegistro(${registro.id})">Editar</button>
        <button onclick="excluirRegistro(${registro.id})">Excluir</button>
      </td>
    `;

    listaClientes.querySelector('tbody').appendChild(listItem);
  });
}

function calcularProgresso(dataEntrada, dataEntrega) {
  const entrada = new Date(dataEntrada);
  const entrega = new Date(dataEntrega);
  const hoje = new Date();
  const totalDias = (entrega - entrada) / (1000 * 60 * 60 * 24);
  const diasPassados = (hoje - entrada) / (1000 * 60 * 60 * 24);

  const progresso = (diasPassados / totalDias) * 100;
  return Math.min(Math.max(progresso, 0), 100); // Limita o valor entre 0 e 100
}

function calcularCor(dataEntrada, dataEntrega) {
  const progresso = calcularProgresso(dataEntrada, dataEntrega);
  if (progresso < 50) return '#00FF00'; // Verde
  if (progresso < 75) return '#FFFF00'; // Amarelo
  return '#FF0000'; // Vermelho
}

window.editarRegistro = async (id) => {
  const response = await fetch(`/api/registros/${id}`);
  const registro = await response.json();

  const novoNome = prompt("Digite o novo nome:", registro.nome);
  if (novoNome !== null) registro.nome = novoNome;

  const novoModeloCelular = prompt("Digite o novo modelo de celular:", registro.modeloCelular);
  if (novoModeloCelular !== null) registro.modeloCelular = novoModeloCelular;

  const novoProblemaPedido = prompt("Digite o novo problema/pedido:", registro.problemaPedido);
  if (novoProblemaPedido !== null) registro.problemaPedido = novoProblemaPedido;

  const novoValor = prompt("Digite o novo valor:", registro.valor);
  if (novoValor !== null) registro.valor = novoValor;

  const novaDataEntrada = prompt("Digite a nova data de entrada (YYYY-MM-DD):", registro.dataEntrada);
  if (novaDataEntrada !== null) registro.dataEntrada = novaDataEntrada;

  const novoTempoGasto = prompt("Digite o novo tempo gasto (dias):", registro.tempoGasto);
  if (novoTempoGasto !== null) {
    registro.tempoGasto = parseInt(novoTempoGasto, 10);
    const novaDataEntrega = new Date(novaDataEntrada);
    novaDataEntrega.setDate(novaDataEntrega.getDate() + registro.tempoGasto);
    registro.dataEntrega = novaDataEntrega.toISOString().split('T')[0];
  }

  await fetch(`/api/registros/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(registro),
  });

  carregarListaClientes();
};

window.excluirRegistro = async (id) => {
  if (confirm("Tem certeza que deseja excluir este registro?")) {
    await fetch(`/api/registros/${id}`, {
      method: 'DELETE',
    });
    carregarListaClientes();
  }
};

carregarListaClientes();
