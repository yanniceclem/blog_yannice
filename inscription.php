<?php
// Démarrage de la session (utile plus tard pour garder l'utilisateur connecté)
session_start();

$message = '';  // Variable pour stocker les messages à afficher

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $pseudo = trim($_POST['pseudo']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'email ou le pseudo existe déjà
        $checkQuery = 'SELECT id FROM user WHERE email = ? OR pseudo = ?';
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->execute([$email, $pseudo]);
        $existingUser = $checkStmt->fetch();

        if ($existingUser) {
            $message = "❌ Ce pseudo ou cet email est déjà utilisé.";
        } else {
            // Insertion de l'utilisateur dans la base de données
            $query = 'INSERT INTO user (pseudo, email, password) VALUES (?, ?, ?)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$pseudo, $email, $password]);

            // Redirection après inscription réussie
            $message = "✅ Inscription réussie! <a href='login.php'>Connectez-vous</a>";
        }
    } catch (PDOException $e) {
        $message = "⚠️ Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <!-- Affiche le message d'erreur ou de succès -->
    <?php if ($message): ?>
        <p style="color: <?= strpos($message, '✅') !== false ? 'green' : 'red'; ?>;">
            <?= $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" required>
        <br>
        <label for="email">Email :</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
