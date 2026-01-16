<?php


class Reward {
    private $pdo;
    public function __construct(PDO $pdo)
    {
        
        $this->pdo=$pdo;
    }

    public function  create($title,$points){
        $sql="insert into rewards(title,points) VALUES(?,?)";
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$title,$points]);
    }
}
?>