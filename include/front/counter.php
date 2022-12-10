<div>
    <?php
    $idUtilisateur = $_SESSION['utilisateur']['id'] ?? 0;
    $qty = $_SESSION['panier'][$idUtilisateur][$idProduit] ?? 0;
    if ($qty == 0) {
        $color = 'btn-primary';
        $button = '<i class="fa fa-light fa-cart-plus"></i>';
    } else {
        $button = '<i class="fa-solid fa-pencil"></i>';
    }
    ?>
    <?php if ($idUtilisateur !== 0): ?>
        <form method="post" class="counter d-flex" action="ajouter_panier.php">
            <button onclick="return false;" class="btn btn-primary mx-2 counter-moins">-</button>
            <input type="hidden" name="id" value="<?php echo $idProduit ?>">
            <input class="form-control" value="<?php echo $qty ?>" type="number" name="qty" id="qty" max="99">
            <button onclick="return false;" class="btn btn-primary mx-2 counter-plus mx-1">+</button>

            <button class="btn btn-success btn-sm" type="submit" name="ajouter">
                <?= $button ?>
            </button>
            <?php
            if ($qty != 0) {
                ?>
                <button formaction="supprimer_panier.php" class="btn btn-sm btn-danger mx-1 " type="submit"
                        name="supprimer">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <?php
            }
            ?>
        </form>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Vous devez être connecté pour acheter ce produit <strong><a href="../connexion.php">Connexion</a></strong>
        </div>
    <?php endif; ?>
</div>