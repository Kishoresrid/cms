<?php session_start();?>
<?php include "includes/functions.php";?>

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
               Welcome to admin
                <small>author</small>
              </h1>
              <div class="col-xs-6">
                 <?php  add_categories(); ?>


                <form action="category.php" method = "POST">
                  <div class="form-group">
                    <label for="cat-title">Add Category</label>
                    <input type="text" class="form-control" name = "cat-title">
                  </div>
                  <div class="form-group">
                    
                    <input type="submit" class="btn btn-primary" name = "submit" value = "Add category">
                  </div>
                </form>


                

                 
          <?php
          if(isset($_GET['edit_id'])){
            $edit_id = $_GET['edit_id'];

           include "includes/update_cat.php";
          }
          
          ?>
  
              </div>
              <div class="col-xs-6">

              



                <table class = "table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                    </tr>
                  </thead>
                  <tbody>
                 

                  <?php
                      //  Categories select query ----
                      selectAllCategories();    
                      
                      ?>
                    
                  <?php
                      //  Delete Query ---- 
                      
                        deleteCategory();
                      
                    ?>
                  </tbody>
                </table>
              </div>
              
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