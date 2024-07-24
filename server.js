const express = require('express');
const sqlite3 = require('sqlite3').verbose();
const bodyParser = require('body-parser');
const app = express();
const port = 3000;

// Configuração do body-parser para receber requisições JSON
app.use(bodyParser.json());

// Conexão com o banco de dados SQLite
const db = new sqlite3.Database(':memory:');

// Criação da tabela
db.serialize(() => {
  db.run(`
    CREATE TABLE registros (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      nome TEXT,
      modeloCelular TEXT,
      problemaPedido TEXT,
      valor REAL,
      dataEntrada TEXT,
      dataEntrega TEXT
    )
  `);
});

// Endpoint para buscar todos os registros
app.get('/api/registros', (req, res) => {
  db.all('SELECT * FROM registros', (err, rows) => {
    if (err) {
      res.status(500).send(err);
    } else {
      res.json(rows);
    }
  });
});

// Endpoint para criar um novo registro
app.post('/api/registros', (req, res) => {
  const { nome, modeloCelular, problemaPedido, valor, dataEntrada, dataEntrega } = req.body;
  db.run(`
    INSERT INTO registros (nome, modeloCelular, problemaPedido, valor, dataEntrada, dataEntrega)
    VALUES (?, ?, ?, ?, ?, ?)
  `, [nome, modeloCelular, problemaPedido, valor, dataEntrada, dataEntrega], function(err) {
    if (err) {
      res.status(500).send(err);
    } else {
      res.json({ id: this.lastID });
    }
  });
});

// Endpoint para atualizar um registro
app.put('/api/registros/:id', (req, res) => {
  const { id } = req.params;
  const { nome, modeloCelular, problemaPedido, valor, dataEntrada, dataEntrega } = req.body;
  db.run(`
    UPDATE registros
    SET nome = ?, modeloCelular = ?, problemaPedido = ?, valor = ?, dataEntrada = ?, dataEntrega = ?
    WHERE id = ?
  `, [nome, modeloCelular, problemaPedido, valor, dataEntrada, dataEntrega, id], function(err) {
    if (err) {
      res.status(500).send(err);
    } else {
      res.json({ changes: this.changes });
    }
  });
});

// Endpoint para excluir um registro
app.delete('/api/registros/:id', (req, res) => {
  const { id } = req.params;
  db.run('DELETE FROM registros WHERE id = ?', [id], function(err) {
    if (err) {
      res.status(500).send(err);
    } else {
      res.json({ changes: this.changes });
    }
  });
});

app.listen(port, () => {
  console.log(`Servidor rodando em http://localhost:${port}`);
});
