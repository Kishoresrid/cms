<?php session_start();?>
<?php include "includes/functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <?php
  include "includes/ad_header.php";
  ?>
  <body>
 

    <div id="wrapper">
      <!-- Navigation -->
      <?php
  include "includes/ad_nav.php";
  ?>
      <div id="page-wrapper">
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">
                Welcome to Admin
                <small>Author</small>
              </h1>
              

<?php
 if(isset($_GET['source'])){
  $source = $_GET['source'];
 }
 else{
  $source = "";
 }

 switch($source){
  case 'add_post':
    include "includes/add_post.php";
    break;
  case 'edit_post':
    include "includes/edit_post.php";
    break;
  default:
    include "includes/get_all_posts.php";
    break;
 }
?>
               
                
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    
    <script src = "js/script.js"></script>
<script>
   $(document).ready(function () {
  $("#selectAllBoxes").click(function (event) {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });
});

</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
   
  </body>
</html>
