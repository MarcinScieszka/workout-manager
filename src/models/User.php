<?php

class User {
    public function __construct(
        public string $email,
        public string $password,
        public string $gender
    ) {}

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
