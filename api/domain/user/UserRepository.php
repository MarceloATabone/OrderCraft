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
        $stmt = $this->connection->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($user)
    {
        $query = "INSERT INTO users (first_name, last_name, document, email, password, phone_number, birth_date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user->first_name, $user->last_name, $user->document, $user->email, $user->phone_number, $user->birth_date]);
    }

    public function updateUser($user)
    {
        $query = "UPDATE users SET first_name = ?, last_name = ?, document = ?, email = ?, phone_number = ?, birth_date = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$user->first_name, $user->last_name, $user->document, $user->email, $user->phone_number, $user->birth_date, $user->id]);
    }

    public function deleteUser($userId)
    {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$userId]);
    }
}
