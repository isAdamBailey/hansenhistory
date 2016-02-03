<?php include 'includes/header.php'; ?>
<?php
	$id = $_GET['id'];

	// create DB object
	$db = new Database();

	// create images query
	$query = "SELECT * FROM tblImages WHERE id = ".$id;
	//run query
	$image = $db->select($query)->fetch_assoc();

	// create categories query
  	$query = "SELECT * FROM tblCategories
  				ORDER BY Name";
 	//run query
  	$categories = $db->select($query);
?>

<?php
  // if submit button is pressed
  if(isset($_POST['submit'])){
    //assign story variables
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $description = mysqli_real_escape_string($db->link, $_POST['description']);
    $year = mysqli_real_escape_string($db->link, $_POST['year']);
    // simple validation
    if($title == ''|| $description == ''|| $category ==''|| $year == ''){
      // set error
      $error = 'Please fill out all required fields.';
    } else {
      // or update the values
      $query = "UPDATE tblImages
                SET CategoryId = '$category',
                	Year = '$year',
                    Title = '$title',
                    Description = '$description'                      
                WHERE id = " .$id;

      $update_row = $db->update($query);
    }
  }
?>

<?php
  // if delete button is pressed
  if(isset($_POST['delete'])){
    // call delete method
    $query = "DELETE FROM tblImages
              WHERE id = " .$id;
    $delete_row = $db->delete($query);

    $filename = "../images/gallery/".$image['ImagePath'];
    unlink($filename);

  }
?>
<h2 class="page-header">Edit "<?php echo $image['Title']; ?>"</h2>
<div class="row">
	<div class="col-md-8">
		<form method="post" action="edit_image.php?id=<?php echo $id; ?>">
		  <div class="form-group">
		    <label>Image Title</label>
		    <input name="title" type="text" class="form-control" placeholder="Enter title" value="<?php echo $image['Title']; ?>">
		  </div>
		  <div class="form-group">
		    <label>Image Description</label>
		    <textarea name="description" class="form-control" placeholder="Enter description">
		      <?php echo $image['Description']; ?>
		    </textarea>
		  </div>
		  <div class="form-group">
		    <label>Year</label>
		    <input name="year" type="text" class="form-control" placeholder="Enter year" value="<?php echo $image['Year']; ?>">
		  </div>
		  <div class="form-group">
		    <label>Category</label>
		    <select name="category" class="form-control">
		      <?php while($row = $categories->fetch_assoc()) : ?>
		        <?php if($row['id'] == $image['CategoryId']){
		          $selected = 'selected';
		        }else{
		          $selected = '';
		        }
		        ?>
		        <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['Name']; ?></option>
		      <?php endwhile; ?>
		    </select>
		  </div>
		  <div>
		    <input name="submit" type="submit" class="btn btn-default" value="Submit" />
		    <a href="index.php" class="btn btn-default">Cancel</a>
		    <input name="delete" type="submit" class="btn btn-danger delete" value="Delete" />
		  </div>  
		  <br>
		</form>
	</div>
	<div class="col-md-4">
		<img class="img-thumbnail img-responsive" src="../images/gallery/<?php echo $image['ImagePath']; ?>" alt="<?php echo $image['Title']; ?>"/>
	</div>
</div> <!-- .row -->
<?php include 'includes/footer.php'; ?>