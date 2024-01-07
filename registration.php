


<?php
if(isset($_POST['submit'])){
     $username = $_POST['username'];
     $user_email = $_POST['email'];
     $user_password = $_POST['password'];
     
     if(!empty($username) && !empty($user_email) && !empty($user_password) ){
         
         $username = mysqli_real_escape_string($connection,$username);
         $user_email = mysqli_real_escape_string($connection,$user_email);
         $user_password = mysqli_real_escape_string($connection,$user_password);
         $password_hash = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>12));
         
        //  $query = "SELECT * FROM users";
        //  $randsalt = mysqli_query($connection,$query);
        //  if(!$randsalt){
        //      die("Query Failed: ".mysqli_error($connection));
        //     }
        //     $row = mysqli_fetch_assoc($randsalt);
            
        //     $salt =  $row['user_randsalt'];
           

        //     $password_hash = crypt($user_password, $salt);
            $query = "INSERT INTO users(username,user_password,user_email,user_role,user_date)
   VALUES ('{$username}','{$password_hash}','{$user_email}',
   'subscriber',NOW())";
    $add_user = mysqli_query($connection,$query);
    if(!$add_user){
        die("Query Failed: ".mysqli_error($connection).' '.mysqli_errno($connection));
    }
    $message = "Registration successfull";
}
  
  else{
    $message = "Fields can't be empty";
  }
 
}
else{
    $message = "";
}
?>
<!DOCTYPE html>
<html lang="en">

 <?php  include "includes/header.inc.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/nav.inc.php"; ?>
    
 <body>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class = "text-center"><?php echo $message?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.inc.php";?>
</body>
</html>
