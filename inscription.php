<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Hacher le mot de passe avant de l'enregistrer

    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insertion de l'utilisateur dans la base de données
    $query = 'INSERT INTO user (pseudo, email, password) VALUES (?, ?, ?)';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$pseudo, $email, $password]);

    // Redirection après inscription
    echo "Inscription réussie! <a href='login.php'>Connectez-vous</a>";
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
