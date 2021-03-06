<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	function sendEmail($to, $subject, $message, $fromAddress = 'info@examlist.com', $fromName = 'Exam list info')
	{
		require '../PHPMailer/src/Exception.php';
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';
		
		$mail = new PHPMailer();
		
		$mail->CharSet = 'UTF-8';
		$mail->Encoding = 'base64';
		
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = '587';
		$mail->isHTML();
		$mail->Username = 'webexamlist@gmail.com';
		$mail->Password = 'hidden';
		$mail->SetFrom($fromAddress, $fromName, true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AddAddress($to);
		
		$result = $mail->Send();
		if(!$result){echo "<script>alert('The e-mail was not send!\n".$mail->ErrorInfo."');</script>";}
	}
?>