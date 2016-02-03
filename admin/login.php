<?php
  include '../config/config.php';
  include '../libraries/Database.php';
  session_start();

if (isset($_POST['name']) && isset($_POST['password'])) {
    
    $login = $_POST['name'];

    $db = new Database;

    $query = "SELECT * FROM tblUsers WHERE Name = '$login'";

    $user = $db->select($query);

    if ($row = $user->fetch_assoc()) {
        $hash = $row['Password'];
        $isAdmin = $row['isAdmin'];

        if (password_verify($_POST['password'], $hash)) {

          //   _SESSION  variables!
            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = $row['Name'];
            $_SESSION['isAdmin'] = $isAdmin;
            header('Location: index.php');

        } else {
            $error = 'Login failed.';
        }
    } else {
        $error = 'Login failed.';
    }
    //mysqli_close($db);
} 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign In | Hansen Admin</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <h1 class="page-header text-center">Hansen North Fork Ranch Administration Page</h1>
      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <input type="text" name="name" id="inputName" class="form-control" placeholder="Login Name" required autofocus>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

      <div class="col-sm-2 col-sm-offset-5 text-center">
        <?php
            echo "<p>$message</p>";
        ?>
      </div>

    </div> <!-- /container -->

  </body>
</html>