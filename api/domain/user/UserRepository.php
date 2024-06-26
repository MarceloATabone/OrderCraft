<?php

require_once 'config/Database.php';
require_once 'User.php';

class UserRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllUsers()
    {
        $stmt = $this->connection->query("SELECT id, first_name, last_name, document, email, phone_number, birth_date, created_at, updated_at FROM users WHERE role_id != 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createUser($user)
    {
        $query = "INSERT INTO users (role_id, first_name, last_name, document, email, password, phone_number, birth_date) VALUES (:role_id,:first_name, :last_name, :document, :email, :password, :phone_number, :birth_date)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':role_id' => $user->role_id,
            ':first_name' => $user->first_name,
            ':last_name' => $user->last_name,
            ':document' => $user->document,
            ':email' => $user->email,
            ':password' => $user->password,
            ':phone_number' => $user->phone_number,
            ':birth_date' => $user->birth_date
        ]);
    }

    public function updateUser($user)
    {
        $query = "UPDATE users SET first_name = ?, last_name = ?, document = ?, phone_number = ?, birth_date = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user->first_name, $user->last_name, $user->document, $user->phone_number, $user->birth_date, $user->id]);
    }

    public function deleteUser($userId)
    {
        $query = "DELETE FROM users WHERE id = ? and role_id != 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$userId]);
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ? ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
