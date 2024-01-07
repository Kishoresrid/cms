<?php include "delete_modal.php";?>

<?php
if(isset($_POST['checkBoxArray'])){
  
foreach( $_POST['checkBoxArray'] as $post){

  $bulk_options = $_POST['bulk_options'];

switch($bulk_options){
  case "publish":
    $query = "UPDATE posts SET post_status = 'published' WHERE post_id = '{$post}'";
    $update_post_publish = mysqli_query($connection,$query);
    if(!$update_post_publish){
      die("Query Failed: ".mysqli_error($connection));
    }
    break;
  case "draft":
    $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = '{$post}'";
    $update_post_draft = mysqli_query($connection,$query);
    if(!$update_post_draft){
      die("Query Failed: ".mysqli_error($connection));
    }
    break;
  
  case "delete":
    $query = "DELETE FROM posts WHERE post_id = '{$post}'";
    $delete_post = mysqli_query($connection,$query);
    if(!$delete_post){
      die("Query Failed: ".mysqli_error($connection));
    }
    break;
  case "clone":
    $query = "SELECT * FROM posts WHERE post_id = '{$post}'";
    $select_all_posts_query = mysqli_query($connection,$query);
    
    while($row = mysqli_fetch_assoc($select_all_posts_query)){
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,150);
        $post_status = $row['post_status'];
        $post_tags = $row['post_tags'];
       
      }
      $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_user,post_date,post_image,post_content,post_tags,post_status)
      VALUES ({$post_category_id},'{$post_title}','{$post_author}','{$post_user}',NOW(),'{$post_image}','{$post_content}',
      '{$post_tags}','{$post_status}')";
       $add_copy_post_query = mysqli_query($connection,$query);
     if(!$add_copy_post_query){
       die("Query Failed: ".mysqli_error($connection));
     }


}

}}

?>



<form action="" method = "post">

  <table class = "table table-bordered table-hover">
    <div id="bulkContainer" class = "col-xs-4">
      
      <select name="bulk_options" id="" class = "form-control">
        <option value="">select one</option>
        <option value="publish">publish</option>
        <option value="draft">draft</option>
        <option value="delete">delete</option>
        <option value="clone">Clone</option>
      </select>
      
    </div>
  
    <div class="col-xs-4">
    <input type="submit" name = "submit" class = "btn btn-success" value = "apply">
    <a href="posts.php?source=add_post" class = "btn btn-primary">Add new</a>
    </div>
  
    <thead>
    <tr>
      <th><input type="checkbox" id = "selectAllBoxes"></th>
      <th>Id</th>
      <th>Users</th>
      <th>Title</th>
      <th>Category</th>
      <th>Status</th>
      <th>Image</th>
      <th>Tags</th>
      <th>Comments</th>
      <th>Date</th>
      <th>View Post</th>
      <th>Delete</th>
      <th>Edit</th>
      <th>post views</th>
    </tr>
    </thead>
  <tbody>
    
</form>
    
    
    <?php

$query = "SELECT posts.post_id,posts.post_author,posts.post_user,posts.post_title,posts.post_category_id,
posts.post_status,posts.post_image,posts.post_tags,posts.post_comment_count,
posts.post_date,posts.post_views_count,categories.cat_id,
categories.cat_title FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
$select_all_posts = mysqli_query($connection,$query);
 while($row =mysqli_fetch_assoc($select_all_posts) ){
   
   $post_id = $row['post_id'];
   $post_author = $row['post_author'];
   $post_user = $row['post_user'];
   $post_title = $row['post_title'];
   $post_category_id = $row['post_category_id'];
   $post_status = $row['post_status'];
   $post_image = $row['post_image'];
   $post_tags = $row['post_tags'];
   $post_comment_count = $row['post_comment_count'];
   $post_date = $row['post_date'];
   $post_views_count = $row['post_views_count'];
   $cat_id = $row['cat_id'];
   $post_category = $row['cat_title'];
   echo "<tr>";
   ?>
<td><input type="checkbox" class = "checkBoxes" name = 'checkBoxArray[]' value = <?php echo $post_id;?>></td>
   <?php
   echo "<td>{$post_id}</td>";

if(!empty($post_author)){

  echo "<td>{$post_author}</td>";
}
elseif(!empty($post_user)){
  echo "<td>{$post_user}</td>";

}

   echo "<td>{$post_title}</td>";
    echo "<td>{$post_category}</td>";
    echo "<td>{$post_status}</td>";
    echo "<td><img src = '../images/{$post_image}' alt ='image' width = '100' height = '35'></td>";
    echo "<td>{$post_tags}</td>";


    $comment_query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}'";
    $post_comments_count = mysqli_query($connection,$comment_query);
    if(!$post_comments_count){
        die("Query Failed: ".mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($post_comments_count);
      
  
    $count = mysqli_num_rows($post_comments_count);

    echo "<td><a href='post_related_comments.php?id={$post_id}'>{$count}</a></td>";
    echo "<td>{$post_date}</td>";
    echo "<td><a href='../post.php?id={$post_id}' name ='view_post'>View post</a></td>";
    echo "<td><a rel ='$post_id' href='javascript:void(0)' class = 'delete_link'>Delete</a></td>";
    // echo "<td><a href='posts.php?delete_id={$post_id}' name ='delete' onClick=\"javascript:return confirm('Are you sure want to delete')\">Delete</a></td>";
    echo "<td><a href='posts.php?edit_post_id={$post_id}&source=edit_post' name ='edit'>Edit</a></td>";
    echo "<td><a href = 'posts.php?reset_post_id={$post_id}'>{$post_views_count}</a></td>";
    echo"</tr>";
    
  }
  
  ?>

</tbody>
</table>

</form>

<?php
 if((isset($_GET['delete_id']))){
   $delete_id = $_GET['delete_id'];
   $query = "DELETE FROM posts WHERE post_id = {$delete_id}";
   $result = mysqli_query($connection,$query);
   header("Location:posts.php");
   
  }
  ?>

<?php
 if(isset($_GET['reset_post_id'])){
   $reset_post_id = $_GET['reset_post_id'];
   $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =".mysqli_real_escape_string($connection,$reset_post_id)." ";
   $result = mysqli_query($connection,$query);
   header("Location:posts.php");
   
 }
  ?>

<script>
  $(document).ready(function () {
  $(".delete_link").on('click', function () {
    var id = $(this).attr("rel");
   var delete_id = "posts.php?delete_id="+id;
   $(".modal_delete_link").attr("href",delete_id);
   $("#myModal").modal('show');
  })
});

</script>

