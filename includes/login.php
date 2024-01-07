<?php include "db.inc.php";?>

<?php session_start();?>

<?php
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection,$username);
  $password = mysqli_real_escape_string($connection,$password);

  $query = "SELECT * FROM users WHERE username = '{$username}'";
  $get_user = mysqli_query($connection,$query);
  if(!$get_user){
    die("Query Failed: ".mysqli_error($connection));
  }

  while($row = mysqli_fetch_array($get_user)){
    $db_user_id =  $row['user_id'];
    $db_username =  $row['username'];
    $db_user_firstname =  $row['user_firstname'];
    $db_user_lastname =  $row['user_lastname'];
    $db_user_password =  $row['user_password'];
    $db_user_role =  $row['user_role'];
    
  }
  // $password = crypt($password, $db_user_password);
  if(password_verify($password,$db_user_password)){
    $_SESSION['user_id'] = $db_user_id;
    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['role'] = $db_user_role;
    header("Location: ../admin");
  }
  
  else{
    header("Location: ../index.php");
  }

}

?>