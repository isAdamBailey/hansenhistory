<?php 
  ob_start();
  session_start(); 
?>
<?php 
  include '../config/config.php';

  include '../libraries/Database.php';
  include '../libraries/Obituary.php';
  include '../libraries/Category.php';
  include '../libraries/Picture.php';
  include '../libraries/User.php';
  include '../libraries/Story.php';
  
  include '../helpers/format_helper.php';
  include '../helpers/upload_helper.php';
?>
<?php require 'auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin | HNFR</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/custom.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
  </head>

  <body>

    <div class="masthead">
      <div class="container">
          <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar top-bar"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
              </button>
              <!-- <a class="navbar-brand" href="#">Project name</a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="nav-item <?=echoActive("index")?>"><a href="index.php"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Dashboard</a></li>
                <li class="nav-item <?=echoActive("add_user")?>"><a href="add_user.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Add User</a></li>
                <li class="nav-item <?=echoActive("add_story")?>"><a href="add_story.php"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Add Story</a></li>
                <li class="nav-item <?=echoActive("add_image")?>"><a href="add_image.php"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Add Image</a></li>
                <li class="nav-item <?=echoActive("add_obit")?>"><a href="add_obit.php"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span> Add Obituary</a></li>
                <li class="nav-item <?=echoActive("add_category")?>"><a href="add_category.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Category</a></li>
                <li class="nav-item"><a href="../index.php" target="_blank"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Go To Site</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown nav-item">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sign-out"></i> Log Out <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="navbar-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                      <?php
                        $user = $_SESSION['user']; 
                        $submitter = $_SESSION['id'];
                        if($_SESSION['user']) {
                          echo $user;
                          } else { echo "Username not set";
                        }
                      ?>
                    </li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></li>
                  </ul>
                </li>
              </ul>            
            </div><!--/.nav-collapse -->
          </div><!--/.container-fluid -->
        </nav>
      </div>
    </div>

    <div class="container">
      <div class="header">
      <h1 class="title">Admin</h1>
      <p class="lead description">Site Administration</p>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <?php if(isset($error)) : ?>
          <div class="alert alert-danger"><?php echo $error ;?></div>
        <?php endif; ?>
        <?php if(isset($_GET['msg'])) : ?>
          <div class="alert alert-success"><?php echo htmlentities($_GET['msg']) ;?></div>
        <?php endif; ?>
      </div>
    </div>
