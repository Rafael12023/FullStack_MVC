<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Normaliza a URI removendo query strings
$parsedUrl = parse_url($requestUri);
$path = rtrim($parsedUrl['path'], '/');

// Roteamento simples
switch ($path) {
    case '/login':
        if ($requestMethod === 'POST') {
            require_once __DIR__ . '/../controllers/login.controller.php'; // Aqui está o ajuste para login.controller.php
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Método não permitido.',
                'data' => null
            ]);
        }
        break;

    // Adicione outras rotas aqui se necessário
    default:
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Rota não encontrada.',
            'data' => null
        ]);
        break;
}
