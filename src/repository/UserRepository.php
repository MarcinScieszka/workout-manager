<?php

require_once 'Repository.php';
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository {

    public function getUser(string $email): ?User {
        $sql = 'SELECT * FROM public.user WHERE email = :email;';
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password']
        );
    }

    public function addUser(string $email, string $password) {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'INSERT INTO public.user (email, password, created_at)  VALUES (?, ?, ?);';
            $stmt = $db->prepare($sql);
            $created_at = date('Y-m-d');
            $stmt->execute([$email, $password, $created_at]);

            $user_id = $db->lastInsertId();
            $sql = 'INSERT INTO public.user_details (id_user) VALUES (:user_id);';
            $stmt = $db->prepare($sql);
            $stmt->execute(['user_id' => $user_id]);

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }

    public function checkIfUserExists(string $email): bool {
        $result = false;

        $sql = 'SELECT * FROM public.user WHERE email = :email;';
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == true) {
            $result = true;
        }

        return $result;
    }
}
