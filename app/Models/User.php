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

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;
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

    public function updatePoints($id, $points) {
        $stmt = $this->pdo->prepare("UPDATE users SET total_points = ? WHERE id = ?");
        return $stmt->execute([$points, $id]);
    }
    

}


?>