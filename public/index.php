<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = new PDO("mysql:host=localhost;dbname=taskflow;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app/Views');
$twig = new \Twig\Environment($loader);

require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../app/Models/PointsTransaction.php';
require_once __DIR__ . '/../app/Models/Reward.php';

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/RewardController.php';

$authController = new AuthController($pdo, $twig);
$dashboardController = new DashboardController($pdo, $twig);
$rewardController = new RewardController($pdo, $twig);

$basePath = '/TaskManagementSystem/public'; // le dossier de ton projet
$uri = str_replace($basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));



switch ($uri) {

    case '/':
        header("Location: /login");
        break;

    case '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register();
        } else {
            echo $twig->render('auth/register.twig');
        }
        break;

    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->showLogin();
        }
        break;

    case '/logout':
        $authController->logout();
        break;

    case '/dashboard':
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        $dashboardController->index();
        break;

    case '/rewards':
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        $rewardController->index();
        break;

    case '/add-purchase':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dashboardController->addachat();
        }
        break;

    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}
