<?php
require_once 'utils/ErrorResponse.php';
require_once 'UserController.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Instancia UserController
$userController = new UserController();

// Process the request based on the path and method
switch ($path) {
    case '/api/user':
        if ($method === 'GET') {
            $userController->listUsers();
        } else if ($method === 'POST') {
            $userController->createUser();
        } else {
            ErrorResponse::sendError(ErrorCode::METHOD_NOT_ALLOWED);
        }
        break;
    case '/api/user/update':
        if ($method === 'PUT') {
            $userController->updateUser();
        } else {
            ErrorResponse::sendError(ErrorCode::METHOD_NOT_ALLOWED);
        }
        break;
    case '/api/user/delete':
        if ($method === 'DELETE') {
            $userController->deleteUser();
        } else {
            ErrorResponse::sendError(ErrorCode::METHOD_NOT_ALLOWED);
        }
        break;
}
