<?php

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];


if ($path === '/api' || $path === '/api/') {
    http_response_code(200);
    echo json_encode(array('message' => 'Welcome to the API'));
} else {
    require_once 'domain/signIn/SignInRoutes.php';
    require_once 'domain/user/UserRoutes.php';
}
