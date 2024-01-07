<?php session_start();?>
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
  case 'add_user':
    include "includes/add_user.php";
    break;
  case 'edit_user':
    include "includes/edit_user.php";
    break;
  default:
    include "includes/get_all_users.php";
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>