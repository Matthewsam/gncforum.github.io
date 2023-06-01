<?php

if(!isset($_FILES['fileToUpload'])){
	die("No files to process");
}
$target_directory = 'images/';
$target_file = $target_directory . basename($_FILES['fileToUpload']['name']);
$imageFiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($imageFiletype = 'jpg'){
	if(file_exists($target_file)){
		die('File already exists..');
	} else {
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
		echo "<img src='/$target_file' style='height: 200px;'/>";
		$cmd = 'mediainfo '.$target_file.' --output=HTML';

		echo $cmd;
		echo system($cmd);
	}
} else{
	die("Invalid format");
}

?>
