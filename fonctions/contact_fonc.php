<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once("libraries/PHPMailer/Exception.php");
	require_once("libraries/PHPMailer/PHPMailer.php");
	require_once("libraries/PHPMailer/SMTP.php");

    function contact(){
        extract($_POST);
        $to = 'aldric.silvestre@outlook.fr';
        $sujet = $objet;
        $message = '
        <h1>De ' .$nom. '('.$mail.') :</h1>
        <br/>
        <p>'. nl2br($msg).'</p>
        ';
        $headers = 'From: ' .$nom. ' <'.$mail.'>' . "\r\n";
        $headers .= 'MINE-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        unset($_POST["nom"]);
        unset($_POST["mail"]);
        unset($_POST["objet"]);
        unset($_POST["msg"]);

        return mail($to, $sujet, $message, $headers);
    }

    function cont_test(){

        $to = "stonningman@outlook.fr";
        $subject = "Subject";
        $body = "Lorem ipsum dolor sit amet, consectetur adipiscing elit...";

        $host = "smtp.office365.com";
        $username = "aldric.vitali@outlook.fr";
		$password = "pass"; //false password
		$port = "123"; //false port

		$mail = new PHPMailer();
		
		$mail->IsSMTP(); //utilise SMTP
		$mail->Host = $host;
		$mail->SMTPAuth = true;
		$mail->Username = $username;
		$mail->Password = $password;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = $port;

		$mail->SetFrom("aldric.vitali@outlook.fr", 'Aldric'); // Personnaliser l'envoyeur
		$mail->addAddress($to, 'Karim User'); // Ajouter le destinataire 
		$mail->addReplyTo( "aldric.vitali@outlook.fr" , 'Moi'); // L'adresse de réponse

		$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

		$mail->Subject = 'Here is the subject';
		$mail->Body = '<p>This is the</p> HTML message <strong>body</strong>';
		$mail->AltBody = 'This is the body in <em>plain text</em> for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Erreur, message non envoyé.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}else {
			echo 'Le message a bien été envoyé !';
		}

    }
?>
