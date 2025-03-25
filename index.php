<?php
// Connexion à la base de données
$utilisateur = 'root'; 
$motdepasse = '';       
$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $utilisateur, $motdepasse);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer les articles
$query = 'SELECT * FROM message ORDER BY date_post DESC';
$stmt = $pdo->query($query);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog</title>
</head>
<body>
    <h1>Bienvenue sur mon Blog</h1>
    
    <?php if (isset($_SESSION['pseudo'])): ?>
        <p>Bienvenue, <?= htmlspecialchars($_SESSION['pseudo']); ?> !</p>
        <a href="logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="login.php">Connexion</a> | <a href="test_connexion.php">Connexion test</a> | <a href="inscription.php">Inscription</a>
    <?php endif; ?>

    
    <?php foreach ($messages as $message): ?>
        <div>
            <h2><?php echo htmlspecialchars($message['title']); ?></h2>
            <p><em>Publié le <?php echo $message['date_post']; ?></em></p>
            <img src="<?php echo htmlspecialchars($message['lien_image']); ?>" alt="Image du message" style="width: 200px; height: auto;">
            <p><?php echo nl2br(htmlspecialchars($message['editor'])); ?></p>
        </div>
    <?php endforeach; ?>
    
</body>
</html>
