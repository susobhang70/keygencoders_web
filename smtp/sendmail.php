<?php
	function Send_Mail($to,$subject,$body)
	{
		require 'class.phpmailer.php';
		$from = "keygencoders@gmail.com";
		$mail = new PHPMailer();
		$mail->IsSMTP(true);
		$mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Host="smtp.gmail.com";
		$mail->Port=465;
		$mail->Username="keygencoders@gmail.com";
		$mail->Password="kgecc@mpusch@pterxyzzy";
		$mail->SetFrom($from, 'KeyGEnCoders');
		$mail->AddReplyTo($from, 'KeyGEnCoders');
		$mail->Subject = $subject;
		$mail->MsgHTML($body);
		$address=$to;
		$mail->AddAddress($address, $to);
		$mail->Send();
		return true;
	}