<?php
// Connexion à la base de données
<<<<<<< HEAD
include('./connect.php');
=======
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

>>>>>>> 1f81579aab01d7be34e9a0bb281531b5ae4d9dc4
// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {
    // Récupération des données saisies par l'utilisateur
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

<<<<<<< HEAD
    // Récupération du mot de passe hashé correspondant au pseudo de l'utilisateur
    $stmt = $bdd->prepare("SELECT password FROM utilisateurs WHERE pseudo = ?");
    $stmt->execute([$pseudo]);
    $result = $stmt->fetch();

    // Vérification du mot de passe
    if ($result && password_verify($password, $result['password'])) {
        // Mot de passe correct, redirection vers la page d'accueil
        header('Location: index.php');
        exit;
    } else {
        // Mot de passe incorrect, affichage d'un message d'erreur
        echo "Pseudo ou mot de passe incorrect !";
=======
    // Préparation de la requête de sélection
    $select = $bdd->prepare("SELECT id, nom, prenom FROM utilisateurs WHERE pseudo=? AND password=?");

    // Exécution de la requête en bindant les valeurs pour éviter les injections SQL
    $select->execute([$pseudo, $password]);

    // Récupération du résultat de la requête
    $result = $select->fetch();

    // Vérification de l'existence de l'utilisateur et affichage d'un message correspondant
    if ($result) {
        echo "Bonjour " . $result['prenom'] . " " . $result['nom'] . " !";
    } else {
        echo "Identifiants incorrects.";
>>>>>>> 1f81579aab01d7be34e9a0bb281531b5ae4d9dc4
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Authentification</title>
</head>
<body>
    <?php include('./header.php') ?>
=======
    <title>login</title>
</head>
<body>
    <!-- Formulaire d'authentification -->
>>>>>>> 1f81579aab01d7be34e9a0bb281531b5ae4d9dc4
<form method="POST">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required><br>

    <input type="submit" name="submit" value="Se connecter">
</form>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 1f81579aab01d7be34e9a0bb281531b5ae4d9dc4
