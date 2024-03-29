<?php
namespace App\src;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    public PHPMailer $mailer;
    private const NEW_USER_MAIL_TEMPLATE = 'new_user_validation_mail_temp';
    private const NEW_COMMENT_MAIL_TEMPLATE = 'new_comment_validation_mail_temp';
    private const NEW_CONTACT_MESSAGE_TEMPLATE = 'new_contact_message_temp';

    public function __construct(array $mailerConfig)
    {
        $host = $mailerConfig["host"];
        $port = $mailerConfig["port"];
        $userName = $mailerConfig["user"];
        $sendFrom = $mailerConfig["send_from"];
        $password = $mailerConfig["password"];


        $this->mailer = new PHPMailer(true);

        //$this->mailer->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $this->mailer->isSMTP(); //Send using SMTP
        $this->mailer->SMTPAuth = true; //Enable SMTP authentication
        $this->mailer->Username = $userName; //SMTP username
        $this->mailer->Password = $password; //SMTP password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $this->mailer->Port = $port; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->mailer->Host = $host;
        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $this->mailer->setFrom($sendFrom, 'Mailer');
        $this->mailer->addAddress($userName, 'Fabrice'); //Add a recipient
        // $mail->addAddress('ellen@example.com');              //Name is optional

        //formating email
        $this->mailer->isHTML(true); //Set email format to HTML
    }

    public function sendvalidationrequest(array $userInfos): bool
    {
        $template = self::getusermailtemplate();
        $templatefield = array("{{firstname}}", "{{lastname}}", "{{email}}");
        $this->mailer->Subject = 'INSCRIPTION NOUVEAU UTILISATEUR';
        $email = str_replace($templatefield, $userInfos, $template);
        $this->mailer->Body = $email;
        return $this->mailer->send();
    }
    public function sendCommentValidationrequest(array $comment): bool
    {
        $template = self::getcommentmailtemplate();
        $templatefield = array("{{author}}", "{{post}}", "{{comment}}");
        $this->mailer->Subject = 'NOUVEAU COMMENTAIRE';
        $email = str_replace($templatefield, $comment, $template);
        $this->mailer->Body = $email;
        return $this->mailer->send();
    }

    public function sendContactMessage(array $contact): bool
    {
        $template = self::getcontacttemplate();
        $templatefield = array("{{name}}", "{{email}}", "{{message}}");
        $this->mailer->Subject = 'NOUVEAU MESSAGE 📩';
        $email = str_replace($templatefield, $contact, $template);
        $this->mailer->Body = $email;
        return $this->mailer->send();
    }

    private function getusermailtemplate(): string
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/templates/" . self::NEW_USER_MAIL_TEMPLATE . ".php";
        return ob_get_clean();
    }
    private function getcommentmailtemplate(): string
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/templates/" . self::NEW_COMMENT_MAIL_TEMPLATE . ".php";
        return ob_get_clean();
    }
    private function getcontacttemplate(): string
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/templates/" . self::NEW_CONTACT_MESSAGE_TEMPLATE . ".php";
        return ob_get_clean();
    }
}
