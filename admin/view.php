<?php 

require '../_header.php';
$id = $_GET['id'];
echo $id;
$item=$DB->query("SELECT i.id as item_id, i.name as item_name, i.description as item_description, i.price as item_price, c.name as category_name, i.image as item_image FROM items i
                    INNER JOIN categories c
                    ON c.id = i.category
                    WHERE i.id = :id", array(':id' => $id));

if (!empty($item) && isset($item[0]['item_name'])) {
  $item = $item[0];

  $itemName = $item['item_name'];
  $itemDescription = $item['item_description'];
  $itemPrice = $item['item_price'];
  $categoryName = $item['category_name'];
  $image = $item['item_image'];

} else {
  echo "Aucun article trouvé avec cet ID";
}
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Burger Code</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
      <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
      <link rel="stylesheet" href="../styles.css">
    </head>
    
    <body>
      <h1 class="text-logo"><span class="bi-shop"></span> Burger Code <span class="bi-shop"></span></h1>
      <div class="container admin">
        <div class="row">
          <div class="col-md-6">
            <h1><strong>Voir un item</strong></h1>
            <br>
            <form>
              <div>
                <label>Nom: <?= $itemName ?></label>
              </div>
              <br>
              <div>
                <label>Description: <?= $itemDescription ?></label>
              </div>
              <br>
              <div>
                <label>Prix:  <?= number_format($itemPrice, 2, ',') ?> €</label>
              </div>
              <br>
              <div>
                <label>Catégorie: <?= $categoryName ?></label>
              </div>
              <br>
              <div>
                <label>Image: <?= $image ?></label>
              </div>
            </form>
            <br>
            <div class="form-actions">
              <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
            </div>
          </div>
          <div class="col-md-6 site">
            <div class="img-thumbnail">
              <img src="../images/<?= $image ?>" alt="<?= $categoryName ?> <?= $itemName ?>">
              <div class="price"><?= number_format($itemPrice, 2, ',') ?> €</div>
              <div class="caption">
                <h4><?= $itemName ?></h4>
                <p><?= $itemDescription ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>   
    </body>
</html>

