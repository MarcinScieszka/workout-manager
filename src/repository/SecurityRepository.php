<?php

require_once 'Repository.php';

class SecurityRepository extends Repository
{
    public function login_attempt(string $email, bool $successful)
    {
        $login_time = date('Y-m-d H:i:s');

        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'SELECT id FROM public.user u WHERE u.email = ?';
            $stmt = $db->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_user = $user['id'];

            $sql = 'INSERT INTO public.login (login_time, successful, id_user)  VALUES (:login_time, :successful, :id_user);';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':login_time', $login_time);
            $stmt->bindParam(':successful', $successful, PDO::PARAM_BOOL);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }
}
