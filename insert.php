<?php

        require 'database.php';
        
        // initialisation des variables et des message d'erreur
        $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $categpry
        =$image = "";

        // Vérification si $_POST n'est pas vide
        if(!empty($_POST))
        {
            // Récupération des valeurs du formulaire et nettoyage des données
            $name                   = checkInput($_POST['name']);
            $description            = checkInput($_POST['description']);
            $price                  = checkInput($_POST['price']);
            $category               = checkInput($_POST['category']);
            $image                  = checkInput($_FILES['image']['nom']);      // recuperation du nom du fichier avec le $-FILES
            $imagePath              = '../page/' . basename($image);
            $imageExtension         = pathinfo($imagePath, PATHINFO_EXTENSION);
            $isSuccess  = true;
            $isUploadSuccess = false ;

            // Vérification si les champs requis sont vides
            if(empty($name))
            {
                $nameError = 'Ce champ ne peut pas ètre vide';
                $isSuccess = false;
            }

            if(empty($category))
            {
                $categoryError = 'Ce champ ne peut pas ètre vide';
                $isSuccess = false;
            }

            if(empty($description))
            {
                $descriptionError = 'Ce champ ne peut pas ètre vide';
                $isSuccess = false;
            }

            if(empty($price))
            {
                $priceError = 'Ce champ ne peut pas ètre vide';
                $isSuccess = false;
            }

            // Vérifier l'upload de l'image 
            if(empty($image))
            {
                $imageError = 'Ce champ ne peut pas ètre vide';
                $isSuccess = false;
            }
            else
                    $isUploadSuccess = true ;
                // premiere chose a verifier ; si lextension et different de jpg etc ... alr j'ai un probleme si j'ai pas le format demandé
                if($imageExtension != "JPG" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" )
                {
                    $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                }

                // verifier si image existe deja si oui apler par un nom different
                if(file_exists($imagePath))
                {
                    $imageError = "Le fichier existe deja";
                    $isUploadSuccess = false;
                }
                
                // verification de la taille de l'image
                if($_FILES['image']['size']  > 500000)
                {
                    $imageError = "Le fichier ne doit pas depasser les 500KB";
                    $isUploadSuccess = false ;
                }

                // tenter le telechargement de l'image
                if($isUploadSuccess)
                {
                    if(!move_uploaded_file($_FILES['image']["tmp_name"], $imagePath))
                    {
                        $imageError = "Il y a eu une erreur lors de l'upload";
                        $isUploadSuccess = false;
                    }
                }
                
        }
            // Si tout est valide , insertion des données dans labase de donéess

            if($isSuccess && $isUploadSuccess)
            {
                $db = Database::connect();
                $statement = $db->prepare("INSERT INTO items (name,description,price,cagtegory,image) values(?, ?, ?, ?, ?");
                $statement->execute(array($name,$description,$price,$category,$image));
                Database::disconnect();
                header("Location: index.php");
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
            <div class="admini">
                <div class="row">
            <div class="col-sm-6 ">

                <h2><strong> Ajouter un Items  </strong></h2>
                <br>
                <form class="form" role="form" action="inserp.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nom:</label><?php echo '  ' . $item['name']; ?>      
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom"  value="<?php echo $name ;?>">   
                    
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Description:</label><?php echo '  ' . $item['description']; ?>  
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description ;?>">   
                        
                        <span class="help-inline"><?php echo $descriptionError; ?></span>

                    </div>
                    <br>
                    <div class="form-group">
                        <label for="price"> Prix: (en €)</label>
                        <input type="number"  step="0.01"  class="form-control" id="price" name="price" placeholder="Price" value="<?php echo $price ;?>">   
                    
                        <span class="help-inline"><?php echo $priceError; ?></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Catégorie:</label>  
                            <select class="form-control"  id="categorie" name="category">
                                <?php
// connexion base de données
                                    $db = Database::connect();
// selection base de donnée
                                    $db->query("USE burger_code");

                                    foreach($db->query('SELECT * FROM categorie') as $row)
                                    {
                                        echo '<option value="' . $row['id'] . '">' .$row['name'] . '</option>';
                                    }
                                    Database::disconnect();

                                ?>
                            </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>

                    </div>
                    <br>
                    <div class="form-group">
                        <label for="image">Sélectionner une image :</label>    
                        <input type="file"  id="image" name="image">  <!-- il recupere un fichier avec le type file -->
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>
                <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"><span class="glycophicon glyphicon-pencil"></span> Ajouter</button>
                <a class="btn btn-primary" href="./page/index.php"><span class="glycon glycon-arow-left"></span> Retour</a>
            </div>
            </form>

        </div>
                </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>