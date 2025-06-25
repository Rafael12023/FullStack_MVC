<?php
require_once __DIR__ . '/../models/livro.model.php';

function criarLivro($db, $dados) {
  $livro = new Livro($db);
  $livro->titulo = $dados['titulo'];
  $livro->autor = $dados['autor'];
  $livro->ano = $dados['ano'];
  return [
    'success' => true,
    'message' => 'Livro criado com sucesso',
    'data' => $livro->criar()
  ];
}

function consultarLivros($db) {
  $livro = new Livro($db);
  return [
    'success' => true,
    'message' => 'Livros listados com sucesso',
    'data' => $livro->listar()
  ];
}

function consultarLivroPorId($db, $id) {
  $livro = new Livro($db);
  return [
    'success' => true,
    'message' => 'Livro listado com sucesso',
    'data' => $livro->buscar($id)
  ];
}

function editarLivro($db, $id, $dados) {
  $livro = new Livro($db);
  $livro->id = $id;
  $livro->titulo = $dados['titulo'];
  $livro->autor = $dados['autor'];
  $livro->ano = $dados['ano'];
  return [
    'success' => true,
    'message' => 'Livro atualizado com sucesso',
    'data' => $livro->atualizar()
  ];
}

function removerLivro($db, $id) {
  $livro = new Livro($db);
  $livro->id = $id;
  return [
    'success' => true,
    'message' => 'Livro deletado com sucesso',
    'data' => $livro->deletar()
  ];
}
