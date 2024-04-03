<?php

    require 'database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    // connexion base de données
    $db = Database::connect();
    // selection base de données
    $db->query("USE burger_code");

    $statement = $db->query('SELECT * FROM items WHERE id'); 

    $statement->execute();

    $item = $statement->fetch();
    Database::disconnect();

    // la securité 
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



    ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='http://fonts.goofleapis.com/css?familu=holtwood+One+SC'rel='stylesheet' type="'text/css">
    <link rel="stylesheet"  href="./admi.css">
    <title>Burger Paris</title>

</head>

<body>


    <div class="container ">
        <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger-Paris <span class="glyphicon glyphicon-cutlery"></span></h1>
            <div class="admini">
                <div class="row">
            <div class="col-sm-6 ">

                <h2><strong> Liste des items  </strong></h2>
                <br>
                <form>
                    <div class="form-group">
                        <label>Nom:</label><?php echo '  ' . $item['name']; ?>              
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Description:</label><?php echo '  ' . $item['description']; ?>              
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Prix:</label><?php echo '  ' . number_format((float) $item['price'],2,'.' , ' ') . ' €';?>              
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Catégorie:</label><?php echo '  ' . $item['category']; ?>              
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Images:</label><?php echo '  ' . $item['image']; ?>              
                    </div>
                </form>

            <div class="form-actions">
                <a class="btn btn-primary" href="./page/index.php"><span class="glycon glycon-arow-left"></span> Retour</a>
            </div>
        </div>

        <div class="col-sm-6">
                <div class="thumbnail" > 
                    <img src="./assets/image/Menu premium/Menus Trible Wooper beef.jpeg " alt=".." >
                    <div><?php echo '  ' . number_format((float) $item['price'],2,'.' , '');?> </div>
                    <div class="caption">
                        <h4><?php echo '  ' . $item['name']; ?> </h4>
                        <p> <?php echo '  ' . $item['description']; ?></p>
                        <a href="#" class="btn btn-order" role="button">Commander<span class="glyphicon glyphicon-cutlery"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>