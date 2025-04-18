<?php

require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../models/usuario.model.php';

function verificarCredenciais($username, $password) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario AND senha = :senha");
        $stmt->execute([
            ':usuario' => $username,
            ':senha' => $password
        ]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            $usuario = new Usuario($dados);
            return [
                'success' => true,
                'message' => 'Login bem-sucedido!',
                'data' => $usuario->toArray()
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Usuário ou senha inválidos.',
                'data' => null
            ];
        }
    } catch (PDOException $e) {
        return [
            'success' => false,
            'message' => 'Erro ao consultar o banco de dados.',
            'data' => null
        ];
    }
}

