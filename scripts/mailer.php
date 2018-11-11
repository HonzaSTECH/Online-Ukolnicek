<?php
	function sendEmail($to, $subject, $message, $from = 'info@examlist.com')
	{
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require '../PHPMailer/src/Exception.php';
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = '465';
		$mail->isHTML();
		$mail->Username = 'webexamlist@gmail.com';
		$mail->Password = 'ci9smt47Hc5s167f';
		$mail->SetFrom($from);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AddAddress($to);
		
		$mail->Send();
		echo "The e-mail was send.";
	}
?>