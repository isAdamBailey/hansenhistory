<?php include 'includes/header.php'; ?>

<?php

  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: index.php');
  }

  // get database object
  $db = new Database;

  // get user
  $query = "SELECT * FROM tblUsers WHERE id = ".$id;
  $user = $db->select($query)->fetch_assoc();

  // if submit button is pressed
  if(isset($_POST['submit'])){

    // simple validation
    if($name == '' && !isset($_POST['name']) || $setadmin == ''  && !isset($_POST['isAdmin'])){
      // set error
      $error = 'Please fill out all required fields.';
    } else {
        //assign variables
        $name = mysqli_real_escape_string($db->link, $_POST['name']);
        $isadmin = mysqli_real_escape_string($db->link, $_POST['isAdmin']);
        
        // add database code here
        $query = "UPDATE tblUsers 
                  SET Name = '$name', 
                      isAdmin = '$isadmin'
                  WHERE id = ".$id;

        $update_row = $db->update($query);
      }
  }

// password change section

 if (isset($_POST['submit2'])) {

    if (isSet($_POST['password']) && isSet($_POST['newPassword']) && isSet($_POST['confirmPassword']) 
        && $_POST['password'] != '' && $_POST['newPassword'] != '' && $_POST['confirmPassword'] != '') { 
        $newPassword = $_POST['newPassword'];
        $confirm = $_POST['confirmPassword'];
        
        if ($newPassword == $confirm) {
          $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
          $password = $_POST['password'];
          $password = password_hash($password, PASSWORD_DEFAULT);

           // get password
          $query = "SELECT Password FROM tblUsers WHERE id = ".$id;
          $row = $db->select($query)->fetch_assoc();

          if ($row) {

            $hash = $row['Password'];

            if (password_verify($_POST['password'], $hash)) {
              $query = "UPDATE tblUsers 
                        SET Password = '$newPassword'
                        WHERE id = " .$id;
              $update_row = $db->update($query);
          } else 
              $error = 'Incorrect password.';

        } else 
            $error = 'Confirm password needs to match.';
     }
   }
}

?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="page-header">Edit User</h2>
        <form class="form-horizontal" method="post" action="edit_user.php?id=<?php echo $id; ?>">
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">User Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="name" value="<?php
                echo $user['Name']; ?>" placeholder="User name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Set As Admin?</label>
            <div class="col-sm-6 btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php
                    if ($user['isAdmin'] === '0') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="isAdmin" id="radio1" value="0" <?php
                    if ($isadmin === '0') {
                        echo ' checked';
                    }
                ?>>No
              </label>
              <label class="btn btn-primary <?php
                    if ($user['isAdmin'] === '1') {
                        echo ' active';
                    }
                ?>">
                  <input type="radio" name="isAdmin" id="radio2" value="1" <?php
                    if ($isadmin === '1') {
                        echo ' checked';
                    }
                ?>> Yes
              </label>
            </div>
          </div>
          <div>
            <input name="submit" type="submit" class="btn btn-default" value="Submit" />
            <a href="index.php" class="btn btn-primary">Cancel</a>
            <input name="delete" type="submit" class="btn btn-danger delete" value="Delete" />
          </div> 
        </form>

        <!-- password change section -->
        <form class="form-horizontal" method="post" action="">
         <h3 class="page-header">
            Change Password
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Change Password" 
          data-content="Password can be changed after entering current password and confirming the new one.">
          <i class="fa fa-info-circle"></i></a></h3>
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" id="password" name="password"  placeholder="Current Password">
            </div>
          </div>
          <div class="form-group">
            <label for="newPassword" class="col-sm-3 control-label">New password</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
            </div>
          </div>
          <div class="form-group">
            <label for="confirmPassword" class="col-sm-3 control-label">Confirm</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password">
            </div>
          </div> 
          <div>
            <input name="submit2" type="submit" class="btn btn-default" value="Submit" />
            <a href="index.php" class="btn btn-default">Cancel</a>
          </div> 
        </form>

      </div>
    </div>
  </div>
<?php include 'includes/footer.php'; ?>