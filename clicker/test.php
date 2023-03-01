<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {
    // Récupération des données saisies par l'utilisateur
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

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
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <!-- Formulaire d'authentification -->
<form method="POST">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required><br>

    <input type="submit" name="submit" value="Se connecter">
</form>
</body>
</html>