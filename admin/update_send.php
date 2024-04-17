<?php 
require '../_header.php';
$item_id = $_GET['id'];
$new_name = $_POST['name'];
$new_description = $_POST['description'];
$new_price = $_POST['price'];
$new_category = $_POST['category'];


if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $image = $_FILES['image'];
    if ($image["size"] <= 1000000) {
        $fileInfo = pathinfo($image['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
        if (in_array($extension, $allowedExtensions)) {
            $targetDir = "../images/";
            move_uploaded_file($image['tmp_name'], $targetDir . basename($image['name']));

            $query = $DB->query("UPDATE items 
            SET  name = :new_name, description = :new_description, price = :new_price, image = :new_image, category = :new_category
            WHERE id = :id",
                array(
                    ':id' => $item_id,
                    ':new_name' => $new_name,
                    ':new_description' => $new_description,
                    ':new_price' => $new_price,
                    ':new_image' => $image['name'],
                    ':new_category' => $new_category
                )
            );
            
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








// header('Location: index.php');
?>