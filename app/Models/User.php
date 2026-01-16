<?php 
class user{
    private $pdo;

    public function __construct(PDO $pdo)
    {

        $this->pdo=$pdo;
    }

    public function registrer($name,$email,$password){
        $hashedPassword=password_hash($password, PASSWORD_BCRYPT);

        $sql="INSERT INTO users (name,email, password)VALUES (?,?,?)";
        $stmt=$this->$this->pdo->prepare($sql);
        return $stmt->execute([$name,$email,$hashedPassword]);
    }

    public function findEmail($email){

        $sql="select * from users where email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
    

}


?>