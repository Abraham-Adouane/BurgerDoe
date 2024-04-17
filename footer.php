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