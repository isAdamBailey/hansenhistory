<?php include 'includes/header.php'; ?>
<?php

$id = $_GET['id'];

  // create DB object
  $db = new Database();

  // create storys query
  $query = "SELECT * FROM tblStories WHERE id = ".$id;
  //run query
  $story = $db->select($query)->fetch_assoc();

  // create categories query
  $query = "SELECT * FROM tblCategories
            ORDER BY  Name";
  //run query
  $categories = $db->select($query);
?>

<?php
  // if submit button is pressed
  if(isset($_POST['submit'])){
    //assign story variables
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    // simple validation
    if($title == ''|| $body == ''|| $category ==''|| $author == ''){
      // set error
      $error = 'Please fill out all required fields.';
    } else {
      // or update the values
      $query = "UPDATE tblStories
                SET CategoryId = '$category',
                    Title = '$title',
                    Author = '$author',
                    Body = '$body'              
                WHERE id = " .$id;

      $update_row = $db->update($query);
    }
  }
?>

<?php
  // if delete button is pressed
  if(isset($_POST['delete'])){
    // call delete method
    $query = "DELETE FROM tblStories
              WHERE id = " .$id;
    $delete_row = $db->delete($query);
  }
?>
<h2 class="page-header">Edit <?php echo $story['Title']; ?></h2>
<form method="post" action="edit_story.php?id=<?php echo $id; ?>">
  <div class="form-group">
    <label>Story Title</label>
    <input name="title" type="text" class="form-control" placeholder="Enter title" value="<?php echo $story['Title']; ?>">
  </div>
  <div class="form-group">
    <label>Story Body</label>
    <textarea name="body" class="form-control" placeholder="Enter story">
      <?php echo $story['Body']; ?>
    </textarea>
  </div>
  <div class="form-group">
    <label>Category</label>
    <select name="category" class="form-control">
      <?php while($row = $categories->fetch_assoc()) : ?>
        <?php if($row['id'] == $story['CategoryId']){
          $selected = 'selected';
        }else{
          $selected = '';
        }
        ?>
        <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['Name']; ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Story Author</label>
    <input name="author" type="text" class="form-control" placeholder="Enter author name" value="<?php echo $story['Author']; ?>">
  </div>
  <div>
    <input name="submit" type="submit" class="btn btn-default" value="Submit" />
    <a href="index.php" class="btn btn-primary">Cancel</a>
    <input name="delete" type="submit" class="btn btn-danger delete" value="Delete" />
  </div>  
  <br>
</form>

<?php include 'includes/footer.php'; ?>