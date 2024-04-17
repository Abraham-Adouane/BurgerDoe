<?php 

require '../_header.php';
$categories=$DB->query("SELECT * FROM  categories");
$id = $_GET['id'];

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
        <h1 class="text-logo"> Burger Code </h1>
        <div class="container admin">
            <div class="row">
                <div class="col-md-6">
                    <h1><strong>Modifier un item</strong></h1>
                    <br>
                    <form class="form" action="update_send?id=<?=$id?>" role="form" method="POST" enctype="multipart/form-data">
                        <br>
                        <div>
                            <label class="form-label" for="name">Nom:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?= $itemName ?>">
                            <span class="help-inline"></span>
                        </div>
                        <br>
                        <div>
                            <label class="form-label" for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?= $itemDescription ?>">
                            <span class="help-inline"></span>
                        </div>
                        <br>
                        <div>
                        <label class="form-label" for="price">Prix: (en €)</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?= $itemPrice ?>">
                            <span class="help-inline"></span>
                        </div>
                        <br>
                        <div>
                            <label class="form-label" for="category">Catégorie:</label>
                            <select class="form-control" id="category" name="category">
                            <option value="">Choisir une categorie</option>
                            <?php foreach ($categories as $category) 
                            { ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>

                            <?php } ?>
                            </select>
                            <span class="help-inline"></span>
                        </div>
                        <br>
                        <div>
                            <label class="form-label" for="image">Image:</label>
                            <p><?= $image ?></p>
                            <label for="image">Sélectionner une nouvelle image:</label>
                            <input type="file" id="image" name="image"> 
                            <span class="help-inline"></span>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="bi-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
                <div class="col-md-6 site">
                    <div class="img-thumbnail">
                        <img src="../images/<?= $image ?>" alt="<?= $itemName ?>">
                        <div class="price"><?= number_format($itemPrice, 2, ',') ?> €</div>
                          <div class="caption">
                            <h4><?= $itemName ?></h4>
                            <p><?= $itemDescription ?></p>
                            <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
                          </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>
