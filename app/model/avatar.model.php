<?php

class Avatar {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "../protected/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();

		require_once $_SERVER["DOCUMENT_ROOT"] . "app/model/profile.model.php";
		$profile = new Profile;
	}

	public function approve($photo) {
		// Making sure it's a photo of allowed size and dimensions that even exists

		$imageSize = getimagesize($photo);
		$allowedExtension = ( pathinfo($photo, PATHINFO_EXTENSION) == ("jpg" || "jpeg" || "gif" || "png") ) ? true : false;

		if ( $imageSize[0] >= 225 && $imageSize[1] >= 225 && $allowedExtension == true ) { return true; }
		else return false;

	}
	public function open($photo) {

		$image = null;
		if ( $this->approve($photo) ) {
			switch( strtolower(pathinfo($photo, PATHINFO_EXTENSION)) ) {
				case "jpeg":
				case "jpg":
	           		$image = imagecreatefromjpeg($photo);
	        	break;

		        case 'png':
		            $image = imagecreatefrompng($photo);
		        break;

		        case 'gif':
		            $image = imagecreatefromgif($photo);
		        break;
			}
		}

		return $image;
	}
	public function resize() {}
	public function save() {}
	public function crop() {}
	public function show($id) {
		$photo = $profile->gimme("photo", "id", $id);

		// Get the file extension
		$extension = end((explode(".", $photo)));

		$avatar = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/" . $photo;

		if ( $extension == "jpg" || $extension == "jpeg" ) {
			header("Content-type: image/jpeg");
		}

		else if ( $extension == "png" ) {
			header("Content-type: image/png");
		}

		else if ( $extension == "gif" ) {
			header("Content-type: image/gif");
		}

		readfile($avatar);
	}
}

?>