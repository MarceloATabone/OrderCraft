<?php
session_start();

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
