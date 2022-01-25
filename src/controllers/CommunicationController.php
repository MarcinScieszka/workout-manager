<?php

require_once 'AppController.php';

class CommunicationController extends AppController {

    public function contact() {
        if (!$this->isPost()) {
            return $this->render('contact', [
                'messages' => $this->messages]);
        }

        $email = $_POST["email"];
        $name = $_POST["name"];
        $topic = $_POST["topic"];
        $message = $_POST["message"];

        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) == false) {
            return $this->render('contact', [
                'messages' => ['Wrong email format!']
                ]);
        }

        $recipient = "recipient@mail.com";
        $mailheader = "MIME-Version: 1.0" . "\r\n";
        $mailheader .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $mailheader  .= "From: $name ($email) \r\n";
        mail($recipient, $topic, $message, $mailheader);
        $message_sent = true;

        return $this->render('contact', ['message_sent' => $message_sent]);
    }
}
