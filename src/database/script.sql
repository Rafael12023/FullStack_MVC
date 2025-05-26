CREATE DATABASE mvc_fullstack;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_hora DATETIME,
    nivel VARCHAR(20),
    mensagem TEXT,
    usuario VARCHAR(100),
    ip VARCHAR(45)
);
