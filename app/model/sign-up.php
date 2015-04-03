<?php

class signUp {

	function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function emailExists($email) {
	// Check if email exists
	
		$stmt = $this->con->prepare("SELECT email FROM artists WHERE email = '$email' LIMIT 1");
		$stmt->execute();
		$result = $stmt->fetch();
		
		if ( $result["email"] == $email ) {
			return true;
		}

		else return false;

	}

	public function confirmEmail($email) {
	// Insert into our database of pending confirmations
	
		$confirmkey = md5(microtime().rand());
		$sql = "INSERT INTO confirm (email, confirmkey) values(:email, :confirmkey)";
		$stmt = $this->con->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':confirmkey', $confirmkey);
		$stmt->execute();

		//$this->mailConfirmation($email, $confirmkey);
	}

	public function insertArtist($email, $password) {
	// Put the email and password into our user database
	
		$sql = "INSERT INTO artists (email, password) values(:email, :password)";
		$stmt = $this->con->prepare($sql);
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