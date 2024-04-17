<?php
session_start();
require '_header.php';


$panierItems = $DB->query('SELECT * FROM panier p
INNER JOIN items i
ON p.id_item = i.id
WHERE userTemp =' . $_SESSION['userTemp']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="cart ">


        <div class="cart-container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="">
                        <div class="">
                            <?php
                            if (!empty($panierItems)) {
                            ?>
                            <table class="table table-bordered mb-30">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Produit</th>
                                        <th scope="col">Prix unitaire</th>
                                        <th scope="col">Quantité</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total=0;
                                    $tauxTVA=0.1;
                                    



                                        foreach($panierItems as $panierItem) {
                                            $total+=$panierItem['prix'];
                                            


                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <a href="updateQTE.php?id=<?=$panierItem['id_item']?>&action=delete?>"
                                                onclick="return
                                                confirm('Etes-vous sûr de vouloir supprimer ce produit de votre panier ?')">
                                                <i class="bi bi-archive"></i>
                                            </a>
                                        </th>
                                        <td>
                                            <img src="images/<?= $panierItem['image'] ?>" alt="Product" style="width:100px">
                                        </td>
                                        <td>
                                            <a href=""><?= $panierItem['name'] ?></a><br>
                                            <span><small><?= $panierItem['description'] ?></small></span>
                                        </td>
                                        <td><?= number_format($panierItem['price'], 2) ?> €</td>
                                        <td>
                                            <div class="quantity"
                                                style="display:flex; justify-content:center; align-items:center">

                                                <a href="updateQTE.php?id=<?=$panierItem['id_item']?>&qte=<?=$panierItem['qte']-1?>"
                                                    style="border:none; background-color:white; text-decoration:none; color:black">
                                                    <span
                                                        style="font-size:40px; margin-right:10px; margin-left:10px">-</span>
                                                </a>
                                                <span id="qtpanier"><?=$panierItem['qte']?></span>
                                                <a href="updateQTE.php?id=<?=$panierItem['id_item']?>&qte=<?=$panierItem['qte']+1?>"
                                                    style="border:none; background-color:white; text-decoration:none;  color:black">
                                                    <span
                                                        style="font-size:40px; margin-left:10px; margin-right:10px">+</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td class=""><?= number_format($panierItem['prix'], 2) ?> €</td>
                                    </tr>

                                    <?php }}else{ ?>
                                            <div class="alert alert-danger" role="alert" style="text-align:center;">
                                            Votre panier est vide !
                                        </div>
                                    <?php }?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Coupon -->
                <?php
                if (!empty($panierItems)) {
                ?>
                <div class="col-12 col-lg-6">
                    <div class=" mb-30">
                        <h6>Avez vous un coupon?</h6>
                        <p>Entrer le code de la remise</p>

                    <?php 
                
                    if(isset($_GET['message']) && $_GET['message']=='invalidCode'){?>
                        <div class="alert alert-danger" role="alert">
                            Attention : le code remise saisi est incorrect !
                        </div>
                    <?php } elseif (isset($_GET['message']) && $_GET['message']=='validCode'){ ?>
                        <div class="alert alert-primary" role="alert">
                            Vous avez ajouté un code de réduction !
                        </div>

                    <?php } ?>

                        <!-- Coupon -->
                        <div class="coupon-form">
                            <form action="coupon.php" method="POST">
                                <input type="text" class="form-control" name="coupon_code" placeholder="Entrer le code">
                                <button type="submit" class="btn btn-primary" style="margin-top:20px">Valider</button>
                            </form>
                        </div>
                        <br>

                        <!-- Coupon -->


                    </div>
                </div>

<!-- if(isset($_GET['newprice'])){
    $total = $_GET['newprice'];

}else{
    $total=$total;
} -->

<?php 
    if(isset($_GET['newprice'])){
    $total = $_SESSION['totalAfterRemise'];
    }else{
        $total=$total;
    }
    $montantTVA = $total/(1+$tauxTVA)*$tauxTVA;
    $montantHT = $total - $montantTVA;
?>



                <div class="col-12 col-lg-5">
                    <div class=" mb-30">
                        <h5 class="mb-3">Total panier</h5>
                        <div class="">
                            <table class="table mb-3">
                                <tbody>
                                    <tr>
                                        <td>Total produit HT</td>
                                        <td id='HT'><?= number_format($montantHT,2)?> €</td>
                                    </tr>
                                    <tr>
                                        <td>TVA</td>
                                        <td id="TVA"><?= number_format($montantTVA,2)?> €</td>
                                    </tr>
                                    <?php if(isset($_GET['newprice'])) { ?>
                                    <tr>
                                        <td>Remise</td>
                                        <td>- <?= $_SESSION['reductionAmount'] ?> €</td>
                                    </tr>
                                        <?php } ?>
                                    <tr>
                                        <td>TOTAL TTC</td>
                                        <td id='TTC'><?= number_format($total,2)?> €</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <?php }?>
            </div>
            <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
        </div>
    </div>
</body>

</html>