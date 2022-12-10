<?php
foreach ($produits as $produit) {
    $idProduit = $produit->id;
    ?>
    <div class="col-md-6 mb-4">
        <div class="card h-100">

            <?php if (!empty($produit->discount)): ?>
                <span class="badge rounded-pill text-bg-warning w-25 position-absolute m-2" style="right:0"> - <?= $produit->discount ?> <i
                            class="fa fa-percent"></i></span>
            <?php endif; ?>

            <img class="card-img-top w-75    mx-auto" src="../upload/produit/<?= $produit->image ?>"
                 alt="Card image cap">
            <div class="card-body">
                <a href="produit.php?id=<?php echo $idProduit ?>" class="btn stretched-link"></a>
                <h5 class="card-title"><?= $produit->libelle ?></h5>
                <p class="card-text"><?= $produit->description ?></p>
                <p class="card-text"><small class="text-muted">Ajouté le
                        : <?= date_format(date_create($produit->date_creation), 'Y/m/d') ?></small></p>
            </div>
            <div class="card-footer bg-white" style="z-index: 10">
                <?php if (!empty($produit->discount)): ?>
                    <div class="h5"><span
                                class="badge rounded-pill text-bg-danger"><strike> <?= $produit->prix ?></strike> <i
                                    class="fa fa-solid fa-dollar"></i></span></div>
                    <div class="h5"><span
                                class="badge rounded-pill text-bg-success">Solde : <?= calculerRemise($produit->prix, $produit->discount) ?> <i
                                    class="fa fa-solid fa-dollar"></i></span></div>
                <?php else: ?>
                    <div class="h5"><span class="badge rounded-pill text-bg-success"><?= $produit->prix ?> <i
                                    class="fa fa-solid fa-dollar"></i></span></div>

                <?php endif; ?>


                <?php include '../include/front/counter.php' ?>
            </div>
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