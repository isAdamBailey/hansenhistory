<?php 
  include 'includes/header.php'; 
    
  // create DB object
  $db = new Database();
  $ca = new Category();

  if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($db->link, $_POST['name']);

    if($name == '') {
      $error = 'Please fill out all required fields.';
    } else {
      $insert_row = $db->update($ca->setCategory($name));
    }
}
?>
<div class="col-md-6">
  <h2 class="page-header">Add Category</h2>
  <form method="post" action="add_category.php">
    <div class="form-group">
      <label>Category Name</label>
      <input name="name" type="text" class="form-control" placeholder="Category">
    </div>
    <div>
      <input name="submit" type="submit" class="btn btn-default" value="Submit" />
      <a href="index.php" class="btn btn-primary">Cancel</a>
    </div>
  </form>
</div>

<?php include 'includes/footer.php'; ?>