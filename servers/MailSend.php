<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/General.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailSend {

	public function send($mail_to_address, $mail_to_name, $subject = 'ENVIA_RESPONSE', $body = '')
	{
		$mail = new PHPMailer(true);

		try {
		    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
		    $mail->isSMTP();
		    $mail->Host       = General::HOST;
		    $mail->SMTPAuth   = true;
		    $mail->Username   = General::USERNAME;
		    $mail->Password   = General::PASSWORD;
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		    $mail->Port       = General::PORT_TO_SEND;
		    $mail->ContentType = 'text/plain';

		    $mail->setFrom(General::USERNAME, General::MAIL_FROM_ADDRESS);
		    $mail->addAddress($mail_to_address, $mail_to_name);


		    $mail->isHTML(false);
		    $mail->Subject = $subject;
		    $mail->Body    = $body;
		    $mail->AltBody = '...';

		    $mail->send();
		    echo 'Mensaje enviado';
		} catch (Exception $e) {
		    echo "Error: {$mail->ErrorInfo}";
		}
	}

}


?>