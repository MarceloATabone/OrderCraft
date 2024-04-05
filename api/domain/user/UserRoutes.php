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
        } else if ($method === 'DELETE') {
            $userController->deleteUser();
        } else  if ($method === 'PUT') {
            $userController->updateUser();
        } else {
            ErrorResponse::sendError(ErrorCode::METHOD_NOT_ALLOWED);
        }
        break;
    case preg_match('/^\/api\/user\/[0-9]+$/', $path) ? $path : !$path:
        if ($method === 'DELETE') {
            $userController->deleteUser();
        } else if ($method === 'PUT') {
            $userController->updateUser();
        } else {
            ErrorResponse::sendError(ErrorCode::METHOD_NOT_ALLOWED);
        }
        break;
}
