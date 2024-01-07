
<?php
function escape($string){
  global $connection;
  return mysqli_real_escape_string($connection,trim($string));
}


function users_online(){
  if(isset($_GET['onlineusers'])){
    global $connection;
    if(!$connection){
      include "db.inc.php";
      session_start(); 
      $session = session_id();
      $time = time();
      $time_out_in_sec = 300;
      $time_out = $time - $time_out_in_sec;
      
      $query = "SELECT * FROM users_online WHERE session = '{$session}'";
      $send_query = mysqli_query($connection,$query);
      $count = mysqli_num_rows($send_query);
      
      if($count == null){
        $query = "INSERT INTO users_online(session, time) VALUES('$session','$time')";
        $insert_users_online = mysqli_query($connection,$query);
        if (!$insert_users_online) {
          die("Insert query failed: " . mysqli_error($connection));
        }
      }
      else{
        $query = "UPDATE users_online SET time = $time WHERE session = '{$session}'";
        $update_users_online = mysqli_query($connection,$query);
        if (!$update_users_online) {
          die("Update query failed: " . mysqli_error($connection));
        }
      }
      $query = "SELECT * FROM users_online WHERE time > '{$time_out}'";
      $get_users_online = mysqli_query($connection,$query);
      $count_users = mysqli_num_rows($get_users_online);
      echo $count_users;
      if (!$get_users_online) {
        die("Select query failed: " . mysqli_error($connection));
      }
    }
  }
  }
users_online();



function add_categories(){
  global $connection;
  if(isset($_POST['submit'])){
    $category = $_POST['cat-title'];

  if($category === ""||empty($category)){
  echo "This field should not be empty";
  }
  else
  {
    $query = "INSERT INTO categories(cat_title) VALUES ('{$category}')";
    $result = mysqli_query($connection,$query);
  if(!$result){
    die("Query Failed: ".mysqli_error($connection));
  }
  }
  }

  
}

function selectAllCategories(){
  global $connection;
  $query = "SELECT * FROM categories";
   $select_all_categories_sidebar = mysqli_query($connection,$query);
   while($row =mysqli_fetch_assoc($select_all_categories_sidebar) ){

   $cat_id = $row['cat_id'];
   $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href = 'category.php?id={$cat_id}'>Delete</a></td>";
    echo "<td><a href = 'category.php?edit_id={$cat_id}'>Edit</a></td>";
    echo "</tr>";
  }
}

function deleteCategory(){
  global $connection;
  if(isset($_GET['id'])){
        
    $id =  $_GET["id"];
    
    $query = "DELETE FROM categories WHERE cat_id = {$id}";
    $result = mysqli_query($connection,$query);
    header("Location: category.php");
}
}

function redirect($location){
  return header(header:"Location:".$location);
}

function count_num($category){
      global $connection;
      $query = "SELECT * FROM {$category}";
      $num = mysqli_query($connection,$query);
      return mysqli_num_rows($num);             
}
function checkStatus($table,$column,$status){
      global $connection;
      $status = mysqli_real_escape_string($connection,$status);
      $query = "SELECT * FROM $table WHERE $column = '$status'";
      $num = mysqli_query($connection,$query);
      if(!$num){
        echo "Query Failed".mysqli_error($connection);
      }
      return mysqli_num_rows($num); 
}
