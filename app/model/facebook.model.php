<?php

class Facebook {

	function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
		$this->profile = new Profile;
	}

	public function activate($user) {

		// Get Facebook profile info
		$facebookID = $user["id"];
		$name = $user["name"];
		$email = $user["email"];

		// Put that profile info into the database
		$sql = "INSERT INTO artists (name, email, photo, facebook) values(:name, :email, 'facebook.jpg', :facebookID)";
		$stmt = $this->profile->con->prepare($sql);
		$stmt->execute(array("name" => $name, "email" => $email, "facebookID" => $facebookID));

		// Get Facebook profile pic and put it in the user's avatar directory
		$photo = "http://graph.facebook.com/" . $facebookID . "/picture?width=225";
		$id = $this->profile->gimme("id", "email", $email);
		
		include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/avatar.model.php";
		$avatar = new Avatar;

		$avatar->save($photo, $id);

		return $id;

	}
}

?>