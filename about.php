<?php include 'includes/header.php'; ?>

<div class="container">
	<section>
		<div class="header">
      <h1 class="title">About</h1>
      <p class="lead description">Here you will find contact information, references, and credits for this website.</p>
    </div>

    <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">About</li>
    </ol>

    <div class="row">
      <div class="col-md-12">
        <!-- <figure class="center-block obit">
        	<img class="img-rounded img-responsive" src="images/Walter Hansen-28 roadster.jpg" alt="Walter Hansen and his 1928 roadster">
        	<figcaption class="text-center">Walter E Hansen and his 1928 roadster</figcaption>
        </figure><br> -->
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="images/Walter Hansen and his 28 roadster.jpg" alt="Walter E. Hansen and his 1928 roadster">
		      <div class="carousel-caption">
		        <h4>Walter E. Hansen and his 1928 roadster</h4>
		      </div>
		    </div>
		    <div class="item">
		      <img src="images/Behind Barn.jpg" alt="View from behind the barn">
		      <div class="carousel-caption">
		        <h4>View from behind the barn</h4>
		      </div>
		    </div>
		    <div class="item">
		      <img src="images/Driveway.jpg" alt="View from 12th Ave.">
		      <div class="carousel-caption">
		        <h4>View from 12th Ave.</h4>
		      </div>
		    </div>
		    <div class="item">
		      <img src="images/Ranch Sign.jpg" alt="Hansen North Fork Ranch">
		      <div class="carousel-caption">
		        <h4>North Fork Ranch, Hansen Family Farm</h4>
		      </div>
		    </div>
		    <div class="item">
		      <img src="images/Barn.jpg" alt="Front of barn">
		      <div class="carousel-caption">
		        <h4>The Barn</h4>
		      </div>
		    </div>
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>


        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">The Property</h3>
          </div>
          <div class="panel-body">
            It is our pleasure to share the history of this property, but the Hansen farm is not open to the public. Visitation is through family members only.
            If you would like to visit the farm, please contact us through the contact form on this page, or contact a family member directly.
          </div>
        </div>
      </div>
      <div class="col col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Contact Form</h3>
          </div>
          <div class="panel-body">
            We would like to include more stories about the family. If you have any historic photos, relevant obituaries, ideas you'd like to see added to this site, or any other reason, please contact us below!
          </div>
        </div>
        <?php email();  //email_helper ?>   
        <form id="form" action="about.php#form" method="post">
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name'] ?: ''); ?>">
              <?php echo "<p class='text-danger'>$errName</p>";?>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email'] ?: ''); ?>">
              <?php echo "<p class='text-danger'>$errEmail</p>";?>
            </div>
          </div>
          <div class="form-group">
            <label for="message" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
              <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message'] ?: '');?></textarea>
              <?php echo "<p class='text-danger'>$errMessage</p>";?>
            </div>
          </div>
          <div class="form-group">
            <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
              <?php echo "<p class='text-danger'>$errHuman</p>";?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary btn-lg">
              <a class="btn btn-danger btn-lg" href="about.php">Cancel</a>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <?php echo $result; ?>  
            </div>
          </div>
        </form>
      </div>
      <div class="col col-md-6">
		    <div class="panel panel-default">
			    <div class="panel-heading">
			      <h3 class="panel-title">Site Information</h3>
			    </div>
          <div class="panel-body">
            Below are the credits, references, and policies for this site. Select a heading to read its description.
          </div>
        </div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Credits
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <ul>
                  <li>There would be nothing here without <strong>Walter E. Hansen Sr.</strong>, whose own love of history and historical conservation kept the farm and its artifacts, including the pictures shown on this website intact.
                  <em>This website is dedicated to the memory of Grandpa Walt</em>.</li>
                  <li>The pictures showcased here were painstakingly and lovingly digitized by <strong>Martin Hansen.</strong></li>
                  <li>This website was written and is maintained by <strong>Adam Bailey</strong>. You may contact Adam for website questions at the contact form on this page.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  References
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="panel-body">
                <ul>
                  <li>Most of the information about the history of the family is from stories and facts recalled from the brain and archives of Walter Hansen, Sr. Where we were not sure of exact dates, minor estimations were made.</li>
                  <li>Information about early land ownership was retrieved from <a href="docs/AugustaHansenEstate.pdf" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Open PDF document - The last will and testament of Augusta Hansen</h4>">The last will and testament of Augusta Hansen</a>.</li>
                  <li>Some dates and information were retrieved from <a href="docs/Van_Are_Chr.pdf" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Open PDF document - Vancouver Area Chronology 1754-1958, Carl Landerholm</h4>">Vancouver Area Chronology 1754-1958, Carl Landerholm</a>. There is a wealth of Clark County history in this document.</li>
                  <li>There was a small amount of information about the Peter Hansen family recalled in <a href="http://www.lewisriver.com/pt2-page2.html" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Open Early Families in the Woodland Community, Judy Card</h4>">Early Families in the Woodland Community, Judy Card</a>, Which i used for reference.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Policies
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
              <div class="panel-body">
                All content from this website is copyrighted and must not be used without written consent. If you would like to use an image or story from this website, please feel free to contact us using the contact form on this page.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	</section>
</div>
<?php include 'includes/footer.php'; ?>