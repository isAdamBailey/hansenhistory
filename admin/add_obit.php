<?php include 'includes/header.php'; ?>
<?php
    
  // create DB object
  $db = new Database();

  // if submit button is pressed
  if(isset($_POST['submit'])){

    // image variables 
    $target_dir = '../images/obits/';
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $imagepath = basename($_FILES['image']['name']);

    // db variables
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $obituary = mysqli_real_escape_string($db->link, $_POST['obituary']);
    $birthdate = mysqli_real_escape_string($db->link, $_POST['dob']);
    $deathdate = mysqli_real_escape_string($db->link, $_POST['dod']);

    // simple validation
    if($name == ''|| $obituary == ''|| $birthdate ==''|| $deathdate == ''){
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
     
      // upload the file
      move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

      // update the db values
      $query = "INSERT INTO tblObits
                (ImagePath, Name, Obituary, BirthDate, DeathDate)                
                VALUES
                ('$imagepath', '$name', '$obituary', '$birthdate', '$deathdate')";

      $insert_row = $db->insert($query);
    }
  }
?>

<h2 class="page-header">Add Obituary</h2>
<div class="row">
  <div class="col-md-10">
    <form method="post" action="add_obit.php" enctype="multipart/form-data">
      <div class="form-group">
        <label>Name</label>
        <input name="name" type="text" class="form-control" placeholder="Enter name of the deceased">
      </div>
      <div class="form-group">
        <label>Obituary</label>
        <textarea name="obituary" class="form-control" placeholder="Enter obituary"></textarea>
      </div>
      <div class="col-md-5">
        <label>Select image to upload:</label>
        <input type="file" name="image" id="image">
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <label>Date Of Birth</label>
          <input name="dob" type="date" class="form-control">
          <span class="help-block">If month and day are not known, enter 01/01</span>
        </div>
        <div class="form-group">
          <label>Date Of Death</label>
          <input name="dod" type="date" class="form-control">
          <p class="help-block">If month and day are not known, enter 01/01</p>
        </div>
      </div>
      <div class="col-md-10 form-group">
        <input name="submit" type="submit" class="btn btn-default" value="Submit" />
        <a href="index.php" class="btn btn-primary">Cancel</a>
      </div>  
      <br>
    </form>
  </div>
</div> <!-- .row -->
<div>
    <?php echo $error; ?>
</div>

<?php include 'includes/footer.php'; ?>