<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

// Habilita a exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$page = isset($_GET['page']) ? $_GET['page'] : 'login';


include 'includes/header.php';

switch ($page) {
    case 'login':
        include 'views/login.php';
        break;
    case 'dashboard':
        include 'views/dashboard.php';
        break;
    default:
        include 'views/login.php';
        break;
}

include 'includes/footer.php';
