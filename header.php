<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="header.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <?php
        session_start(); // Démarre une session
        include './connect.php'; // Inclut le fichier de connexion à la base de données

        if(isset($_SESSION['user_id'])) {
          // L'utilisateur est connecté
          $user_id = $_SESSION['user_id'];
          // Récupérer les informations de l'utilisateur connecté depuis la base de données
          $sql = "SELECT id, pseudo, password FROM utilisateurs WHERE id = '$user_id'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_pseudo = $row['pseudo'];
            ?>
            <li><a href="./logout.php">Déconnexion</a></li>
            <li><span>Bonjour, <?php echo $user_pseudo; ?></span></li>
            <?php
          }
        } else {
          // L'utilisateur n'est pas connecté
          ?>
          <li><a href="./index.php">Accueil</a></li>
          <li><a href="./register.php">Inscription</a></li>
          <li><a href="./login.php">Connexion</a></li>
          <li><a href="./logout.php">Déconnexion</a></li>
          <?php
        }
        ?>
        <li><a href="./clicker.php">Clicker Game</a></li>
      </ul>
    </nav>
  </header>
</body>
</html>
