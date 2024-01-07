<?php
if(isset($_POST['create_post'])){

  $post_title = escape($_POST['title']);
  $post_category_id = escape($_POST['post_category_id']);
  $post_user = escape($_POST['post_user']);
  $post_status = escape($_POST['post_status']);
  $post_image = escape($_FILES['image']['name']);
  $post_image_temp = escape($_FILES['image']['tmp_name']);
  $post_content = escape($_POST['post_content']);
  $post_tags = escape($_POST['post_tags']);
  $post_date = date('d-m-y');
  


  move_uploaded_file($post_image_temp,"../images/$post_image");
    
  $query = "INSERT INTO posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status)
   VALUES ({$post_category_id},'{$post_title}','{$post_user}',NOW(),'{$post_image}','{$post_content}',
   '{$post_tags}','{$post_status}')";
    $add_post_query = mysqli_query($connection,$query);
  if(!$add_post_query){
    die("Query Failed: ".mysqli_error($connection));
  }
  $post_id = mysqli_insert_id($connection);
  echo "<p class = 'bg-success'>Post uploaded. <a href='../post.php?id={$post_id}'>View Post</a> or
 <a href = 'posts.php'>Edit post</a></p>";
    
}

?>

<form action="" method = "post" enctype = "multipart/form-data">

    <div class="form-group">
      <label for="cat-title">Post Title</label>
      <input type="text" class="form-control" name = "title">
    </div>
    <div class="form-group">
      <label for="">Post Category</label>
      <select name="post_category_id" id="post_category_id">
        <?php
        $query = "SELECT * FROM categories";
        $select_all_categories = mysqli_query($connection,$query);
        if(!$select_all_categories){
          die("Query Failed: ".mysqli_error($connection));
        }
        while($row =mysqli_fetch_assoc($select_all_categories) ){
     
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
      
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
        ?>
        
      </select>
    </div>
    <div class="form-group">
      <select name="post_user" id="post_category_id">
        <?php
        $query = "SELECT * FROM users";
        $select_all_users = mysqli_query($connection,$query);
        if(!$select_all_users){
          die("Query Failed: ".mysqli_error($connection));
        }
        while($row =mysqli_fetch_assoc($select_all_users) ){
     
        $user_id = $row['user_id'];
        $username = $row['username'];
      
        echo "<option value='{$username}'>{$username}</option>";
        }
        ?>
        
      </select>
    </div>
    <div class="form-group">
    <label for="post-status">Post Status</label>
      <select name="post_status" id="post_status" class = 'form-control'>
        
      
       <option value=''>Select one</option>;
       
         <option value='published'>Published</option>
       <option value='draft'>Draft</option>
       
       
      </select>
    </div>
    <div class="form-group">
      <label for="cat-title">Post Image</label>
      <input type="file"  name = "image">
    </div>
    <div class="form-group">
      <label for="cat-title">Post Tags</label>
      <input type="text" class="form-control" name = "post_tags">
    </div>
    <div class="form-group">
      <label for="summernote">Post Content</label>
      <textarea class="form-control" name = "post_content" id = "summernote" cols = "30" rows = "10" ></textarea>
    </div>
    <div class="form-group">
      
      <input type="submit" class="btn btn-primary" name = "create_post" value = "Post">
    </div>
</form>