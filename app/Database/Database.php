<?php  
class database{


    private static ?PDO $pdo=null;

    public static function connect():PDO{
        if(self::$pdo==null){
            self::$pdo=new PDO("mysql:host=localhost;dbname=taskflow;charset=utf","root","");
        }
        return self::$pdo;
    }
    
}


?>