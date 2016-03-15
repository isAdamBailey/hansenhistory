<?php

function uploadImage()
{
	global $db, $pi;

	if(isset($_POST['submit'])){
	    // image variables 
	    $target_dir = '../images/gallery/';
	    $target_file = $target_dir . basename($_FILES['image']['name']);
	    $uploadOk = 1;
	    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	    $imagepath = basename($_FILES['image']['name']);
	    // db variables
	    $category = mysqli_real_escape_string($db->link, $_POST['category']);
	    $title = mysqli_real_escape_string($db->link, $_POST['title']);
	    $description = mysqli_real_escape_string($db->link, $_POST['description']);
	    $year = mysqli_real_escape_string($db->link, $_POST['year']);
	    // simple validation
	    if($title == ''|| $description == ''|| $category ==''|| $year == ''){
	      // set error
	      $error = 'Please fill out all required fields.';
	    }
	    // image upload validation
	    $check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check !== false) {
	        $error = 'File is an image - ' . $check["mime"] . '.';
	        $uploadOk = 1;
	    } else {
	        $error = 'File is not an image.';
	        $uploadOk = 0;
	    } 
	    // Check if file already exists
	    if (file_exists($target_file)) {
	        $error = 'Sorry, file already exists.';
	        $uploadOk = 0;
	    }
	    // Allow certain file formats
	    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	    && $imageFileType != "gif" ) {
	        $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
	        $uploadOk = 0;
	    }
	    // Check if $uploadOk is set to 0 by an error
	     if ($uploadOk == 0) {
	         $error = 'Sorry, your file was not uploaded.';
	    } else {
	      move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	      
	      $insert_row = $db->insert($pi->setPicture($category, $imagepath, $year, $title, $description));
	    }
  	}

}
