<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Récupérer l'utilisateur avec cet email
    $query = 'SELECT * FROM user WHERE email = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie, on stocke les infos dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['pseudo'] = $user['pseudo'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Email ou mot de passe incorrect';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label for="email">Email :</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
