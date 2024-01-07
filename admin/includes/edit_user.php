<?php
if(isset($_GET['edit_user_id'])){
  $edit_user_id = $_GET['edit_user_id'];

  $query = "SELECT * FROM users WHERE user_id = '{$edit_user_id}'";
  $edit_user_details = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($edit_user_details)){
    $user_id = $row['user_id'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $username = $row['username'];
    $post_status = $row['username'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
    $user_randsalt = $row['user_randsalt'];
    
    
  }
  
  if(isset($_POST['edit_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    if(!empty($user_password)){
      $query_password = "SELECT user_password FROM users WHERE user_id = '{$user_id}'";
      $get_password = mysqli_query($connection,$query_password);
      if(!$get_password){
        die("Query Failed");
      }
      $row = mysqli_fetch_assoc($get_password);
      $db_user_password = $row['user_password'];
      
      // $hash_password = crypt($user_password,$user_randsalt);
      if($db_user_password !== $user_password){
        $hash_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 12));
      }
      
      
      $query ="UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}',user_lastname = '{$user_lastname}',
user_password = '{$hash_password}',user_email = '{$user_email}',user_role = '{$user_role}' WHERE user_id = '{$edit_user_id}'"; 

$update_user_Query = mysqli_query($connection,$query);
if(!$update_user_Query){
  die("Query Failed: ".mysqli_error($connection));
}
header("Location:users.php");  
}
}
}else{
  header("Location:index.php");
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
    <div class="form-group">
      <select name="user_role" id="user_role" >
        
      
       <option value='<?php echo $user_role?>'><?php echo $user_role?></option>;
       <?php
       if($user_role == "admin"){
         echo "<option value='subscriber'>subscriber</option>";
       }
       else{
         echo "<option value='admin'>Admin</option>";
        
       }
       ?>
       
      </select>
    </div>
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
      <input type="password" class="form-control" name = "user_password" autocomplete="off">
    </div>
    <div class="form-group">
      
      <input type="submit" class="btn btn-primary" name = "edit_user" value = "Edit User">
    </div>
</form>