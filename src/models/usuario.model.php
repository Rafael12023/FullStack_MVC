<?php

class Usuario {
    public $id;
    public $usuario;
    public $senha;

    public function __construct($dados) {
        $this->id = $dados['id'] ?? null;
        $this->usuario = $dados['usuario'] ?? null;
        $this->senha = $dados['senha'] ?? null;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'usuario' => $this->usuario,
            'senha' => $this->senha,
        ];
    }
}
