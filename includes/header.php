<?php ob_start(); ?>
<?php include 'config/config.php'; ?>

<?php include 'libraries/Database.php'; ?>
<?php include 'libraries/Obituary.php'; ?>
<?php include 'libraries/Picture.php'; ?>
<?php include 'libraries/Category.php'; ?>
<?php include 'libraries/Story.php'; ?>

<?php include 'helpers/format_helper.php'; ?>
<?php include 'helpers/search_helper.php'; ?>
<?php include 'helpers/email_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The Hansen family has lived on or near this property on the south bank of the North Fork Lewis River near Woodland, Washington for over a century. This site showcases the history, images, and memories of the people who have lived here.">
    <meta name="keywords" content="history, clark county, woodland wa, local history, clark county history, walter hansen, lewis river, washington history">
    <title>Hansen North Fork Ranch</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/lightbox.css">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-61157924-1', 'auto');
      ga('send', 'pageview');
    </script>

   <script type="text/javascript">
    $(window).load(function() {
      $(".loader").fadeOut("slow");
    })
   </script>
  </head>

  <body>
    <!-- <div class="loader"></div> -->
    
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
              <a class="navbar-brand" href="index.php" data-html="true" data-toggle="tooltip" data-placement="bottom" title="<h4>Hansen North Fork Ranch</h4>">
                <img class="img-circle img-responsive" src="images/dark-farm.jpg" />
              </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="nav-item <?=echoActive("index")?>"><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
                <li class="nav-item <?=echoActive("stories")?>"><a href="stories.php"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Stories</a></li>
                <li class="nav-item <?=echoActive("pictures")?>"><a href="pictures.php"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Pictures</a></li>
                <li class="nav-item <?=echoActive("obits")?>"><a href="obits.php"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Obituaries</a></li>
                <li class="nav-item <?=echoActive("about")?>"><a href="about.php"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> About</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div><!--/.container-fluid -->
        </nav>
      </div>
    </div>

 