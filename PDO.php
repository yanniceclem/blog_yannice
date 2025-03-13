<?php
// Définir les informations de connexion
$utilisateur = 'root';  // Utilisateur par défaut sur Laragon
$motdepasse = '';       // Mot de passe par défaut (vide sur Laragon)

try {
    // Créer une instance de PDO pour une base de données MySQL
    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $utilisateur, $motdepasse);
    
    // Configuration des options PDO pour gérer les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Afficher un message de succès si la connexion est réussie
    echo 'Connexion réussie à la base de données !';
    
} catch (PDOException $e) {
    // Gérer les erreurs de connexion
    echo 'Erreur de connexion : ' . $e->getMessage();
}
