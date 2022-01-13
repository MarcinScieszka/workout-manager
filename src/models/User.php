<?php

class User {
    private string $email;
    private string $password;
    private string $name;
    private string $surname;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname($surname): void {
        $this->surname = $surname;
    }
}
