<?php 
  include 'includes/header.php'; 

  $db = new Database();
  $ob = new Obituary();

  uploadObitImage();
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