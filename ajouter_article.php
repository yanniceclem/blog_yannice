<?php
// Connexion à la base de données
$utilisateur = 'root'; 
$motdepasse = '';       
$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $utilisateur, $motdepasse);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Traitement du formulaire d'ajout d'article
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $editor = $_POST['editor'];
    $lien_image = $_POST['lien_image'];

    // Vérifier si les champs ne sont pas vides
    if (!empty($title) && !empty($editor)) {
        $query = 'INSERT INTO message (title, editor, lien_image) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $editor, $lien_image]);

        // Redirection vers la page d'accueil après ajout
        header('Location: index.php');
        exit();
    } else {
        echo "Tous les champs doivent être remplis!";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>
</head>
<body>
    <h1>Ajouter un Nouvel Article</h1>
    <form method="POST">
        <label for="title">Titre :</label>
        <input type="text" name="title" required>
        <br>
        <label for="editor">Votre pseudo :</label>
        <input type="text" name="editor" required>
        <br>
        <label for="lien_image">Image (URL) :</label>
        <input type="text" name="lien_image">
        <br>
        <button type="submit">Publier</button>
    </form>
</body>
</html>
