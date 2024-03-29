CREATE DATABASE IF NOT EXISTS TestePHP CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
 
USE TestePHP;
 
CREATE TABLE pessoas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
);



CREATE TABLE emails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pessoa_id INT,
    email VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    FOREIGN KEY (pessoa_id) REFERENCES pessoas(id)
    ON DELETE CASCADE
);

CREATE TABLE telefones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pessoa_id INT,
    telefone VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    FOREIGN KEY (pessoa_id) REFERENCES pessoas(id)
    ON DELETE CASCADE
);

CREATE TABLE whatsapps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pessoa_id INT,
    whatsapp VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
    FOREIGN KEY (pessoa_id) REFERENCES pessoas(id)
    ON DELETE CASCADE
);