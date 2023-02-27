<?php
class Phpmailer_library
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once(FCPATH .'/vendor/phpmailer/phpmailer/src/Exception.php');
        require_once(FCPATH .'/vendor/phpmailer/phpmailer/src/PHPMailer.php');
        require_once(FCPATH .'/vendor/phpmailer/phpmailer/src/SMTP.php');

        $objMail = new PHPMailer\PHPMailer\PHPMailer();
        return $objMail;
    }
}