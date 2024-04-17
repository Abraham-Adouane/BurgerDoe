<?php 
require '../_header.php';
$id = $_POST['id'];

$query=$DB->query("DELETE FROM items 
                    WHERE id = :id", array(':id' => $id));


header('location: index.php')
?>