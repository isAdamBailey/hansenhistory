<?php 
  include 'includes/header.php'; 

  $db = new Database();
  $obit = new Obituary();

  $obits = $db->select($obit->getAllObituaries());
?>

<div class="container">
  <div class="header">
    <h1 class="title">Obituaries</h1>
    <p class="lead description">The memories of those who have passed</p>
  </div>

  <ol class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Obituaries</li>
  </ol>

  <div class="row grid center-block wow fadeIn" data-wow-delay="1s">
    <?php if($obits) : ?>
      <?php while($row = $obits->fetch_assoc()) : ?>
        <div class="obits grid-item wow fadeInUp">
          <div class="thumbnail">
            <img class="img-rounded" src="images/obits/<?php echo $row['ImagePath']; ?>" alt="<?php echo $row['ImagePath']; ?>">
            <div class="caption">
              <h3><?php echo $row['Name']; ?></h3>
              <h5><?php echo formatDate($row['BirthDate']); ?> ~ <?php echo formatDate($row['DeathDate']); ?></h5>
              <p><?php echo shortenText($row['Obituary'], 150); ?></p>
          		<a class="readmore" href="obit.php?id=<?php echo urlencode($row['id']); ?>" role="button">Read More</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else : ?>
      <p>There are no obituaries yet</p>
    <?php endif; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>