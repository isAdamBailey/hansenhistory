<?php include 'includes/header.php'; ?>
<?php

  // create DB object
  $db = new Database();

  // check url for _GET values
  if(isset($_GET['category'])){
    $category = $_GET['category'];
    // create images by category
    $query = "SELECT * FROM tblImages WHERE CategoryId = ".$category;
    $images = $db->select($query);
    // get category name
    $query = "SELECT Name FROM tblCategories WHERE id = ".$category;
    $cat = $db->select($query)->fetch_assoc();
  } else {
    // check url for year
    if(isset($_GET['year'])){
      $year = $_GET['year'];
      // create images by category
      $query = "SELECT * FROM tblImages WHERE Year = ".$year;
      //run query
      $images = $db->select($query);
    } else {
      //  if no category then create all images query
      $query = "SELECT * FROM tblImages
                ORDER BY Year ASC";
      //run query
      $images = $db->select($query);
    }
  }

  // get years
  $query = "SELECT DISTINCT Year FROM tblImages
            ORDER BY Year ASC";
  $years = $db->select($query);

  // get all categories

  // get only categories related to a story
  $query = "SELECT tc.id, Name FROM (SELECT DISTINCT * FROM tblCategories) as tc
            INNER JOIN tblImages
            ON tc.id = tblImages.CategoryId
            GROUP BY Name";
  //run query
  $story_categories = $db->select($query);
?>

<div class="container">
  <div class="header">
    <h1 class="title">Pictures</h1>
    <?php if(isset($year)) : ?>
      <p class="lead description">Pictures taken in the year <?php echo $year; ?></p>
    <?php elseif(isset($category)) : ?>
      <p class="lead description">Pictures in the <?php echo $cat['Name']; ?> category</p>
    <?php else : ?>
      <p class="lead description">Pictures of the land and family.</p>
    <?php endif; ?>
  </div>

  <ol class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <?php if(isset($year)) : ?>
      <li><a href="pictures.php">Pictures</a></li>
      <li class="active"><?php echo $year; ?></li>
    <?php elseif(isset($category)) : ?>
      <li><a href="pictures.php">Pictures</a></li>
      <li class="active"><?php echo $cat['Name']; ?></li>
    <?php else : ?>
      <li class="active">Pictures</li>
    <?php endif; ?>
  </ol>

  <div class="row">
    <div class="pictures col-sm-9">
      <div class="grid wow fadeIn" data-wow-delay="1s">
        <?php if($images) : ?>
          <?php while($row = $images->fetch_assoc()) : ?>          
            <a href="images/gallery/<?php echo $row['ImagePath']; ?>" data-lightbox="gallery" data-title="<?php echo $row['Description']; ?>Dated <?php echo $row['Year']; ?>">
            <img class="grid-item wow fadeInUp" src="images/gallery/<?php echo $row['ImagePath']; ?>" alt="<?php echo $row['Title']; ?>" data-toggle="tooltip" data-html="true" title="<h4><?php echo $row['Title']; ?></h4>"></a>               
          <?php endwhile; ?>
          <?php else : ?>
            <p>There are no pictures yet</p>
          <?php endif; ?>
        </div>
    </div>  
    <div class="col-sm-3">
      <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p><?php echo $about_images; ?></p>
        <a class="btn btn-primary text-center" href="pictures.php" role="button">All Pictures</a>
      </div>
      <div class="sidebar-module">
        <h4>Categories</h4>
        <?php if($story_categories) : ?>
          <ol class="list-unstyled">
          <?php while($row = $story_categories->fetch_assoc()) : ?>
            <li><a href="pictures.php?category=<?php echo $row['id']; ?>" data-html="true" data-toggle="tooltip" data-placement="right" title="<h4><?php echo $row['Name']; ?> Category</h4>">
              <?php echo $row['Name']; ?></a>
            </li>
          <?php endwhile; ?>
          </ol>
        <?php else : ?>
          <p>There are no categories yet</p>
        <?php endif; ?>
        <br><h4>Filter By Year</h4>
        <select class="form-control" id="year">
          <option>Select a year</option>
          <?php while($row = $years->fetch_assoc()) : ?>
            <option value="<?php echo $row['Year']; ?>" href="pictures.php?year=<?php echo $row['Year']; ?>"><?php echo $row['Year']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>
    </div><!-- /sidebar -->
  </div><!-- /.row -->
</div><!-- /.container -->

<script>
  // script to select dropdawn menu items as links
  document.getElementById('year').onchange = function() {
      window.location.href = this.children[this.selectedIndex].getAttribute('href');
  }
</script>

<?php include 'includes/footer.php'; ?>