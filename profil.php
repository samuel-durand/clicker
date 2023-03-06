<?php 



// Démarrage de la session
session_start();

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des données de l'utilisateur connecté
$id = $_SESSION['id'];
$select = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$select->execute([$id]);
$user = $select->fetch(PDO::FETCH_ASSOC);

// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {
    // Récupération des données saisies par l'utilisateur
    $password = htmlspecialchars($_POST['password']);
    $pseudo = htmlspecialchars($_POST['pseudo']);

    // Vérification des données saisies
    $errors = [];
    if (empty($password)) {
        $errors[] = "Le champ 'Nouveau mot de passe' est obligatoire.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }
    if (empty($pseudo)) {
        $errors[] = "Le champ 'Nouveau pseudo' est obligatoire.";
    } elseif (strlen($pseudo) < 3 || strlen($pseudo) > 20) {
        $errors[] = "Le pseudo doit contenir entre 3 et 20 caractères.";
    }

    // Si les données sont valides, mise à jour de la base de données
    if (empty($errors)) {
        // Hashage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparation de la requête de mise à jour
        $update = $bdd->prepare("UPDATE utilisateurs SET password = ?, pseudo = ? WHERE id = ?");

        // Exécution de la requête de mise à jour en bindant les valeurs pour éviter les injections SQL
        $update->execute([$hashed_password, $pseudo, $id]);

        // Redirection vers la page de profil avec un message de confirmation
        $_SESSION['success'] = "Vos informations ont été mises à jour avec succès.";
        header('Location: profil.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profil</title>
</head>
<body>
	<h1>Profil</h1>
	<form method="POST" >
		<label for="pseudo">Pseudo :</label>
		<input type="text" name="pseudo" required><br><br>
		<label for="password">Nouveau mot de passe :</label>
		<input type="password" name="password" required><br><br>
		<label for="confirm_password">Confirmer le nouveau mot de passe :</label>
		<input type="password" name="confirm_password" required><br><br>
		<input type="submit" value="Mettre à jour">
	</form>
</body>
</html>
