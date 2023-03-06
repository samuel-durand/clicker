<?php

include('./connect.php');

// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {
    // Récupération des données saisies par l'utilisateur
    $nom = htmlspecialchars($_POST['nom']);
    $password = htmlspecialchars($_POST['password']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);

    // Hashage du mot de passe avec l'algorithme Bcrypt
    $hash = password_hash($password, PASSWORD_BCRYPT);

    // Préparation de la requête d'insertion
    $insert = $bdd->prepare("INSERT INTO utilisateurs (nom, password, prenom, pseudo) VALUES (?, ?, ?, ?)");

    // Exécution de la requête d'insertion en bindant les valeurs pour éviter les injections SQL
    $insert->execute([$nom, $hash, $prenom, $pseudo]);

    // Redirection vers la page de connexion
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <?php include('./header.php') ?>
    <div class="padding-register">
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
    </div>
    <script>
  const form = document.querySelector('form');

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(form);

    fetch('register.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (response.ok) {
        window.location.replace('login.php');
      }
    })
    .catch(error => console.error(error));
  });
</script>


    <?php include('./footer.php') ?>
</body>
</html>
