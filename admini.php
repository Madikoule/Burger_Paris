<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"  href="./admi.css">
    <title>Burger Paris</title>

</head>

<body>


    <div class="container ">
        <div class="row">
        <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger-Paris <span class="glyphicon glyphicon-cutlery"></span></h1>

        <div class="admini">
            <h2><strong> Liste des items  </strong><a href="" class="btn btn-success btn-lg"><span class="glypicon glyphicon-cutlery"></span> Ajouter</a>
            </h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégory</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>



<?php

    require './database.php';       

       // requete base de donnée

    $db = Database::connect();
    $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category
                            FROM items LEFT JOIN categories On items.category = categories.id
                            ORDER BY items.id DESC');   // dans la fonction query on vien mettre notre variable sql 
    
    // creer $item puis venir me chercher juste une ligne avec le fetch
    while ($item = $statement->fetch())      
    {
        echo '<tr>';
        echo '<td>' . $item['name'] . '</td>';
        echo '<td>' . $item['description'] . '</td>';
        echo '<td>' . $item['price'] . '</td>';
        echo '<td>' . $item ['category'] . '</td>';
        echo '<td width=300>';
            echo ' <a class="btn btn-default" href="view.php?id=' . $item['id'] . '"><span class="glycphicon-eye-open"></span> Voir </a>';
            echo ' ';
            echo ' <a class="btn btn-primary" href="update.php?id=' . $item['id'] .'"><span class="glycphicon-eye-open"></span> Modifier</a>';
            echo ' ';
            echo ' <a class="btn btn-danger"  href="delete.php?id=' . $item['id'] . '"><span class="glycphicon-eye-open"></span> Supprimer</a>';
        echo '</td>';
        echo '</tr>' ;


    }

Database::disconnect();

?>

    
                    </td>
                </tbody>
            </table>
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>