<?php include 'includes/header.php'; ?>
<?php

// get database object
$db = new Database;

// stories
$query = "SELECT tblStories.*, tblCategories.Name FROM tblStories
          INNER JOIN tblCategories
          ON tblStories.CategoryId = tblCategories.id
          ORDER BY  tblStories.id DESC";
$stories = $db->select($query);

// all users
$query = "SELECT * FROM tblUsers";
$users = $db->select($query);

// categories
$query = "SELECT * FROM tblCategories
          ORDER BY Name DESC";
$categories = $db->select($query);

// obituaries
$query = "SELECT * FROM tblObits
          ORDER BY id DESC";
$obituaries = $db->select($query);

// images
$query = "SELECT * FROM tblImages
            ORDER BY id DESC";
$images = $db->select($query);

?>
<div class="col-md-12">
  <h3>Stories</h3>
  <table class="table table-striped">
    <tr>
      <th>Story ID#</th>
      <th>Title</th>
      <th>Category</th>
      <th>Submitter</th>
      <th>Date</th>
    </tr>    
    <?php while($row = $stories->fetch_assoc()) : ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="edit_story.php?id=<?php echo $row['id']; ?>" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Edit <?php echo $row['Title']; ?></h4>">
          <span class="glyphicon glyphicon-pencil"></span> <?php echo $row['Title']; ?></a></td>
        <td><?php echo $row['Name']; ?></td>
        <?php
            // submitter for each story
            $query = "SELECT Name FROM tblUsers WHERE id = ".$row['UserId'];
            $submitter = $db->select($query)->fetch_assoc();
        ?>
        <td><?php echo $submitter['Name']; ?></td>
        <td><?php echo formatDateTime($row['Date']); ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
<div class="col-md-12">
  <h3>Obituaries</h3>
  <table class="table table-striped">
    <tr>
      <th>ID#</th>
      <th>Name</th>
      <th>Obituary</th>
      <th>Birth</th>
      <th>Death</th>
    </tr>    
    <?php while($row = $obituaries->fetch_assoc()) : ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="edit_obit.php?id=<?php echo $row['id']; ?>" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Edit <?php echo $row['Name']; ?>'s Obituary</h4>">
          <span class="glyphicon glyphicon-pencil"></span> <?php echo $row['Name']; ?></a></td>
        <td><?php echo shortenText($row['Obituary'], 80); ?></td>
        <td><?php echo formatDate($row['BirthDate']); ?></td>
        <td><?php echo formatDate($row['DeathDate']); ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
<div class="col-md-6">
  <h3>Categories</h3>
  <table class="table table-striped">
    <tr>
      <th>Category ID#</th>
      <th>Category Name</th>
    </tr>
    <?php while($row = $categories->fetch_assoc()) : ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="edit_category.php?id=<?php echo $row['id']; ?>" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Edit <?php echo $row['Name']; ?> Category</h4>">
          <span class="glyphicon glyphicon-pencil"></span> <?php echo $row['Name']; ?></a></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
<div class="col-md-6">
  <h3>Users</h3>
  <table class="table table-striped">
    <tr>
      <th>User ID#</th>
      <th>User Name</th>
    </tr>
    <?php while($row = $users->fetch_assoc()) : ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="edit_user.php?id=<?php echo $row['id']; ?>" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Edit <?php echo $row['Name']; ?></h4>">
          <span class="glyphicon glyphicon-pencil"></span> <?php echo $row['Name']; ?></a></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
<div class="row">
  <div class="col-sm-10">
    <h2 class="page-header">Images</h2>
    <table class="table table-striped">
      <tr>
        <th>ID#</th>
        <th>Image</th>
        <th>Year</th>
        <th>Title</th>
        <th>Description</th>
        <th>Category</th>
        <th>Action</th>
    </tr> 
    <?php while($row = $images->fetch_assoc()) : ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><img class="img-thumbnail img-responsive" src="../images/gallery/<?php echo $row['ImagePath']; ?>" alt="<?php echo $row['Title']; ?>" title="<?php echo $row['ImagePath']; ?>"/></td>
        <td><?php echo $row['Year']; ?></td>
        <td><?php echo $row['Title']; ?></td>
        <td><?php echo shortenText($row['Description'], 100); ?></td>
        <?php
          // category for each image
          $query = "SELECT Name FROM tblCategories WHERE id = ".$row['CategoryId'];
          $cat = $db->select($query)->fetch_assoc();
        ?>
        <td><?php echo $cat['Name']; ?></td>
        <td><a class="btn btn-default" href="edit_image.php?id=<?php echo $row['id']; ?>" role="button"><span class="glyphicon glyphicon-pencil"></span> Edit</a><br><br></td>
      </tr>
    <?php endwhile; ?>
    </table>
  </div>
</div>

<?php include 'includes/footer.php'; ?>