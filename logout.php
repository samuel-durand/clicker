<?php
session_start(); // Démarre une session

include 'connect.php'; // Inclut le fichier de connexion à la base de données

if(isset($_SESSION['user_id'])) {
  // L'utilisateur est connecté
  $_SESSION = array(); // Réinitialise la session
  session_destroy(); // Détruit la session
  header("Location: ./index.php"); // Redirige vers la page d'accueil
  exit();
} else {
  // L'utilisateur n'est pas connecté
  header("Location: ./index.php"); // Redirige vers la page d'accueil
  exit();
}
?>
