
<table class = "table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>



<?php

$query = "SELECT * FROM users";
 $select_all_users = mysqli_query($connection,$query);
 while($row =mysqli_fetch_assoc($select_all_users) ){

 $user_id = $row['user_id'];
 $username = $row['username'];
 $firstname = $row['user_firstname'];
 $lastname = $row['user_lastname'];
 $email = $row['user_email'];
 $role = $row['user_role'];
 $user_date = $row['user_date'];
 $user_image = $row['user_image'];
 $user_password = $row['user_password'];

 echo "<tr>";
 echo "<td>{$user_id}</td>";
 echo "<td>{$username}</td>";
 echo "<td>{$firstname}</td>";
//  $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
//  $select_category = mysqli_query($connection,$query);
//  while($row = mysqli_fetch_assoc($select_category)){
//   $post_category = $row['cat_title'];
//  }
 echo "<td>{$lastname}</td>";
 echo "<td>{$email}</td>";
 
 echo "<td>{$role}</td>";
 echo "<td>{$user_date}</td>";
 echo "<td><a href='users.php?change_role_admin_id=$user_id' name ='admin'>Approve</a></td>";
 echo "<td><a href='users.php?change_role_subs_id=$user_id' name ='subscriber'>Unapprove</a></td>";
 echo "<td><a href='users.php?delete_id=$user_id' name ='delete' onClick=\"javascript:return confirm('Are you sure want to delete');\">Delete</a></td>";
 echo "<td><a href='users.php?edit_user_id=$user_id&source=edit_user' name ='edit'>Edit</a></td>";
 echo"</tr>";
 }
 ?>


<?php
if(isset($_GET['change_role_admin_id'])){
  $admin_id =  ($_GET['change_role_admin_id']);
  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = '{$admin_id}'";
  $change_role = mysqli_query($connection,$query);
  if(!$change_role){
    die("Query Failed: ".mysqli_error($connection));
  }
  header("Location:users.php");
}
 
 
 ?> 
<?php
if(isset($_GET['change_role_subs_id'])){
  $unapprove_id =  ($_GET['change_role_subs_id']);
  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = '{$unapprove_id}'";
  $change_role = mysqli_query($connection,$query);
  if(!$change_role){
    die("Query Failed: ".mysqli_error($connection));
  }
  header("Location:users.php");
}
 
 
 ?> 

 <?php

if((isset($_GET['delete_id']))){
 if(isset($_SESSION['role'])){
  if($_SESSION['role'] === 'admin'){

     $delete_id = mysqli_real_escape_string($connection,$_GET['delete_id']);
     $query = "DELETE FROM users WHERE user_id = {$delete_id}";
     $result = mysqli_query($connection,$query);
     header("Location:users.php");
     
    }
 }
}
 ?>