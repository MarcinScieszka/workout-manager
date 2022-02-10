<?php

require_once 'AppController.php';

class CommunicationController extends AppController {
    public function contact() {
        if (!$this->isPost()) {
            return $this->render('contact', ['message_sent' => false]);
        }

        $email = $_POST["email"];
        $name = $_POST["name"];
        $topic = $_POST["topic"];
        $message = $_POST["message"];

        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) == false) {
            return $this->render('contact', [
                'messages' => ['Wrong email format!'], 'message_sent' => false
                ]);
        }

        $recipient = "recipient@mail.com";
        $mailHeader = "MIME-Version: 1.0" . "\r\n";
        $mailHeader .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $mailHeader  .= "From: $name ($email) \r\n";
        mail($recipient, $topic, $message, $mailHeader);

//        TODO: configure SMTP server
        return $this->render('contact', ['message_sent' => true]);
    }
}
