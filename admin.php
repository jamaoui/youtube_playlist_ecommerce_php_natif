<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Admin</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <?php
        if(!isset($_SESSION['utilisateur'])){
            header('location: connexion.php');
        }
    ?>

        <h3> Bonjour <?php echo $_SESSION['utilisateur']['login'] ?></h3>
</div>

</body>
</html>