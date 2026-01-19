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

    public function addTransaction($userId,$amount){
        $points=$this-> calculatePoints($amount);

        $sql="insert into transaction (user_id,amount,points) VALUES(?,?,?)";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$userId,$amount,$points]);

        return $points;
    }

  //recuperer l historique de transaction from database
  
  public function getHistory($userId){
    $sql="select * from transactions where user_id = ? ORDER BY created_at DESC";
    $stmt=$this->pdo->prepare($sql);
    $stmt->execute([$userId]);

    return $stmt->fetchAll();
}

}



?>