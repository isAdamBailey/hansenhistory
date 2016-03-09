<?php 

	include 'includes/header.php';
	$id = $_GET['id'];

	$db = new Database();
	$pi = new Picture();
	$ca = new Category();

	$image = $db->select($pi->getPictureById($id))->fetch_assoc();

  	$categories = $db->select($ca->getAllCategories());

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

      $update_row = $db->update($pi->updatePicture($category, $year, $title, $description, $id));
    }
  }

  if(isset($_POST['delete'])){
    
    $delete_row = $db->delete($pi->deletePicture($id));

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
		    <a href="index.php" class="btn btn-primary">Cancel</a>
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