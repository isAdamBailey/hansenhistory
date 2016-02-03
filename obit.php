<?php include 'includes/header.php'; ?>

<?php
  if (isset($_GET['id'])){
   $id = $_GET['id'];
  } else {
    header("Location: obits.php");
    exit();
  }

  // create DB object
  $db = new Database();

  // obituaries
  $query = "SELECT * FROM tblObits WHERE id = ".$id;
  //run query
  $obit = $db->select($query)->fetch_assoc();

?>

<div class="container">
  <div class="header">
    <h1 class="title">Obituaries</h1>
    <p class="lead description">The memories of those who have passed</p>
  </div>

  <ol class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="obits.php">Obituaries</a></li>
    <li class="active"><?php echo $obit['Name']; ?></li>
  </ol>

  <div class="row">
    <div class="story-main col-md-12">
      <div class="page-header">
        <h1><?php echo $obit['Name']; ?></h1>
        <h4><?php echo formatDate($obit['BirthDate']); ?> ~ <?php echo formatDate($obit['DeathDate']); ?></h4>
      </div>
      <div class="center-block thumbnail obit">
        <img class="img-rounded" src="images/obits/<?php echo $obit['ImagePath']; ?>" alt="<?php echo $obit['ImagePath']; ?>">
      </div>
      <p><?php echo $obit['Obituary']; ?></p>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>