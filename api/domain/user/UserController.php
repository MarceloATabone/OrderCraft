<?php

require_once 'UserRepository.php';
require_once 'User.php';

class UserController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
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
        
        if (!($data instanceof User)) {
            ErrorResponse::sendError(ErrorCode::BAD_REQUEST);
            return;
        }


        // Se algum campo estiver faltando, retorna erro
        if (!empty($missingFields)) {
            ErrorResponse::sendError(ErrorCode::BAD_REQUEST, 'Missing fields: ' . implode(', ', $missingFields));
            return;
        }


        $userRepository = new UserRepository();
        $userRepository->createUser($data);

        echo json_encode(array('message' => 'User created successfully'));
    }



    // Method to update an existing user
    public function updateUser($data)
    {
        $user = new User();
        $user->id = $data->id;
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->document = $data->document;
        $user->email = $data->email;
        $user->phone_number = $data->phone_number;
        $user->birth_date = $data->birth_date;

        $this->userRepository->updateUser($user);
        echo json_encode(array('message' => 'User updated successfully'));
    }

    // Method to delete a user
    public function deleteUser($userId)
    {
        $this->userRepository->deleteUser($userId);
        echo json_encode(array('message' => 'User deleted successfully'));
    }
}
