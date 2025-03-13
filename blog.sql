-- Créer la base de données
CREATE DATABASE blog;

-- Utiliser la base de données
USE blog;

-- Créer la table 'user'
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,              -- identifiant unique
    pseudo VARCHAR(50) UNIQUE,                      -- pseudo unique
    password VARCHAR(255),                          -- mot de passe de l'utilisateur
    email VARCHAR(100) UNIQUE,                      -- email unique
    role VARCHAR(50)                                -- rôle de l'utilisateur
);

-- Créer la table 'message'
CREATE TABLE message (
    id INT AUTO_INCREMENT PRIMARY KEY,              -- identifiant unique pour chaque message
    title VARCHAR(50),                              -- titre du message
    editor_id INT,                                  -- référence à l'utilisateur (clé étrangère)
    lien_image VARCHAR(255),                        -- lien de l'image associée au message
    date_post TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- date de publication
    FOREIGN KEY (editor_id) REFERENCES user(id)     -- clé étrangère pour lier le message à un utilisateur
);
