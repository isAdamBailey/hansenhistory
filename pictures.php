<?php include 'includes/header.php'; ?>
<?php

  // create DB object
  $db = new Database();
  $pi = new Picture();
  $ca = new Category();

  // check url for _GET values
  if(isset($_GET['category'])){
    $category = $_GET['category'];
    $images = $db->select($pi->getPictureByCategory($category));
    $cat = $db->select($ca->getCategoryById($category))->fetch_assoc();

  } else {
    if(isset($_GET['year'])){
      $year = $_GET['year'];
      $images = $db->select($pi->getPictureByYear($year));
      
    } else {
      $images = $db->select($pi->getAllPictures());
    }
  }

  $years = $db->select($pi->getPictureYears());

  $picture_categories = $db->select($pi->getPictureCategories());
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
        <p>Here we will share pictures of the land and family.</p>
        <a class="btn btn-primary text-center" href="pictures.php" role="button">All Pictures</a>
      </div>
      <div class="sidebar-module">
        <h4>Categories</h4>
        <?php if($picture_categories) : ?>
          <ol class="list-unstyled">
          <?php while($row = $picture_categories->fetch_assoc()) : ?>
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
  // script to select dropdown menu items as links
  document.getElementById('year').onchange = function() {
      window.location.href = this.children[this.selectedIndex].getAttribute('href');
  }

  /*
  * lazy-simon.js
  *
  *  Minimal effort 350 byte JavaScript library to lazy load all <img> on your website
  *
  * License: MIT (https://github.com/simonfrey/lazysimon/blob/master/LICENSE)
  */
  o = new IntersectionObserver((a, s) => {
    a.forEach(e => {
      if (e.isIntersecting) {
        e.target.src = e.target.dataset.l;
        s.unobserve(e.target);
      }
    });
  });
  d = document.querySelectorAll("img");
  for (let i = d.length - 1; i >= 0; i--) {
    const e = d[i];
    if (e.loading !== undefined){
      e.loading = "lazy"
    }else{
      e.dataset.l = e.src;
      e.src = "data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1' />";
      o.observe(e);
    }
  }
</script>

<?php include 'includes/footer.php'; ?>
