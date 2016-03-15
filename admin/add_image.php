<?php 
  include 'includes/header.php';
 
  $db = new Database();
  $ca = new Category();
  $pi = new Picture();

  $categories = $db->select($ca->getAllCategories());

  uploadImage();
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
        <a href="index.php" class="btn btn-primary">Cancel</a>
      </div>  
      <br>
    </form>
  </div>
</div> <!-- .row -->

<?php include 'includes/footer.php'; ?>