
<?php

        // comment suprimer les element admin

require 'database.php';
        


    if(!empty($_GET['id']));
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST))
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare(("DELETE FROM items WHERE id = ?"));
        $statement->execute(array($id));
        Database::disconnect();
        header ("Location: index.php");
    }

// fonction pour nettoyer les données
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
                    <div class="row">
                    <div class="admini">
                <div class="col-sm-6 ">

                    <h2><strong> Supprimer un Items </strong></h2>
                    <br>
            <form class="form" role="form" action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                    <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning">Oui</button>
                    <a class="btn btn-default" href="./page/index.php"> Non</a>
                    </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>