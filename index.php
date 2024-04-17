<?php 
require '_header.php';
session_start();
if(!isset($_SESSION{'userTemp'})){
    $_SESSION['userTemp']=time();
} else {
    $_SESSION['userTemp'] = $_SESSION['userTemp'];
}
$categories = $DB->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Burger Code</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container site">

        <div style="text-align:center; display:flex; justify-content:center; align-items:center" class="text-logo">
            <h1>Burger Doe</h1>
            <a href="panier.php" class="bi bi-basket3 cart-icon"> </a>
        </div>

        <nav>
            <ul class="nav nav-pills" role="tablist">
                <?php
                foreach ($categories as $categorie) {
                ?>
                    <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $categorie['id']==1? 'active':'' ?>"
                    data-bs-toggle="pill"
                    data-bs-target="#tab<?= $categorie['id']?>"
                    role="tab"><?=$categorie['name']?></a>
                </li>
                <?php }?>
            </ul>
        </nav>

        <div class="tab-content">
            <?php
                foreach ($categories as $categorie) {
                    $categoryId = $categorie['id'];
                    $query = "SELECT * FROM items WHERE category = :categoryId";
                    $items = $DB->query($query, array(':categoryId' => $categoryId));
            ?>

                    <div
                    class="tab-pane <?= $categorie['id']==1? 'active':'' ?>"
                    id="tab<?=$categorie['id']?>"
                    role="tabpanel">
                        <div class="row">
                            <?php foreach ($items as $item) { ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="img-thumbnail">
                                        <img src="images/<?= $item['image']?>" class="img-fluid" alt="...">
                                        <div class="price"><?=number_format($item['price'], 2,',')?> €</div>
                                        <div class="caption">
                                            <h4><?=$item['name']?></h4>
                                            <p><?=$item['description']?></p>
                                            <!-- modifier le lien du bouton commander -->
                                            <a href="addpanier.php?id=<?=$item['id']?>"
                                            class="btn btn-order"
                                            role="button">
                                            <span class="bi-cart-fill"></span>
                                                Commander</a>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                <?php }?>

        </div>
</body>

</html>