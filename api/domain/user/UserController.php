<?php

require_once 'utils/SecretService.php';
require_once 'UserRepository.php';
require_once 'User.php';

class UserController
{
    private $userRepository;
    private $secretService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->secretService = new SecretService();
    }

    // Method to list all users
    public function listUsers()
    {
        $users = $this->userRepository->getAllUsers();
        echo json_encode($users);
    }

    // Method to create a new user
    public function createUser()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data->first_name) || !isset($data->last_name) || !isset($data->document) || !isset($data->email) || !isset($data->password) || !isset($data->password_verify) || !isset($data->phone_number) || !isset($data->birth_date)) {
            ErrorResponse::sendError(ErrorCode::BAD_REQUEST);
            return;
        }

        $encryptedPassword = $this->secretService->encrypt($data->password, $data->password_verify);

        if ($encryptedPassword['success']) {
            $data->role_id = 2;
            $data->password = $encryptedPassword['data'];
            $this->userRepository->createUser($data);
            echo json_encode(array('message' => 'User created successfully'));
        } else {
            echo json_encode(array('error' => $encryptedPassword['error']));
        }
    }

    // Method to update an existing user
    public function updateUser()
    {
        $userId = intval(basename($_SERVER['REQUEST_URI']));
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (!$userId || !$requestData) {
            ErrorResponse::sendError(ErrorCode::BAD_REQUEST);
        } else {
            $user = new User();
            $user->id = $userId;
            $user->first_name = $requestData['first_name'];
            $user->last_name = $requestData['last_name'];
            $user->document = $requestData['document'];
            $user->phone_number = $requestData['phone_number'];
            $user->birth_date = $requestData['birth_date'];
            $this->userRepository->updateUser($user);
            echo json_encode(['message' => 'User updated successfully']);
        }
    }

    // Method to delete a user
    public function deleteUser()
    {
        $url_parts = parse_url($_SERVER['REQUEST_URI']);
        $path_parts = explode('/', $url_parts['path']);
        $userId = end($path_parts);

        $user = $this->userRepository->getUserById($userId);
        if (!$user) {
            ErrorResponse::sendError(ErrorCode::ROUTE_NOT_FOUND);
            return;
        }
        $this->userRepository->deleteUser($userId);
        echo json_encode(array('message' => 'User deleted successfully'));
    }
}
