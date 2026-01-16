<?php
class PointsTransaction{

    private $pdo;

    const POINT_pour_100DL= 10;

    public function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
    }
    public function calculatePoints($amount){
        return floor($amount/100)*self::POINT_pour_100DL;
    }

}



?>