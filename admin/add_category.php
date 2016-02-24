<?php include 'includes/header.php'; ?>
<?php
    
  // create DB object
  $db = new Database();

  if(isset($_POST['submit'])){
    //assign post variables
    $name = mysqli_real_escape_string($db->link, $_POST['name']);

    // simple validation
    if($name == '') {
      // set error
      $error = 'Please fill out all required fields.';
    } else {
      $query = "INSERT INTO tblCategories
                (Name)
                  VALUES ('$name')";
      $insert_row = $db->update($query);
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