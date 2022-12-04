<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Liste des catégories</a>
                </li>
            </ul>
        </div>
        <?php
        $idUtilisateur = $_SESSION['utilisateur']['id'];
        define('PRODUCTS_COUNT', isset($_SESSION['panier'][$idUtilisateur]) ? count($_SESSION['panier'][$idUtilisateur]) : 0);
        ?>
        <a class="btn float-end" href="../"><i
                    class="fa-solid fa-screwdriver-wrench"></i> Backoffice</a>
        <a class="btn float-end" href="panier.php"><i class="fa-solid fa-cart-shopping"></i> Panier
            (<?php echo PRODUCTS_COUNT; ?>)</a>
    </div>
</nav>