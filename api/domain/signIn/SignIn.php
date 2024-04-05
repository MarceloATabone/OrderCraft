<?php

require_once './domain/user/UserRepository.php';

class SignIn
{

    #TODO : Make Bearer for auth
    #TODO : Make SignUp for make secret in password. 

    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function __invoke()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data->email) || !isset($data->password)) {
            ErrorResponse::sendError(ErrorCode::BAD_REQUEST);
            return;
        }

        #TODO: check whether you are admin or customer to perform a different login


        # MOKE  ADMIN = 1 login OK
        # MOKE  not using password verify as there is no secret encrypt in this version


        $user = $this->userRepository->getUserByEmail($data->email);

        if ($user && $user['role_id'] === 1 && $user['password'] === $data->password) {
            echo json_encode(array('message' => 'Sign in successful', 'user' => $user));
        } else {
            ErrorResponse::sendError(ErrorCode::BAD_REQUEST, 'Invalid credentials');
        }
    }
}
