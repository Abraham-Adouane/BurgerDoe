<?php
require '../_header.php';

$itemName = $_POST['name'];
$itemDescription = $_POST['description'];
$itemPrice = $_POST['price'];
$categoryID = intval($_POST['category']);

$categories = $DB->query("SELECT id FROM categories");
$categoryIDs = array_column($categories, 'id');

if (!in_array($categoryID, $categoryIDs)) {
    echo "La catégorie sélectionnée n'existe pas.";
    exit; 
}

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $image = $_FILES['image'];
    if ($image["size"] <= 1000000) {
        $fileInfo = pathinfo($image['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
        if (in_array($extension, $allowedExtensions)) {
            $targetDir = "../images/";
            move_uploaded_file($image['tmp_name'], $targetDir . basename($image['name']));

            $query = $DB->query("INSERT INTO items (name, description, price, image, category) VALUES (:itemName, :itemDescription, :itemPrice, :image, :categoryID)", array(':itemName' => $itemName, ':itemDescription' => $itemDescription, ':itemPrice' => $itemPrice, ':image' => $image['name'], ':categoryID' => $categoryID));
            
            if ($query) {
                header('Location: index.php');
                exit;
            } else {
                echo "Une erreur s'est produite lors de l'insertion dans la table items.";
            }
        } else {
            echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        }
    } else {
        echo "Désolé, le fichier est trop volumineux.";
    }
} else {
    echo "Aucun fichier image n'a été téléchargé.";
}

header('location:index.php');

?>