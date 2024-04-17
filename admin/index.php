                     <?php
                     require '../_header.php';
                    $items=$DB->query('SELECT i.id as item_id, i.name as item_name, i.description as item_description, i.price as item_price, c.name as category_name FROM items i
                    INNER JOIN categories c
                    ON c.id = i.category');
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
                <h1><strong>Liste des items   </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="bi-plus"></span> Ajouter</a></h1>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Description</th>
                      <th>Prix</th>
                      <th>Catégorie</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($items as $item) {?>
                    <tr>
                      <td><?= $item['item_name'] ?></td>
                      <td><?= $item['item_description'] ?></td>
                      <td><?= number_format($item['item_price'], 2, ',')  ?></td>
                      <td><?= $item['category_name'] ?></td>
                      <td width=340>
                        <a class="btn btn-secondary" href="view.php?id=<?= $item['item_id'] ?>"><span class="bi-eye"></span> Voir</a>
                        <a class="btn btn-primary" href="update.php?id=<?= $item['item_id'] ?>"><span class="bi-pencil"></span> Modifier</a>
                        <a class="btn btn-danger" href="delete.php?id=<?= $item['item_id'] ?>"><span class="bi-x"></span> Supprimer</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
