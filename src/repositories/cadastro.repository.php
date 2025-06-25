<?php

require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../models/usuario.model.php';
require_once __DIR__ . '/../logs/logger.php';

function cadastrarUsuario($username, $password) {
    global $pdo;

    try {
        // Verifica se o usuário já existe
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
        $stmt->execute([':usuario' => $username]);
        $dadosConsulta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dadosConsulta) {
            registrarLogBanco('ERRO', 'Já existe um usuário registrado com esse nome!', $username);
            return [
                'success' => false,
                'message' => 'Já existe um usuário com esse nome!',
                'data' => null
            ];
        }

        // Gera hash da senha
        $senhaHash = password_hash($password, PASSWORD_DEFAULT);

        // Insere novo usuário
        $stmt = $pdo->prepare("INSERT INTO usuario (usuario, senha) VALUES (:usuario, :senha)");
        $stmt->execute([
            ':usuario' => $username,
            ':senha' => $senhaHash
        ]);

        $novoUsuario = new Usuario([
            'id' => $pdo->lastInsertId(),
            'usuario' => $username,
            'senha' => $senhaHash
        ]);

        registrarLogBanco('SUCESSO', 'Usuário registrado com sucesso!', $username);

        return [
            'success' => true,
            'message' => 'Usuário registrado com sucesso.',
            'data' => $novoUsuario->toArray()
        ];
    } catch (PDOException $e) {
        registrarLogBanco('ERRO', 'Erro ao registrar no BANCO DE DADOS');
        return [
            'success' => false,
            'message' => 'Erro ao registrar o usuário.',
            'data' => null
        ];
    }
}
