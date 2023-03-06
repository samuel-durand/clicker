<?php
// Inclusion du fichier de connexion à la base de données
require_once('connect.php');

// Initialisation des variables
$message = '';

// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {
    // Récupération des données saisies par l'utilisateur
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

    // Récupération du mot de passe hashé correspondant au pseudo de l'utilisateur
    $stmt = $bdd->prepare("SELECT id, pseudo, password FROM utilisateurs WHERE pseudo = ?");
    $stmt->execute([$pseudo]);
    $result = $stmt->fetch();

    // Vérification du mot de passe
    if ($result && password_verify($password, $result['password'])) {
        // Mot de passe correct, affichage du message de bienvenue avec le pseudo
        $message = "Bienvenue, " . $result['pseudo'] . " !";
        // Début de la session utilisateur
        session_start();
        // Stockage des données utilisateur dans la session
        $_SESSION['id'] = $result['id'];
        $_SESSION['pseudo'] = $result['pseudo'];
        // Redirection vers la page d'accueil
        header('Location: clicker.php');
        exit;
    } else {
        // Mot de passe incorrect, affichage d'un message d'erreur
        $message = "Pseudo ou mot de passe incorrect !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Authentification</title>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="padding-login">
        <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
        <form method="POST">
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" required><br>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required><br>

            <input type="submit" name="submit" value="Se connecter">
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
