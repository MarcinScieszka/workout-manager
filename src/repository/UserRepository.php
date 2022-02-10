<?php

require_once 'Repository.php';
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository {

    public function getUser(string $email): ?User {
        $sql = 'SELECT * FROM public.user u
                JOIN user_details ud ON u.id = ud.id_user
                WHERE email = :email;
                ';
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['gender']
        );
    }

    public function addUser(string $email, string $password, string $gender) {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'INSERT INTO public.user (email, password, created_at)  VALUES (?, ?, ?);';
            $stmt = $db->prepare($sql);
            $created_at = date('Y-m-d');
            $stmt->execute([$email, $password, $created_at]);

            $user_id = $db->lastInsertId();
            $sql = 'INSERT INTO public.user_details (id_user, gender) VALUES (:user_id, :gender);';
            $stmt = $db->prepare($sql);
            $stmt->execute(['user_id' => $user_id, 'gender' => $gender]);

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }

    public function getUserId(string $email): int {
        $db = $this->database->connect();

        $sql = 'SELECT id FROM public.user WHERE email = :email;';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user['id'];
    }

    public function checkIfUserExists(string $email): bool {
        $result = false;

        $sql = 'SELECT * FROM public.user WHERE email = :email;';
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == true) {
            $result = true;
        }

        return $result;
    }

    public function checkIfUserHasActiveWorkoutAssignment(int $id_user): ?int {
        $workout_status = null;
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'SELECT wa.id_status, wa.id_workout FROM workout_assignment wa
                    JOIN "user" u ON u.id = ? AND wa.id_user = u.id
                    WHERE wa.id_status = 1';
            $stmt = $db->prepare($sql);

            $stmt->execute([$id_user]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $workout_status = $row['id_status'];
                $id_workout = $row['id_workout'];
            }

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }

        if ($workout_status == 1) {
            return $id_workout;
        }
        else {
            return null;
        }
    }

    public function changeUserPassword(string $email, string $password): void {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'UPDATE public.user u SET password = :password
                    WHERE u.email = :email;';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }
}
