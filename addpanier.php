<?php
require '_header.php';
session_start();

// Ajout des articles au panier 
if(isset($_GET['id'])){
    $productId = $_GET['id'];
    $item = $DB->query('SELECT * FROM items WHERE id=:productId', array('productId' => $productId));

    if(!empty($item)){
        $quantity = 1; 
        $price = $item[0]['price'];
        $userTemp = $_SESSION['userTemp'];
        $DB->query('INSERT INTO panier (id_item, qte, prix, userTemp) VALUES (:productId, :quantity, :price, :userTemp)', array(
            'productId' => $productId,
            'quantity' => $quantity,
            'price' => $price,
            'userTemp' => $userTemp
    
        ));
        echo 'Le produit a bien été ajouté au panier';
        
    }else{
        echo "Ce produit n'existe pas";
    }
} else {
    echo "Aucun produit n'a été ajouté au panier";
}
header('location:index.php');




?>