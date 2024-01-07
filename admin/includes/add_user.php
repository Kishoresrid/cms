<?php
if(isset($_POST['create_user'])){
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_role = $_POST['user_role'];
  $username = $_POST['username'];
  // $user_email = $_FILES['image']['name'];
  // $post_image_temp = $_FILES['image']['tmp_name'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $user_date = date('d-m-y');
  


  // move_uploaded_file($post_image_temp,"../images/$post_image");
    
  $user_password_hash = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>12));

  $query = "INSERT INTO users(username,user_firstname,user_lastname,user_password,user_email,user_role,user_date)
   VALUES ('{$username}','{$user_firstname}','{$user_lastname}','{$user_password_hash}','{$user_email}',
   '{$user_role}',now())";
    $add_user = mysqli_query($connection,$query);
  if(!$add_user){
    die("Query Failed: ".mysqli_error($connection));
  }
  echo "User created successfully"." "."<a href = 'users.php'>View users</a>";
}

?>







<form action="" method = "post" enctype = "multipart/form-data">

    <div class="form-group">
      <label for="cat-title">First Name</label>
      <input type="text" class="form-control" name = "user_firstname">
    </div>
    <div class="form-group">
      <label for="cat-title">Last Name</label>
      <input type="text" class="form-control" name = "user_lastname">
    </div>
    <div class="form-group">
      <select name="user_role" id="user_role">
        
      
       <option value='subscribe'>Select One</option>;
       <option value='admin'>Admin</option>;
       <option value='subscriber'>subscriber</option>;
       
      </select>
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name = "username">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control" name = "user_email">
    </div>
    <!-- <div class="form-group">
      <label for="cat-title">Post Image</label>
      <input type="file"  name = "image">
    </div> -->
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name = "user_password">
    </div>
    <div class="form-group">
      
      <input type="submit" class="btn btn-primary" name = "create_user" value = "Create User">
    </div>
</form>