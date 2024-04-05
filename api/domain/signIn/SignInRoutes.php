<?php

require_once 'utils/ErrorResponse.php';
require_once 'SignIn.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


switch ($path) {
    case '/api/signIn':
        if ($method === 'POST') {
            $signIn = new SignIn();
            $signIn();
        } else {
            ErrorResponse::sendError(ErrorCode::METHOD_NOT_ALLOWED);
        }
        break;
}
