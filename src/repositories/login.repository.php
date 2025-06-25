<?php

require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../models/usuario.model.php';
require_once __DIR__ . '/../logs/logger.php';

function verificarLoginComHash($username, $password) {
    global $pdo;

    try {
        // Busca o usuário pelo nome
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
        $stmt->execute([':usuario' => $username]);
        $dadosConsulta = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dadosConsulta) {
            registrarLogBanco('ERRO', 'Usuário não encontrado no login.', $username);
            return [
                'success' => false,
                'message' => 'Usuário ou senha inválidos.',
                'data' => null
            ];
        }

        // Verifica a senha usando password_verify
        if (!password_verify($password, $dadosConsulta['senha'])) {
            registrarLogBanco('ERRO', 'Senha incorreta no login.', $username);
            return [
                'success' => false,
                'message' => 'Usuário ou senha inválidos.',
                'data' => null
            ];
        }

        $usuario = new Usuario($dadosConsulta);
        registrarLogBanco('SUCESSO', 'Login realizado com sucesso!', $username);

        return [
            'success' => true,
            'message' => 'Login realizado com sucesso.',
            'data' => $usuario->toArray()
        ];

    } catch (PDOException $e) {
        registrarLogBanco('ERRO', 'Erro ao consultar no BANCO DE DADOS durante login.', $username);
        return [
            'success' => false,
            'message' => 'Erro ao consultar o banco de dados.',
            'data' => null
        ];
    }
}
