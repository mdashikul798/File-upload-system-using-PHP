
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
<title>test</title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
	Imput your file
	<input type="file" name="uploadFile" id="uploadFile">
	<button name="subButton">Submit</button>
	</form>
</body>
</html>

<?php
if (isset($_POST["subButton"])) {

	$targetPath = "uploads/"; /*the image will save here*/
	$targetFile = $targetPath . basename($_FILES["uploadFile"]["name"]);
	$uploadOk = 1;
	$imgFlieType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
	/*checking image or not*/
	if (isset($_POST["subButton"])) {
		$checkImg = getimagesize($_FILES["uploadFile"]["tmp_name"]);
		if ($checkImg !== false) {
			echo "File is an image - " . $checkImg["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($targetFile)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["uploadFile"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if ($imgFlieType != "jpg" && $imgFlieType != "png" && $imgFlieType != "jpeg"
		&& $imgFlieType != "gif") {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $targetFile)) {
			echo "The file " . basename($_FILES["uploadFile"]["name"]) . " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}

}