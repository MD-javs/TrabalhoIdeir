-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS sistema_usuarios
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_general_ci;

-- Usar o banco
USE sistema_usuarios;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255) DEFAULT NULL
);

-- Criar tabela de fotos de usuários
CREATE TABLE foto_usuario (
    id_foto INT AUTO_INCREMENT PRIMARY KEY,
    nome_foto VARCHAR(255) NOT NULL,
    fk_usuario INT NOT NULL,
    data_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario_foto FOREIGN KEY (fk_usuario) 
        REFERENCES usuario(id_usuario)
        ON DELETE CASCADE
);
