<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Liste des Commandes</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h2>Liste des Commandes</h2>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Client</th>
            <th>Total</th>
            <th>Date</th>
            <th>Opérations</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'include/database.php';
        $commandes = $pdo->query('SELECT commande.*,utilisateur.login as "login" FROM commande INNER JOIN utilisateur ON commande.id_client = utilisateur.id ORDER BY commande.date_creation DESC')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($commandes as $commande) {
            ?>
            <tr>
                <td><?php echo $commande['id'] ?></td>
                <td><?php echo $commande['login'] ?></td>
                <td><?php echo $commande['total'] ?> <i class="fa fa-solid fa-dollar"></i></td>
                <td><?php echo $commande['date_creation'] ?></td>
                <td><a class="btn btn-primary btn-sm" href="commande.php?id=<?php echo $commande['id']?>">Afficher détails</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>