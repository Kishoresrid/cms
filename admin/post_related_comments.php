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
                Welcome to Comments
                <small>Author</small>
              </h1>
        



<table class = "table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>In Response to</th>
                    <th>Date</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>



<?php

 


$query = "SELECT * FROM comments WHERE comment_post_id =".mysqli_real_escape_string($connection,$_GET['id'])."";
 $select_all_comments = mysqli_query($connection,$query);
 while($row =mysqli_fetch_assoc($select_all_comments) ){

 $comment_id = $row['comment_id'];
 $comment_post_id = $row['comment_post_id'];
 $comment_author = $row['comment_author'];
 $comment_email = $row['comment_email'];
 $comment_content = $row['comment_content'];
 $comment_status = $row['comment_status'];
 $comment_date = $row['comment_date'];
 echo "<tr>";
 echo "<td>{$comment_id}</td>";
 echo "<td>{$comment_author}</td>";
 echo "<td>{$comment_content}</td>";
//  $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
//  $select_category = mysqli_query($connection,$query);
//  while($row = mysqli_fetch_assoc($select_category)){
//   $post_category = $row['cat_title'];
//  }
 echo "<td>{$comment_email}</td>";
 echo "<td>{$comment_status}</td>";
 $query = "SELECT * FROM posts WHERE post_id = '{$comment_post_id}'";
 $result = mysqli_query($connection,$query);
 while($row = mysqli_fetch_assoc($result)){
  $post_id = $row['post_id'];
  $post_title = $row['post_title'];
  echo "<td><a href = '../post.php?id=$post_id'>{$post_title}</a></td>";
 }


 echo "<td>{$comment_date}</td>";

 echo "<td><a href='comments.php?approve=$comment_id' name ='approve'>Approve</a></td>";
 echo "<td><a href='comments.php?unapprove=$comment_id' name ='unapprove'>Unapprove</a></td>";



 echo "<td><a href='post_related_comments.php?del_id=$comment_id'&id=" .$_GET['id']."' name ='delete' onClick=\"javascript:return confirm('Are you sure want to delete')\">Delete</a></td>";
 
 echo"</tr>";
 }
 ?>

<?php
if(isset($_GET['approve'])){
  $approve_id =  ($_GET['approve']);
  $query = "UPDATE comments SET comment_status = 'approved'WHERE comment_id = '{$approve_id}'";
  $delete_comment = mysqli_query($connection,$query);
  if(!$delete_comment){
    die("Query Failed: ".mysqli_error($connection));
  }
  header("Location:comments.php");
}
 
 
 ?> 
<?php
if(isset($_GET['unapprove'])){
  $approve_id =  ($_GET['unapprove']);
  $query = "UPDATE comments SET comment_status = 'unapproved'WHERE comment_id = '{$approve_id}'";
  $delete_comment = mysqli_query($connection,$query);
  if(!$delete_comment){
    die("Query Failed: ".mysqli_error($connection));
  }
  header("Location:comments.php");
}
 
 
 ?> 

 <?php
 if(isset($_GET['del_id'])){
  $comment_id =  ($_GET['del_id']);
  $query = "DELETE FROM comments WHERE comment_id = '{$comment_id}'";
  $delete_comment = mysqli_query($connection,$query);
  if(!$delete_comment){
    die("Query Failed: ".mysqli_error($connection));
  }
  header("Location:post_related_comments.php?".$_GET['id']."");
}
 
 ?>
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