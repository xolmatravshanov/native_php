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


    public $attachment = null;


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

    public function sendWithAttachement()
    {

        /* Boundaries delimit multipart entities. As stated
   in RFC 2046 section 5.1, the boundary MUST NOT occur
   in any encapsulated part. Therefore, it should be
   unique. As stated in the following section 5.1.1, a
   boundary is defined as a line consisting of two hyphens
   ("--"), a parameter value, optional linear whitespace,
   and a terminating CRLF. */
        $prefix = "part_"; // This is an optional prefix
        /* Generate a unique boundary parameter value with our
        prefix using the uniqid() function. The second parameter
        makes the parameter value more unique. */
        $boundary = uniqid($prefix, true);

        // headers
        $headers = implode("\r\n", [
            "From: {$this->sender}",
            "Reply-To: {$this->sender}",
            'X-Mailer: PHP/' . PHP_VERSION,
            'MIME-Version: 1.0',
            // boundary parameter required, must be enclosed by quotes
            'Content-Type: multipart/mixed; boundary="' . $boundary . '"',
            "Content-Transfer-Encoding: 7bit",
            "This is a MIME encoded message." // message for restricted transports
        ]);

        // message and attachment
        $message = implode("\r\n", [
            "--" . $boundary, // header boundary delimiter line
            'Content-Type: text/plain; charset="iso-8859-1"',
            "Content-Transfer-Encoding: 8bit",
            $this->body,
            "--" . $boundary, // content boundary delimiter line
            'Content-Type: application/octet-stream; name="RenamedFile.pdf"',
            "Content-Transfer-Encoding: base64",
            "Content-Disposition: attachment",
            $this->attachment,
            "--" . $boundary . "--" // closing boundary delimiter line
        ]);

        return mail($this->sender, $this->subject, $message, $headers); // send the email

    }

    public function getAttachment()
    {
        $this->attachment = '/path/to/your/file.pdf';
        $this->attachment = file_get_contents($this->attachment);

        /* Attachment content transferred in Base64 encoding
        MUST be split into chunks 76 characters in length as
        specified by RFC 2045 section 6.8. By default, the
        function chunk_split() uses a chunk length of 76 with
        a trailing CRLF (\r\n). The 76 character requirement
        does not include the carriage return and line feed */
        $this->attachment = chunk_split(base64_encode($this->attachment));

    }


}