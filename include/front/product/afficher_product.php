<?php
foreach ($produits as $produit) {
    $idProduit = $produit->id;
    ?>
    <div class="card col-md-4 mb-2">
        <img class="card-img-top w-75    mx-auto" src="../upload/produit/<?= $produit->image ?>"
             alt="Card image cap">
        <div class="card-body">
            <a href="produit.php?id=<?php echo $idProduit ?>" class="btn stretched-link"></a>
            <h5 class="card-title"><?= $produit->libelle ?></h5>
            <p class="card-text"><?= $produit->description ?></p>
            <p class="card-text"><?= $produit->prix ?> MAD</p>
            <p class="card-text"><small class="text-muted">Ajouté le
                    : <?= date_format(date_create($produit->date_creation), 'Y/m/d') ?></small></p>
        </div>
        <div class="card-footer bg-white" style="z-index: 10">
            <?php include '../include/front/counter.php' ?>
        </div>
    </div>
    <?php
}
if (empty($produits)) {
    ?>
    <div class="alert alert-info" role="alert">
        Pas de produits pour l'instant
    </div>

    <?php
}
?>