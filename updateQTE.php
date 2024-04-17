<?php
require '_header.php';

$idProduit = intval($_GET['id']);
$newQte = $_GET['qte'];
$action = $GET['action'];

$produitPanier = $DB->query('SELECT * FROM panier p
INNER JOIN items i
ON p.id_item = i.id
WHERE i.id = :productId', array(':productId' => $idProduit));
$produitPanier = $produitPanier[0];

$newPrix = $produitPanier['price'] * $newQte;

$req = $DB->query('UPDATE panier
SET qte = :qte , prix = :prix
WHERE id_item = :productId', array(':qte' => $newQte, ':prix' => $newPrix, ':productId' => $idProduit));


if($newQte<1||$action == 'delete'){
    $req = $DB->query('DELETE FROM panier
    WHERE id_item = :productId', array(':productId' => $idProduit));
}

header('Location:'.$_SERVER['HTTP_REFERER']);


?>