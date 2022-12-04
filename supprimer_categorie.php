<?php
    require_once 'include/database.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('DELETE FROM categorie WHERE id=?');
    $supprime = $sqlState->execute([$id]);
    header('location: categories.php');