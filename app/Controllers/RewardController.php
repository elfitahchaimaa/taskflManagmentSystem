<?php

class RewardController{
    private $twig;
    private $rewardModel;

    public function __construct($twig,$pdo)
    {
        $this->rewardModel = new Reward($pdo);
        $this->twig = $twig;
    }


    public function index()
    {
        $rewards = $this->rewardModel->getAll();

        echo $this->twig->render('rewards/index.twig', [
            'user' => $_SESSION['user'],
            'rewards' => $rewards
        ]);

    }
}

?>