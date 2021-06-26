<?php

class Mail
{

    public $sender = '';
    public $subject = '';
    public $body = '';
    public $from = '';
    public $title = '';

    public $headers = [];


    public $pathLogFile = "/tmp/mail.log";

    public function __construct($sender, $subject, $body)
    {
        $this->sender = $sender;
        $this->subject = $subject;
        $this->body = $body;

        $this->send();
    }

    public function send()
    {

        return mail($this->sender, $this->subject, $this->body, $this->headers);

    }

    protected function configure()
    {
        error_reporting(-1);
        ini_set('display_errors', 'On');
        set_error_handler("var_dump");

        // Special mail settings that can make mail less likely to be considered spam
        // and offers logging in case of technical difficulties.

        ini_set("mail.log", $this->pathLogFile);
        ini_set("mail.add_x_header", TRUE);

    }

    protected function configureHeaders()
    {


        $this->headers = implode("\r\n", [
            "From: {$this->title} <{$this->from}>",
            "Reply-To: {$this->from}",
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=ISO-8859-1',
            'X-Mailer: PHP/' . PHP_VERSION
        ]);
    }


}