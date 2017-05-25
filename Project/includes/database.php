<?php
class Database
{
    private static $dbName = 'sandalski' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';

    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    // Connect to DB
    public static function connect()
    {
        // One connection through whole application
        if ( null == self::$cont ) {     
            try {
                self::$cont =  new PDO( "mysql:host=".
                self::$dbHost.";"."dbname=".
                self::$dbName.";charset=utf8", 
                self::$dbUsername, 
                self::$dbUserPassword); 
            } catch(PDOException $e) {
                die($e->getMessage()); 
            }
        }
        return self::$cont;
    }

    // Disconnect from DB
    public static function disconnect() 
    {
        self::$cont = null;
    }

    //Construct PDO for user login
    public static function buildPDO()
    {
        session_start();
        try {
            $DB_con = new PDO("mysql:host=localhost;dbname=proekt","root","");
            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

      include_once 'user.php';
      $user = new USER($DB_con);
    }


}

?>
