<?php include 'includes/header.php'; ?>
<?php

  // create DB object
  $db = new Database();
  $st = new Story();
  $ca = new Category();

   // check url for category
  if(isset($_GET['category'])){
    $category = $_GET['category'];
    $stories = $db->select($st->getStoryByCategory($category));
    $cat = $db->select($ca->getCategoryById($category))->fetch_assoc();
  } else {
    $stories = $db->select($st->getAllStories());
  }

  $categories = $db->select($st->getStoryCategories());
?>

<div class="container">
  <div class="header">
    <h1 class="title">Stories</h1>
    <?php if(isset($category)) : ?>
      <p class="lead description">Stories in the <?php echo $cat['Name']; ?> category</p>
    <?php else : ?>
      <p class="lead description">The Hansen farm and stories of its people</p>
    <?php endif; ?>
  </div>

  <ol class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <?php if(isset($category)) : ?>
      <li><a href="stories.php">Stories</a></li>
      <li class="active"><?php echo $cat['Name']; ?></li>
    <?php else : ?>
      <li class="active">Stories</li>
    <?php endif; ?>
  </ol>

  <div class="row">
    <div class="col-sm-9 story-main">
      <?php if($stories) : ?>
        <?php while($row = $stories->fetch_assoc()) : ?>
          <div class="stories wow fadeIn">
            <h2 class="story-post-title"><?php echo $row['Title']; ?></h2>
            <p class="story-post-author">By: <?php echo $row['Author']; ?></p>
            <?php
  	          // submitter for each story
      			  $query = "SELECT Name FROM tblUsers WHERE id = ".$row['UserId'];
      			  $submitter = $db->select($query)->fetch_assoc(); 
            ?>
            <p class="story-post-meta">Added by <?php echo $submitter['Name']; ?> on <?php echo formatDate($row['Date']); ?></p>        
            <p><?php echo shortenText($row['Body']); ?></p>
        		<a class="readmore" href="story.php?id=<?php echo urlencode($row['id']); ?>" role="button">Read More</a>
          </div><!-- /.story-post -->
       <?php endwhile; ?>
      <?php else : ?>
        <p>There are no stories yet</p>
      <?php endif; ?>
    </div><!-- /.story-main -->
    
    <div class="col-sm-3">
      <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p><?php echo $about_stories; ?></p>
      </div>
      <div class="sidebar-module">
        <h4>Categories</h4>
        <?php if($categories) : ?>
          <ol class="list-unstyled">
          <?php while($row = $categories->fetch_assoc()) : ?>
            <li><a href="stories.php?category=<?php echo $row['id']; ?>" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4><?php echo $row['Name']; ?> Category</h4>">
              <?php echo $row['Name']; ?></a>
            </li>
          <?php endwhile; ?>
          </ol>
        <?php else : ?>
          <p>There are no categories yet</p>
        <?php endif; ?>
        <div id="search-form">
          <h4>Search All Stories</h4>       
          <form method="get" action="stories.php#search-form">
            <input type="text" name="search" class="form-control" placeholder=""><br>
            <input class="btn btn-default" type="submit" name="submit" value="Search">
            <button href="stories.php#search-form" class="btn btn-default">Reset</button><br><br>
          </form>
          <div class="search-function animated pulse">
            <?php search();   // search_helper ?>
          </div>
        </div>
      </div>
    </div><!-- /.story-sidebar -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php include 'includes/footer.php'; ?>