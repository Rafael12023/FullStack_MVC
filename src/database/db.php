<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Corrigido o caminho
require_once __DIR__ . '/../logs/logger.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../'); // Carrega o .env da raiz
$dotenv->load();

$host = $_ENV['DB_HOST'];
$db   = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

try {
    // Tentando conectar ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    registrarLogBanco('SUCESSO', 'Conexao com o banco bem sucedida');
    // Se a conexão for bem-sucedida, exibe esta mensagem
    //echo json_encode(['status' => 'success', 'message' => 'Conexao bem-sucedida com o banco de dados!']);
    
} catch (PDOException $e) {
    // Se ocorrer algum erro na conexão, exibe uma mensagem de erro
    die(json_encode(['status' => 'error', 'message' => 'Erro de conexao com o banco: ' . $e->getMessage()]));
}
