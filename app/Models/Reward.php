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

    //lire toutes les recompenses

    public function getAll(){
        $sql="select * from rewards";
        return $this->pdo->query($sql)->fetchAll();
    }

    //supprimer une recompence

        public function delete($id)
    {
        $sql = "DELETE FROM rewards WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }
    
}
?>