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
              if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];

                $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
                $select_profile = mysqli_query($connection,$query);
                if(!$select_profile){
                  die("Query Failed: ".mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($select_profile)){
                  $user_firstname = $row['user_firstname'];
                  $user_lastname = $row['user_lastname'];
                  $user_role = $row['user_role'];
                  $username = $row['username'];
                  $user_email = $row['user_email'];
                  $user_password = $row['user_password'];
                }
              }
              
              ?>
<?php
if(isset($_POST['update_user'])){
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  // $user_role = $_POST['user_role'];
  $username = $_POST['username'];
  $user_email = $_POST['user_email'];

  $query = "UPDATE users SET username = '{$username}',user_firstname = '{$user_firstname}',
  user_lastname = '{$user_lastname}',user_password = '{$user_password}',user_email = '{$user_email}' 
  WHERE user_id = '{$user_id}'";

  $update_profile = mysqli_query($connection,$query);
  if(!$update_profile){
    die("Query Failed: ".mysqli_error($connection));
  }
}

?>

              <form action="" method = "post" enctype = "multipart/form-data">

<div class="form-group">
  <label for="cat-title">First Name</label>
  <input type="text" class="form-control" name = "user_firstname" value = '<?php if(isset($user_firstname)) echo $user_firstname?>'>
</div>
<div class="form-group">
  <label for="cat-title">Last Name</label>
  <input type="text" class="form-control" name = "user_lastname" value = '<?php if(isset($user_lastname)) echo $user_lastname?>'>
</div>
 <!-- <div class="form-group"> -->
  <!-- <select name="user_role" id="user_role" > -->
    
  
    <!-- <option value='subscriber'><?php echo $user_role?></option>;   -->
   <!-- <?php
  //  if($user_role == "admin"){
  //    echo "<option value='subscriber'>subscriber</option>";
  //  }
  //  else{
  //    echo "<option value='admin'>Admin</option>";
    
  //  }
   ?> -->
   
  <!-- </select>
</div>  -->
<div class="form-group">
  <label for="username">Username</label>
  <input type="text" class="form-control" name = "username" value = '<?php if(isset($username)) echo $username?>'>
</div>
<div class="form-group">
  <label for="email">Email</label>
  <input type="text" class="form-control" name = "user_email" value = '<?php if(isset($user_email)) echo $user_email?>'>
</div>

<div class="form-group">
  <label for="password">Password</label>
  <input type="password" class="form-control" name = "user_password">
</div>
<div class="form-group">
  
  <input type="submit" class="btn btn-primary" name = "update_user" value = "update User">
</div>
</form>
              
                
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
