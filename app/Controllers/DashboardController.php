<?php
class DashboardController{
    private $pointsModel;
    private $twig;

    public function __construct($pdo, $twig)
    {
        $this->pointsModel = new PointsTransaction($pdo);
        $this->twig = $twig;
   
    }

    public function index()
    {
            $userId = $_SESSION['user']['id'];

            $history = $this->pointsModel->getHistory($userId);

            echo $this->twig->render('dashboard/index.twig', [
                'history' => $history
            ]);
    }

    //ajouter achat

public function addachat()
    {
        $amount = $_POST['amount'];
        $userId = $_SESSION['user']['id'];

        $points = $this->pointsModel->addTransaction($userId, $amount);

        header("Location: /dashboard");
    } 


}

?>