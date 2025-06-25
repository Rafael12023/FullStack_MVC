<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../repositories/livro.repository.php';

global $pdo;
$db = $pdo;
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove o prefixo do projeto
$base = '/FullStack_MVC';
$rota = str_replace($base, '', $uri);
$dados = json_decode(file_get_contents("php://input"), true);

if ($rota === '/livros' && $method === 'GET') {
    echo json_encode(consultarLivros($db));
} elseif ($rota === '/livros' && $method === 'POST') {
    if (empty($dados['titulo']) || empty($dados['autor']) || empty($dados['ano'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Título, autor e ano são obrigatórios.',
            'data' => null
        ]);
        exit;
    }
    if ($dados['ano'] >= 1970) {

        echo json_encode(criarLivro($db, $dados));
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Só é permitido livros com publicação a partir de 1970.',
            'data' => null,
        ]);
    }
} elseif (preg_match('#^/livros/(\d+)$#', $rota, $match)) {
    $id = (int) $match[1];

    if ($method === 'GET') {
        echo json_encode(consultarLivroPorId($db, $id));
    } elseif ($method === 'PUT') {
        if (empty($dados['titulo']) || empty($dados['autor']) || empty($dados['ano'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Título, autor e ano são obrigatórios.',
                'data' => null
            ]);
            exit;
        }

        if ($dados['ano'] >= 1970) {

            echo json_encode(editarLivro($db, $id, $dados));
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Só é permitido livros com publicação a partir de 1970.',
                'data' => null,
            ]);
        }
        
    } elseif ($method === 'DELETE') {
        echo json_encode(removerLivro($db, $id));
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Método não permitido.',
            'data' => null
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Rota não encontrada.',
        'data' => $rota
    ]);
}
