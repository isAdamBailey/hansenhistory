<?php 
  include 'includes/header.php';

  $id = $_GET['id'];

  $db = new Database();
  $st = new Story();

  $story = $db->select($st->getStoryById($id))->fetch_assoc();

  $categories = $db->select($st->getStoryCategories());

  $submitter = $db->select($st->getStorySubmitter($story))->fetch_assoc();
?>

<div class="container">
  <div class="header">
    <h1 class="title">Stories</h1>
    <p class="lead description">The Hansen farm and stories of its people</p>
  </div>

  <ol class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="stories.php">Stories</a></li>
    <li class="active"><?php echo $story['Title']; ?></li>
  </ol>

  <div class="row">
    <div class="col-sm-9 story-main">
      <div class="story">
          <h2 class="story-post-title"><?php echo $story['Title']; ?></h2>
          <p class="story-post-author">By: <?php echo $story['Author']; ?></p>    
          <p class="story-post-meta">Added by <?php echo $submitter['Name']; ?> on <?php echo formatDate($story['Date']); ?></p>
          <p><?php echo $story['Body']; ?></p>
      </div><!-- /.story-story -->
    </div><!-- /.story-main -->
    <div class="col-sm-3">
      <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p><?php echo $about_stories; ?></p>
        <a class="btn btn-primary text-center" href="stories.php" role="button">Return To All Stories</a>
      </div>
      <div class="sidebar-module">
        <h4>Categories</h4>
        <?php if($categories) : ?>
          <ol class="list-unstyled">
          <?php while($row = $categories->fetch_assoc()) : ?>
            <li><a href="stories.php?category=<?php echo $row['id']; ?>" data-html="true" data-toggle="tooltip" data-placement="right" title="<h4><?php echo $row['Name']; ?> Category</h4>">
              <?php echo $row['Name']; ?></a>
            </li>
          <?php endwhile; ?>
          </ol>
        <?php else : ?>
          <p>There are no categories yet</p>
        <?php endif; ?>
      </div>
    </div><!-- /.story-sidebar -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php include 'includes/footer.php'; ?>