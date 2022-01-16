<?php

require_once 'Repository.php';

class SecurityRepository extends Repository
{
    public function login(string $email, bool $successful)
    {
        $login_time = date('Y-m-d H:i:s');

        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'SELECT id FROM public.user u WHERE u.email = ?;';
            $stmt = $db->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user['id'];

            $sql = 'INSERT INTO public.login (login_time, successful, id_user, session_id)  VALUES (:login_time, :successful, :id_user, :session_id);';
            $stmt = $db->prepare($sql);
            $session_id = session_id();
            $id_user = $_SESSION['user_id'];
//            $stmt->execute(['login_time' => $login_time, 'successful' => $successful, 'id_user' => $_SESSION['user_id'], ['session_id' => $session_id]]);
            $stmt->bindParam(':login_time', $login_time);
            $stmt->bindParam(':successful', $successful, PDO::PARAM_BOOL);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':session_id', $session_id);

            $stmt->execute();

            if ($successful) {
                $stmt =  $db->prepare('
                   UPDATE public.user SET logged_in = true WHERE id = ?;
                ');
                $stmt->execute([$_SESSION['user_id']]);
            }

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }

    public function logout(string $email) {
        $logout_time = date('Y-m-d H:i:s');

        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'UPDATE public.login SET logout_time = :logout_time WHERE session_id = :session_id;';
            $stmt = $db->prepare($sql);
            $session_id = session_id();
            $stmt->bindParam(':logout_time', $logout_time);
            $stmt->bindParam(':session_id', $session_id);
            $stmt->execute();

            $stmt =  $db->prepare('
               UPDATE public.user SET logged_in = false WHERE id = ?;
            ');
            $stmt->execute([$_SESSION['user_id']]);

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }
}
