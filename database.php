<?php



class Database   //  crées une class orientée objet
{

    // creer les variable pour les inserer directement dans la base donneées .

    private static $dbHost = "localhost";
    private static $dbName = "burger_code";
    private static $dbUser = "root";
    private static $dbUserPassword = "";

    private static $connection = null;  // la variable qui et a l'exterieur de la fonction public

    public static function connect()  // parametre static appartienne a la class et non a l'instance de la class
    {
        try
            {     // base de donnée avec les 3 argument " " ,
                // quand je suis dans une class et que je veux utilisé une propriété static je doit utilisé LE prefixe (SELF::)
            self::$connection = new PDO("mysql:host" . self::$dbHost . ";dbname" . self::$dbName, self::$dbUser, self::$dbUserPassword);
            }

        catch(PDOException $e)
            {
                die ($e->getMessage());
            }
            return self::$connection;
        }

    public static function disconnect()   // cette fonction va prendre la connection et va dire quel et égal a NULL (quel vos plus rien)
    {
        self::$connection = null;
    }

}

// JE VIEN DE CREER MA DECLARATION 



Database::connect();



?>