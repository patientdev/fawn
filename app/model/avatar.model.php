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

		if ( !is_array($photo) ) { copy($photo, $target_dir . "facebook.jpg"); }

		else {

			$tmp = $photo["tmp_name"];

			// Put into user's photo column
			$column = "photo";

			// Get the filename
			$filename = $photo["name"];

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

			$this->profile->set("photo", $md5filename, $id);
		}
	}
	
	public function crop($jcrop, $id) {

			list($x, $y, $x2, $y2) = $jcrop;

			$photoFile = $this->profile->gimme("photo", "id", $id);

			// Get file path
			$path = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/" . $photoFile;

			// Create photo object from image file path
			$photo = imagecreatefromjpeg($path);

			// Get width and height of incoming photo
			$size = getimagesize($path);
			$width = $size[0];
			$height = $size[1];

			// Get the dimensional ratio of the incoming photo to the jcrop selection
			// An incoming photo will likely be smaller or larger than the jcrop selection and so we need a
			// ratio to convert between the two
			$widthMultipler = $width/$x2;
			$heightMultipler = $height/$y2;

			// Create destination photo object
			$croppedPhoto = ImageCreateTrueColor( 225, 225 );

			imagecopyresampled($croppedPhoto, $photo, 0, 0, ($x * $widthMultipler), ($y * $heightMultipler), 225, 225, ($x2 * $widthMultipler), ($y2 * $heightMultipler));

			imagejpeg($croppedPhoto, $path, 90);
	}

	public function show($id) {
		$gimme = $this->profile->gimme("photo", "id", $id);
		$photo = ( $gimme != NULL ) ? $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/" . $gimme : $_SERVER["DOCUMENT_ROOT"] . "img/default-avatar.png" ;

		// Get the file extension
		$extension = end((explode(".", $photo)));

		if ( $extension == "jpg" || $extension == "jpeg" ) {
			header("Content-type: image/jpeg");
		}

		else if ( $extension == "png" ) {
			header("Content-type: image/png");
		}

		else if ( $extension == "gif" ) {
			header("Content-type: image/gif");
		}

		readfile($photo);
	}
}

?>