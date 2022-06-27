<?php

class User {
    private $id;
    private $email;
    private $password;

    public function __construct(
        string $id,
        string $email,
        string $password
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
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
}