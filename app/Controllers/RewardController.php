<?php

class RewardController {
    private $rewardModel;
    private $twig;

    public function __construct($pdo, $twig) {
        $this->rewardModel = new Reward($pdo);
        $this->twig = $twig;
    }

    public function index() {
        $rewards = $this->rewardModel->getAll();
        echo $this->twig->render('rewards/index.twig', [
            'rewards' => $rewards
        ]);
    }
}
