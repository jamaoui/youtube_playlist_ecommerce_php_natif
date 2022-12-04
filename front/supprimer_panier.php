<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header('location: ../connexion.php');
}

$idUtilisateur = $_SESSION['utilisateur']['id'];

$id = $_POST['id'];
unset($_SESSION['panier'][$idUtilisateur][$id]);
header("location:".$_SERVER['HTTP_REFERER']);