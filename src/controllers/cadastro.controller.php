<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../repositories/cadastro.repository.php'; // Usa o repository de cadastro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Usuário e senha são obrigatórios.',
            'data' => null
        ]);
        exit;
    }

    $resultado = cadastrarUsuario($username, $password);

    echo json_encode($resultado);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método inválido.',
        'data' => null
    ]);
}
