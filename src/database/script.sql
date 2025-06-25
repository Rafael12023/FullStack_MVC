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

CREATE TABLE Categoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Livro (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    ano INT,
    paginas INT,
    disponivel BOOLEAN DEFAULT TRUE,
    categoriaId INT,
    FOREIGN KEY (categoriaId) REFERENCES Categoria(id)
);
