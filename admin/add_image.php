<?php include 'includes/header.php'; ?>
<?php
    
  // create DB object
  $db = new Database();

  // create categories query
  $query = "SELECT * FROM tblCategories
            ORDER BY Name";
  //run query
  $categories = $db->select($query);
?>
<?php
  // if submit button is pressed
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
     
      // upload the file
      move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

      // update the db values
      $query = "INSERT INTO tblImages
                (CategoryId, ImagePath, Year, Title, Description)                
                VALUES
                ('$category', '$imagepath', '$year', '$title', '$description')";

      $insert_row = $db->insert($query);
    }
  }

?>

<h2 class="page-header">Add Image</h2>
<div class="row">
  <div class="col-md-10">
    <form method="post" action="add_image.php" enctype="multipart/form-data">
      <div class="form-group">
        <label>Image Title</label>
        <input name="title" type="text" class="form-control" placeholder="Enter image title">
      </div>
      <div class="form-group">
        <label>Image Description</label>
        <textarea name="description" class="form-control" placeholder="Enter image description"></textarea>
      </div>
      <div class="col-md-5">
        <label>Select image to upload:</label>
        <input type="file" name="image" id="image">
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <label>Year</label>
          <input name="year" type="number" class="form-control" placeholder="Enter estimated year">
        </div>
        <div class="form-group">
          <label>Category</label>
          <select name="category" class="form-control">
            <?php while($row = $categories->fetch_assoc()) : ?>
              <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['Name']; ?></option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
      <div class="col-md-10 form-group">
        <input name="submit" type="submit" class="btn btn-default" value="Submit" />
        <a href="index.php" class="btn btn-default">Cancel</a>
      </div>  
      <br>
    </form>
  </div>
</div> <!-- .row -->

<?php include 'includes/footer.php'; ?>