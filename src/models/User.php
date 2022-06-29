<?php

class User {
    private $id;
    private $email;
    private $password;
    private $role;

    public function __construct(
        string $id,
        string $email,
        string $password,
        $role = 1
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role =$role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }
}