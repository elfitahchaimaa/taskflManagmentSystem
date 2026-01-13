<?php

require_once __DIR__ . '/../vendor/autoload.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        echo "Bienvenue sur la page d'accueil";
        break;

    default:
        echo "Page non trouvée";
}
