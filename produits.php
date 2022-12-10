<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Liste des produits</title>
</head>
<body>
<?php include 'include/nav.php' ?>
<div class="container py-2">
    <h2>Liste des produits</h2>
    <a href="ajouter_produit.php" class="btn btn-primary">Ajouter produit</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Libelle</th>
                <th>Prix</th>
                <th>Discount</th>
                <th>Catégorie</th>
                <th>Image</th>
                <th>Date de création</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
        <?php
        require_once 'include/database.php';
        $categories = $pdo->query("SELECT produit.*,categorie.libelle as 'categorie_libelle' FROM produit INNER JOIN categorie ON produit.id_categorie = categorie.id")->fetchAll(PDO::FETCH_OBJ);
        foreach ($categories as $produit){
            $prix = $produit->prix;
            $discount = $produit->discount;
            $prixFinale = $prix - (($prix*$discount)/100);
            ?>
            <tr>
                <td><?= $produit->id ?></td>
                <td><?= $produit->libelle ?></td>
                <td><?= $prix ?> <i class="fa fa-solid fa-dollar"></i></td>
                <td><?= $discount ?> %</td>
                <td><?= $produit->categorie_libelle ?></td>
                <td><?= $produit->date_creation ?></td>
                <td><img class="img-fluid" width="90" src="upload/produit/<?= $produit->image ?>" alt="<?= $produit->libelle ?>"></td>
                <td>
                    <a class="btn btn-primary" href="modifier_produit.php?id=<?php echo $produit->id ?>">Modifier</a>
                    <a class="btn btn-danger" href="supprimer_produit.php?id=<?php echo $produit->id ?>" onclick="return confirm('Voulez vous vraiment supprimer le produit <?php echo $produit->libelle?> ?')">Supprimer</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>