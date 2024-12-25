<?php
// Démarrer la session
session_start();

// Détruire toutes les variables de session
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil ou de connexion
header("location:index.php");

// Terminer le script pour éviter toute exécution supplémentaire
exit();
?>

?>