<!-- index.php -->

<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

// Enables error display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/header.php';

switch ($page) {
    case 'login':
        include 'views/login.php'; // Corrigido o caminho do arquivo para 'views/login.php'
        break;
    case 'dashboard':
        include 'views/dashboard.php'; // Corrigido o caminho do arquivo para 'views/dashboard.php'
        break;
    default:
        include 'views/login.php'; // Corrigido o caminho do arquivo para 'views/login.php'
        break;
}

include 'includes/footer.php';
?>