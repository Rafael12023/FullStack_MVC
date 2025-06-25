<?php
class Livro {
    private $conn;
    public $table = "livro";

    public $id;
    public $titulo;
    public $autor;
    public $ano;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $stmt = $this->conn->query("SELECT * FROM $this->table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar() {
        $sql = "INSERT INTO $this->table (titulo, autor, ano) VALUES (:titulo, :autor, :ano)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function atualizar() {
        $sql = "UPDATE $this->table SET titulo = :titulo, autor = :autor, ano = :ano WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deletar() {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
