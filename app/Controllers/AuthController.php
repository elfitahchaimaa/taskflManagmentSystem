<?php 

class AuthController{
    private $userModel;
    private $twig;

    public function __construct($pdo,$twig){
        $this->userModel=new User($pdo);
        $this->twig=$twig;
    }

    public function register(){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $this->userModel->registrer($name,$email,$password);
        header("Location:/login");
        exit;
    }
    public function showLogin(){

        echo $this->twig->render('auth/Login.twig');
    }

    // traiter la connexion
    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userModel->findByEmail($email);

        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: /dashboard");
        } else {
            echo $this->twig->render('auth/login.twig', [
                'error' => 'Email ou mot de passe incorrect'
            ]);
        }
    }

}
?>