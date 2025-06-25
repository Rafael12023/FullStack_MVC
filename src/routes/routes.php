<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = '/FullStack_MVC'; // ajuste para o nome da pasta raiz do seu projeto
$rota = str_replace($base, '', $uri); // resultado: "/livros", "/livros/5", etc
$method = $_SERVER['REQUEST_METHOD'];
switch (true) {
    case $rota === '/login' && $method === 'POST':
        require_once __DIR__ . '/../controllers/login.controller.php';
        break;

    case $rota === '/cadastro' && $method === 'POST':
        require_once __DIR__ . '/../controllers/cadastro.controller.php';
        break;

    case $rota === '/livros' && in_array($method, ['GET', 'POST']):
    case preg_match('#^/livros/\d+$#', $rota) && in_array($method, ['GET', 'PUT', 'DELETE']):
        require_once __DIR__ . '/../controllers/livro.controller.php';
        break;

    default:
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Rota não encontrada',
            'data' => $rota // mostra o que está sendo analisado
        ]);
        break;
}