<?php 

  include 'includes/header.php';

  $id = $_GET['id'];

  $db = new Database();
  $ca = new Category();

  $category = $db->select($ca->getCategoryById($id))->fetch_assoc();


  if(isset($_POST['submit'])){
    //assign post variables
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    // simple validation
    if($name == ''){
      // set error
      $error = 'Please fill out all required fields.';
    } else {
      $query = "UPDATE tblCategories
                SET Name = '$name'
                WHERE id = ".$id;

      $update_row = $db->update($query);
    }
  }
?>

<?php
  // if delete button is pressed
  if(isset($_POST['delete'])){
    // call delete method
    $query = "DELETE FROM tblCategories
              WHERE id = " .$id;
    $delete_row = $db->delete($query);
  }
?>

<form method="post" action="edit_category.php?id=<?php echo $id; ?>">
  <div class="form-group">
    <label>Category Name</label>
    <input name="name" type="text" class="form-control" placeholder="Category" value="<?php echo $category['Name']; ?>">
  </div>
  <div>
    <input name="submit" type="submit" class="btn btn-default" value="Submit" />
    <a href="index.php" class="btn btn-primary">Cancel</a>
    <input name="delete" type="submit" class="btn btn-danger delete" value="Delete" />
  </div>
</form>

<?php include 'includes/footer.php'; ?>