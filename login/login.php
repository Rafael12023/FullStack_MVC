<?php
header('Content-Type: application/json');

// Verifica se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura dados do formulário
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Verifica se o arquivo login.txt existe
    if (!file_exists('login.txt')) {
        echo json_encode(['status' => 'error', 'message' => 'Arquivo de login não encontrado.']);
        exit;
    }

    // Lê o conteúdo do login.txt
    $credenciais = trim(file_get_contents('login.txt')); // Ex: "rafael:123"

    // Separa usuário e senha
    list($usuarioSalvo, $senhaSalva) = explode(':', $credenciais);

    // Valida login
    if ($username === $usuarioSalvo && $password === $senhaSalva) {
        echo json_encode(['status' => 'success', 'message' => 'Login bem-sucedido!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuário ou senha inválidos.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método inválido.']);
}
