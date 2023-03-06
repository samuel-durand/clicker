<?php
// Connexion à la base de données
include('./connect.php');
// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {
    // Récupération des données saisies par l'utilisateur
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

    // Récupération du mot de passe hashé correspondant au pseudo de l'utilisateur
    $stmt = $bdd->prepare("SELECT password FROM utilisateurs WHERE pseudo = ?");
    $stmt->execute([$pseudo]);
    $result = $stmt->fetch();

    // Vérification du mot de passe
    if ($result && password_verify($password, $result['password'])) {
        // Mot de passe correct, redirection vers la page d'accueil
        header('Location: clicker.php');
        exit;
    } else {
        // Mot de passe incorrect, affichage d'un message d'erreur
        echo "Pseudo ou mot de passe incorrect !";
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
    <?php include('./header.php') ?>
    <div class="padding-login">
    <form method="POST">
    <label for="pseudo">Pseudo :</label>
    <input type="text" name="pseudo" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required><br>

    <input type="submit" name="submit" value="Se connecter">

    </form>
    </div>
    <script>
  const form = document.querySelector('form');

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(form);

    fetch('login.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (response.ok) {
        window.location.replace('clicker.php');
      } else {
        console.error('Pseudo ou mot de passe incorrect !');
      }
    })
    .catch(error => console.error(error));
  });
</script>


    <?php include('./footer.php') ?>
</body>
</html>
