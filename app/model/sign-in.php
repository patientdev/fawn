<?php

class signIn {
	

	private function insertConfirm($email, $confirmkey) {
		// Insert into our database of pending confirmations
		$key = md5(microtime().rand());
		$sql = "INSERT INTO confirm (email, confirmkey) values(:email, :key)";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':key', $key);
		$stmt->execute();


		$this->mailConfirmation($email, $confirmkey);
	}

	private function insertArtist($email, $password) {
		// Put the email and password into our user database
		$sql = "INSERT INTO artists (email, password) values(:email, :password)";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
	}

	private function mailConfirmation($email, $confirmkey) {
		// Mail the user a confirmation email
		$recipients = $email;
		$headers['From'] = 'info@forgerworldwide.org';
		$headers['To'] = $email;
		$headers['Subject'] = 'Please confirm your email address';
		$headers['Content-Type'] = 'text/html; charset=UTF-8';
		$body = "Please click <a href=\"http://forgerworldwide.org/profile/?confirm=$kconfirmey\">here</a> to confirm your email address.";
		$params['sendmail_path'] = '/nfsn/sendmail';
		$mail =& Mail::factory('sendmail', $params);
		$result = $mail->send($recipients, $headers, $body);
	}


}

?>