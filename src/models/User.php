<?php

class User {
    private string $email;
    private string $password;
    private string $gender;

    public function __construct(string $email, string $password, string $gender) {
        $this->email = $email;
        $this->password = $password;
        $this->gender = $gender;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }
}
