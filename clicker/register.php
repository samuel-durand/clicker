<?php
<<<<<<< HEAD

include('./connect.php');
=======
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Préparation de la requête d'insertion
$insert = $bdd->prepare("INSERT INTO utilisateurs (nom, password, prenom, pseudo) VALUES (?, ?, ?, ?)");
>>>>>>> 1f81579aab01d7be34e9a0bb281531b5ae4d9dc4

// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {
    // Récupération des données saisies par l'utilisateur
    $nom = htmlspecialchars($_POST['nom']);
    $password = htmlspecialchars($_POST['password']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);

<<<<<<< HEAD
    // Hashage du mot de passe avec l'algorithme Bcrypt
    $hash = password_hash($password, PASSWORD_BCRYPT);

    // Préparation de la requête d'insertion
    $insert = $bdd->prepare("INSERT INTO utilisateurs (nom, password, prenom, pseudo) VALUES (?, ?, ?, ?)");

    // Exécution de la requête d'insertion en bindant les valeurs pour éviter les injections SQL
    $insert->execute([$nom, $hash, $prenom, $pseudo]);

    // Redirection vers la page de connexion
    header("Location: login.php");
    exit();
=======
    // Exécution de la requête d'insertion en bindant les valeurs pour éviter les injections SQL
    $insert->execute([$nom, $password, $prenom, $pseudo]);

    // Affichage d'un message de confirmation
    echo "Enregistrement effectué avec succès !";
>>>>>>> 1f81579aab01d7be34e9a0bb281531b5ae4d9dc4
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <?php include('./header.php') ?>
    <h1>Inscription</h1>
    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required><br>

        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="submit" value="S'inscrire">
    </form>
</body>
</html>
=======
    <title>inscription</title>
</head>
<body>
<form method="POST">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" required><br>

    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" required><br>

    <input type="submit" name="submit" value="S'inscrire">
</form>
</body>
</html>
>>>>>>> 1f81579aab01d7be34e9a0bb281531b5ae4d9dc4
