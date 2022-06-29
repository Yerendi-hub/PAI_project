<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id as id, u.email as email, u.password as password, r.name as name FROM public.users u JOIN roles r ON r.id = u.id_role WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        return $this->setUser($stmt);
    }

    public function getById(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id as id, u.email as email, u.password as password, r.name as name FROM public.users u JOIN roles r ON r.id = u.id_role WHERE u.id = :id
        ');
        $stmt->bindParam(':id', $email, PDO::PARAM_STR);
        return $this->setUser($stmt);
    }

    public function createUser(string $email, string $password)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function setUser($stmt): ?User
    {
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            $user['name']
        );
    }


}