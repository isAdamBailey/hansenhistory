<?php include 'includes/header.php'; ?>

<?php
    
  // create DB object
  $db = new Database();

  if(isset($_POST['submit'])){
    //assign post variables
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $password = mysqli_real_escape_string($db->link, $_POST['password']);
    $confirm = mysqli_real_escape_string($db->link, $_POST['confirmPassword']);
    $isadmin = mysqli_real_escape_string($db->link, $_POST['isAdmin']);
    // simple validation
    if($name == ''|| $password == ''|| $confirm ==''|| $isadmin == ''){
      // set error
      $error = 'Please fill out all required fields.';
    } else {
      // make sure name does not already exist
      $query = 'SELECT Name FROM tblUsers WHERE Name = "'.$name.'"';
      $checkUsername = $db->select($query);
      if (mysqli_num_rows($checkUsername) > 0) {
         $error = 'User name already exists.';
      } else { 
        
        // make sure passwords match
        if ($password != $confirm){
          $error = 'Passwords must match!';
        } else {
          $hash = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO tblUsers
                (Name, Password, isAdmin)
                  VALUES ('$name', '$hash', '$isadmin')";
      $insert_row = $db->insert($query);
      }
    }
  }
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2 class="page-header">Add User</h2>
      <form class="form-horizontal" method="post" action="">
        <div class="form-group">
          <label for="username" class="col-sm-3 control-label">User Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="username" name="name" value="<?php
              echo htmlspecialchars($name);
              ?>" placeholder="User name">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-6">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          </div>
       </div>
       <div class="form-group">
          <label for="confirmPassword" class="col-sm-3 control-label">Confirm</label>
          <div class="col-sm-6">
            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-3 control-label">Set As Admin?</label>
          <div class="col-sm-6 btn-group" data-toggle="buttons">
            <label class="btn btn-primary <?php
                  if ($setadmin === '0') {
                      echo ' active';
                  }
              ?>">
                <input type="radio" name="isAdmin" id="radio1" value="0" <?php
                  if ($setadmin === '0') {
                      echo ' checked';
                  }
              ?>>No
            </label>
            <label class="btn btn-primary <?php
                  if ($setadmin === '1') {
                      echo ' active';
                  }
              ?>">
                <input type="radio" name="isAdmin" id="radio2" value="1" <?php
                  if ($setadmin === '1') {
                      echo ' checked';
                  }
              ?>> Yes
            </label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-6">
            <button type="submit" name="submit"class="btn btn-default btn-lg">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>