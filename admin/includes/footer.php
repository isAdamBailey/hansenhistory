
        </div>
      </div>
    </div>
    
    <footer>
      <p class="pull-right"><a href="http://ajamesb.com/" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Site by Adam Bailey</h4>" target="_BLANK"><span class="glyphicon glyphicon-music"></span><small> <strong>AB</strong></small></a></p>
      <p><small>&copy; 2015 - <?php echo date("Y"); ?> &middot; Hansen North Fork Ranch</small></p>
      <p class="text-center"><a href="#" data-html="true" data-toggle="tooltip" data-placement="top" title="<h4>Top of page</h4>">Back to top</a></p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
      tinymce.init({ 
        selector:'textarea',
        plugins: [
          'advlist autolink lists link charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview | forecolor backcolor emoticons'
      });
      
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

      $(document).ready(function(){
        $(".delete").click(function(e){
            if(!confirm('Are you sure you want to delete?')){
                e.preventDefault();
                return false;
            }
            return true;
        });
    });
    </script>
  </body>
</html>