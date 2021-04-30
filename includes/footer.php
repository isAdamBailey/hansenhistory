

    <footer>
      <p class="pull-right"><a href="https://adambailey.io" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Site by Adam Bailey</h4>" target="_BLANK"><span class="glyphicon glyphicon-music"></span><small> <strong>AB</strong></small></a></p>
      <p class="pull-left"><small>&copy; 2015 - <?php echo date("Y"); ?></small></p>
      <h4 class="text-center wow bounce"><a href="#" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Top of the page</h4>">Back To Top</a></h4>
    </footer>

    <script src="js/bootstrap.js"></script>
    <!-- parallax-scroll https://github.com/alumbo/jquery.parallax-scroll-->
    <script src="js/jquery.parallax-scroll.js"></script>
    <script src="js/lightbox.js"></script>
    <script src="js/masonry.pkgd.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/imagesLoaded.js"></script>
    <script>
      // initialize and configure masonry
      $(document).ready(function(){
  	    $('.grid').masonry({
  		  // options
  		  itemSelector: '.grid-item',
    		});
    	});

      var $container = $('.grid');
        $container.imagesLoaded(function(){
        $container.masonry({
        itemSelector : '.grid-item'
        });
      });

      // initialize tooltips
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

      // initialize WOW
      new WOW().init();
    </script>
    
  </body>
</html>