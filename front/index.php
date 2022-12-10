<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include '../include/head_front.php' ?>
    <title>Accueil</title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
<div class="container py-2">
    <?php
    require_once '../include/database.php';
    $categoryId = $_GET['id'] ?? NULL;
    $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_OBJ);
    if (!is_null($categoryId)) {
        $sqlState = $pdo->prepare("SELECT * FROM produit WHERE id_categorie=? ORDER BY date_creation DESC");
        $sqlState->execute([$categoryId]);
        $produits = $sqlState->fetchAll(PDO::FETCH_OBJ);
    } else {
        $produits = $pdo->query("SELECT * FROM produit ORDER BY date_creation DESC")->fetchAll(PDO::FETCH_OBJ);
    }
    $activeClasses = 'active bg-success rounded border-success';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group list-group-flush position-sticky sticky-top">
                    <h4 class=" mt-4"><i class="fa fa-light fa-list"></i> Liste des catégories</h4>
                    <li class="list-group-item <?= $categoryId == NULL ? $activeClasses : '' ?>">
                        <a class="btn btn-default w-100" href="./">
                            <i class="fa fa-solid fa-border-all"></i> Voir tout les produits
                        </a>
                    </li>
                    <?php
                    foreach ($categories as $categorie) {
                        $active = $categoryId === $categorie->id ? $activeClasses : '';
                        ?>
                        <li class="list-group-item <?= $active ?>">
                            <a class="btn btn-default w-100"
                               href="index.php?id=<?php echo $categorie->id ?>">
                                <i class="fa <?php echo $categorie->icone ?>"></i> <?php echo $categorie->libelle ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col mt-4">
                <div class="row">
                    <?php require_once '../include/front/product/afficher_product.php'; ?>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>