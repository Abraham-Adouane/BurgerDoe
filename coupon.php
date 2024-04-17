<?php
session_start();
require '_header.php';

$couponCode = $_POST['coupon_code'];
$userTemp= $_SESSION['userTemp'];


if (!empty($couponCode)){
    $coupon = $DB->query('SELECT * FROM coupons WHERE code = :couponCode AND debut <= NOW() AND fin >= NOW()', array(':couponCode' => $couponCode));


    if ($coupon) {

        $panierTotal = $DB->query('SELECT SUM(prix) 
        FROM panier 
        WHERE userTemp = :userTemp', array(':userTemp' => $userTemp));
        $panierTotal = floatval($panierTotal[0][0]) ;
        $coupon = $coupon[0];
        $remise = $coupon['remise'];
        $type = $coupon['type'];
        if ($type === '€') {
            $reductionAmount = $remise;
            $totalAfterRemise = $panierTotal - $reductionAmount;
        } elseif ($type === '%') {
            $reductionAmount = ($remise / 100) * $panierTotal;
            $totalAfterRemise = $panierTotal - $reductionAmount;
        }
        var_dump($panierTotal);

        $_SESSION['totalAfterRemise']=$totalAfterRemise;
        $_SESSION['reductionAmount']=$reductionAmount;
        $_SESSION['remise']=$remise;
        $_SESSION['type']=$type;
     


        header('location:panier.php?message=validCode&newprice=' . $totalAfterRemise);
      
        echo 'coupon : ' . $remise . ' ' . $type;
    } else {

            header('location:panier.php?message=invalidCode');
        }
} else {
    header('location:panier.php?message=invalidCode');
}

?>