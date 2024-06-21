<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Libraries\Security;

class MyEmail {

    protected $emailDataExample = [
        'smtpHost' => 'your_smtp_host',
        'smtpUsername' => 'your_smtp_username',
        'smtpPassword' => 'your_smtp_password',
        'smtpPort' => 465,
        'fromEmail' => 'your_email@example.com',
        'fromName' => 'Your Name',
        'toEmail' => 'recipient@example.com',
        'subject' => 'Email Subject',
        'messageHtml' => '<p>This is the HTML content of the email.</p>',
        'messageNoHtml' => 'This is the plain text content of the email.'
    ];

    
    /**
     * 
     * @param type $data
     * @usage   $email = new MyEmail();
     *          $email->send($emailData);
     */
    public function send($data) {
        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = $data['smtpHost'];                           //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                     //Enable SMTP authentication
        $mail->Username = $data['smtpUsername'];                   //SMTP username
        $mail->Password = $data['smtpPassword'];                   //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = $data['smtpPort'];                           //465
        //Recipients
        $mail->setFrom($data['fromEmail'], $data['fromName']);
        //$mail->addAddress('joe@example.net', 'Joe User');         //Add a recipient
        $mail->addAddress($data['toEmail']);                       //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');             //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');        //Optional name

        $messageHtml = $data['messageHtml'];
        $messageNoHtml = $data['messageNoHtml'];

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $data['subject'];
        $mail->Body = $messageHtml;                            // Assign the HTML content
        $mail->AltBody = $messageNoHtml;                       // Assign the plain text content

        $mail->send();
    }

}
