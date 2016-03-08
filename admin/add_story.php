<?php 
  include 'includes/header.php'; 

  $db = new Database();
  $ca = new Category();
  $st = new Story();

  $categories = $db->select($ca->getAllCategories());

  if(isset($_POST['submit'])){
    //assign post variables
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    // simple validation
    if($title == ''|| $body == ''|| $category ==''|| $author == ''){
      // set error
      $error = 'Please fill out all required fields.';
    } else {

      $insert_row = $db->insert($st->setStory($submitter, $category, $title, $author, $body));
    }
  }
?>

<h2 class="page-header">Add Story</h2>
<form method="post" action="add_story.php">
  <div class="form-group">
    <label>Story Title</label>
    <input name="title" type="text" class="form-control" placeholder="Enter title">
  </div>
  <div class="form-group">
    <label>Story Body</label>
    <textarea name="body" class="form-control" placeholder="Enter story"></textarea>
  </div>
  <div class="form-group">
    <label>Category</label>
    <select name="category" class="form-control">
      <?php while($row = $categories->fetch_assoc()) : ?>
        <?php if($row['id'] == $post['category']){
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
    <input name="author" type="text" class="form-control" placeholder="Enter author name">
  </div>
  <div>
    <input name="submit" type="submit" class="btn btn-default" value="Submit" />
    <a href="index.php" class="btn btn-primary">Cancel</a>
  </div>  
  <br>
</form>

<?php include 'includes/footer.php'; ?>