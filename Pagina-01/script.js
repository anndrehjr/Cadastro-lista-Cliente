document.getElementById('cadastroForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const nome = document.getElementById('nome').value;
  const modeloCelular = document.getElementById('modeloCelular').value;
  const problemaPedido = document.getElementById('problemaPedido').value;
  const valor = document.getElementById('valor').value;
  const dataEntrada = document.getElementById('dataEntrada').value;
  const tempoGasto = parseInt(document.getElementById('tempoGasto').value, 10);

  const dataEntradaObj = new Date(dataEntrada);
  const dataEntregaObj = new Date(dataEntradaObj);
  dataEntregaObj.setDate(dataEntradaObj.getDate() + tempoGasto);
  const dataEntrega = dataEntregaObj.toISOString().split('T')[0];

  const novoRegistro = { nome, modeloCelular, problemaPedido, valor, dataEntrada, tempoGasto, dataEntrega };

  const registros = JSON.parse(localStorage.getItem('registros')) || [];
  registros.push(novoRegistro);
  localStorage.setItem('registros', JSON.stringify(registros));

  document.getElementById('cadastroForm').reset();

  alert('Dados adicionados com sucesso! Você será redirecionado para a lista de clientes.');
  window.location.href = 'lista-clientes.html';
});
