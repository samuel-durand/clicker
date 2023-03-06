<?php 

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=samuel-durand_clicker', 'samuel', 'V00^97sen');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}


?>