<?php
class CreateDatabaseLogger
{
    private $pdo;

    public function __construct($host, $dbname, $user, $pass)
    {
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
        $this->pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function write($level, $message, $context = [])
    {
        $stmt = $this->pdo->prepare("INSERT INTO logs (level, message, context, created_at) VALUES (:level, :message, :context, NOW())");
        $stmt->execute([
            ':level' => strtoupper($level),
            ':message' => $message,
            ':context' => json_encode($context)
        ]);
    }
}
