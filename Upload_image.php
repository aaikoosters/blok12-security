<?php
include 'datacontrollers/dbconnector.php';
include 'auth.php';
$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// If upload button is clicked ...
	if (isset($_POST['submit'])) {
		//To make sure the file is an image we need some information from the file
		$name = $_FILES['image']['name'];
		$name_ext = substr( $name, strrpos( $name, '.' ) + 1);
		$mimi = $_FILES['image']['type'];
		$data = $_FILES['image']['tmp_name'];
		$uploaded_size = $_FILES[ 'image' ][ 'size' ];
		
		//We make a tmp image to upload
		$temp_file = ( ( ini_get( 'upload_tmp_dir' ) == '' ) ? ( sys_get_temp_dir() ) : ( ini_get( 'upload_tmp_dir' ) ) );
		$temp_file .= DIRECTORY_SEPARATOR . md5( uniqid() . $name ) . '.' . $name_ext;
		
		//Is the uploaded file an image?		
		if( ( 	strtolower( $name_ext ) == 'jpg' || 
				strtolower( $name_ext ) == 'jpeg' || 
				strtolower( $name_ext ) == 'png' 
			) &&
			( $uploaded_size < 100000 ) &&
			( $mimi == 'image/jpeg' || $mimi == 'image/png' ) &&
			getimagesize( $data ) ) 
		{ //The uploaded file is an image
			// Strip any metadata, by re-encoding image to the tmp image
			if( $mimi == 'image/jpeg' ) {
				$img = imagecreatefromjpeg( $data );
				imagejpeg( $img, $temp_file, 100);
			}else {
				$img = imagecreatefrompng( $data );
				imagepng( $img, $temp_file, 9);
			}
			imagedestroy( $img );
		
			//Create a prepare statement to talk to the database
			$userId = $user_id;
			$stmt = $db->prepare("INSERT INTO images VALUES('', ?, ?, ?, ?)");
			$stmt->bindParam(1, $userId);
			$stmt->bindParam(2, $name);
			$stmt->bindParam(3, $mimi);
			$stmt->bindParam(4, $temp_file);
			$stmt->execute();
			
			if (!$stmt) {
				echo "\nPDO::errorInfo():\n";
				print_r($db->errorInfo());
			}
			//Delete the tmp file if it still exist.
			if( file_exists( $temp_file ) ){
				unlink( $temp_file );
			}
		}else{
			//The uploaded file was not an image
			trigger_error("The uploaded file was not an image");
		}
	}
	header('Location: portal.php');
?>