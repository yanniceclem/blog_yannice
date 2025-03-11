CREATE DATABASE blog;

USE blog;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- identifiant unique, avec auto-incrémentation
    pseudo VARCHAR(50) UNIQUE,           -- pseudo de l'utilisateur
    password VARCHAR(255),               -- mdp de l'utilisateur
    email VARCHAR(100) UNIQUE,           -- email de l'utilisateur, unique
    role VARCHAR(50),
);

CREATE TABLE message (
    title VARCHAR(50),                              -- titre du msg
    editor VARCHAR(50) UNIQUE,                      -- pseudo de l'éditeur du msg
    image VARCHAR(255),                             -- lien de l'image 
    date_post TIMESTAMP DEFAULT CURRENT_TIMESTAMP   -- date de création du compte
);
