<!doctype html>
<html lang="en">
<head>
    <?php include 'include/head.php' ?>
    <title>Modifier produit</title>
</head>
<body>
<?php
require_once 'include/database.php';
include 'include/nav.php' ?>
<div class="container py-2">
    <h4>Modifier produit</h4>
    <?php
    $id = $_GET['id'];
    require_once 'include/database.php';
    $sqlState = $pdo->prepare('SELECT * from produit WHERE id=?');
    $sqlState->execute([$id]);
    $produit = $sqlState->fetch(PDO::FETCH_OBJ);;
    if (isset($_POST['modifier'])) {
        $libelle = $_POST['libelle'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $categorie = $_POST['categorie'];
        $description = $_POST['description'];

        $filename = '';
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $filename = uniqid() . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], 'upload/produit/' . $filename);
        }


        if (!empty($libelle) && !empty($prix) && !empty($categorie)) {

            if (!empty($filename)) {
                $query = "UPDATE produit SET libelle=? ,
                                                    prix=? ,
                                                    discount=? ,
                                                    id_categorie=?,
                                                    description=?,
                                                    image=?
                                                WHERE id = ? ";
                $sqlState = $pdo->prepare($query);
                $updated = $sqlState->execute([$libelle, $prix, $discount, $categorie, $description, $filename, $id]);
            } else {
                $query = "UPDATE produit 
                                                SET libelle=? ,
                                                    prix=? ,
                                                    discount=? ,
                                                    id_categorie=?,
                                                    description=?
                                                WHERE id = ? ";
                $sqlState = $pdo->prepare($query);
                $updated = $sqlState->execute([$libelle, $prix, $discount, $categorie, $description, $id]);
            }
            if ($updated) {
                header('location: produits.php');
            } else {

                ?>
                <div class="alert alert-danger" role="alert">
                    Database error (40023).
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Libelle , prix , catégorie sont obligatoires.
            </div>
            <?php
        }

    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $produit->id ?>">
        <label class="form-label">Libelle</label>
        <input type="text" class="form-control" name="libelle" value="<?= $produit->libelle ?>">

        <label class="form-label">Prix</label>
        <input type="number" class="form-control" step="0.1" name="prix" min="0" value="<?= $produit->prix ?>">

        <label class="form-label">Discount</label>
        <input type="range" value="0" class="form-control" name="discount" min="0" max="90"
               value="<?= $produit->discount ?>">

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"><?= $produit->description ?></textarea>

        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image">
        <img width="250" class="img img-fluid" src="upload/produit/<?= $produit->image ?>"><br>
        <?php

        ?>

        <?php
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="form-label">Catégorie</label>
        <select name="categorie" class="form-control">
            <option value="">Choisissez une catégorie</option>
            <?php
            foreach ($categories as $categorie) {
                $selected = $produit->id_categorie == $categorie['id'] ? ' selected ' : '';
                echo "<option $selected value='" . $categorie['id'] . "'>" . $categorie['libelle'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Modifier produit" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>