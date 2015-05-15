<?php

class Avatar {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "../protected/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();

		require_once $_SERVER["DOCUMENT_ROOT"] . "app/model/profile.model.php";
		$this->profile = new Profile;
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

	public function save($photo, $id) {

		// Put into this directory based on users ID #
		$target_dir = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/";

		// Create the target_dir if it doesn't exist
		if ( !is_dir($target_dir) ) { mkdir($target_dir); }

		if ( !is_array($photo) ) {
			copy($photo, $target_dir . "facebook.jpg");
		}

		else {

			$tmp = $_FILES["photo"]["tmp_name"];

			// Put into user's photo column
			$column = "photo";

			// Get the filename
			$filename = $_FILES["photo"]["name"];

			// Get the extension
			$extension = "." . end((explode(".", $filename)));

			// Garble the filename
			$md5filename = md5($filename) . $extension;

			// Delete whatevers in there
			$files = glob($_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/*"); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
			}

			// Copy it from tmp to destination directory
			move_uploaded_file($tmp, $target_dir . $md5filename);
		}
	}

	public function crop() {}

	public function show($id) {
		$photo = $this->profile->gimme("photo", "id", $id);

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