<?php

require_once 'ErrorCode.php';

class ErrorResponse
{
    public static function sendError($errorCode, $customMessage = null)
    {
        http_response_code($errorCode);
        $errorText = self::getErrorText($errorCode);
        if ($customMessage !== null) {
            $errorText .= ': ' . $customMessage;
        }
        echo json_encode(array('error' => $errorText));
    }

    private static function getErrorText($errorCode)
    {
        switch ($errorCode) {
            case ErrorCode::ROUTE_NOT_FOUND:
                return 'Route not found';
            case ErrorCode::METHOD_NOT_ALLOWED:
                return 'Method not allowed';
            case ErrorCode::INTERNAL_SERVER_ERROR:
                return 'Internal server error';
            case ErrorCode::BAD_REQUEST:
                return 'Bad request';
            default:
                return 'Unknown error';
        }
    }
}
