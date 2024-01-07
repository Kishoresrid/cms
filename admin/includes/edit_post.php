<?php
if(isset($_GET['edit_post_id'])){
  $edit_post_id = $_GET['edit_post_id'];

  $query = "SELECT * FROM posts WHERE post_id = '{$edit_post_id}'";
  $edit_post_details = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($edit_post_details)){
    $title = $row['post_title'];
    $post_cat_id = $row['post_category_id'];
    $post_user = $row['post_user'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_contents = $row['post_content'];
    
    
  }
}
if(isset($_POST['update_post'])){
  $post_title = $_POST['title'];
  $post_category_id = $_POST['post_category_id'];
  $post_user = $_POST['post_user'];
  $post_status = $_POST['post_status'];
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
  $post_content = $_POST['post_content'];
  $post_tags = $_POST['post_tags'];
  $post_date = date('d-m-y');
  // $post_comment_count = 2;


  move_uploaded_file($post_image_temp,"../images/$post_image");

  if(empty($post_image)){
    $query = "SELECT * FROM posts WHERE post_id = '{$edit_post_id}'";
    $select_image = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_image)){
      $post_image = $row['post_image'];
    }
  }
$edit_post_id =  mysqli_real_escape_string($connection,$edit_post_id);

  $query ="UPDATE posts SET post_category_id = '{$post_category_id}', post_title = '{$post_title}',post_user = '{$post_user}',post_date = NOW(),
post_image = '{$post_image}',post_content = '{$post_content}',post_tags = '{$post_tags}',
post_status = '{$post_status}' WHERE post_id ='{$edit_post_id}'"; 

$updateQuery = mysqli_query($connection,$query);
if(!$updateQuery){
  die("Query Failed: ".mysqli_error($connection));
}
echo "<p class = 'bg-success'>Post Updated. <a href='../post.php?id={$edit_post_id}'>View Post</a> or
 <a href = 'posts.php'>Edit more posts</a></p>";
    
}



?>

<form action="" method = "post" enctype = "multipart/form-data">

    <div class="form-group">
      <label for="cat-title">Post Title</label>
      <input type="text" class="form-control" name = "title" value = '<?php if(isset($title)) echo $title ;?>'  >
    </div>
    <div class="form-group">
    <label for="category">Post Category</label>

      <select name="post_category_id" id="post_category_id">
        <?php 
        // $query = "SELECT * FROM categories WHERE cat_id = '{$post_cat_id}'";
        // $select_all_categories = mysqli_query($connection,$query);
        // while($row =mysqli_fetch_assoc($select_all_categories) ){
        //   $cat_title = $row['cat_title'];
        //   $cat_id = $row['cat_id'];
        // }
        ?>
         <!-- <option value='<?php echo $cat_id ?>'><?php echo $cat_title ?></option> -->

        <?php
        $query = "SELECT * FROM categories";
        $select_all_categories = mysqli_query($connection,$query);
        if(!$select_all_categories){
          die("Query Failed: ".mysqli_error($connection));
        }
        while($row =mysqli_fetch_assoc($select_all_categories) ){
     
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
      if($cat_id == $post_cat_id){
        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";

      }
      else{
        echo "<option value='{$cat_id}'>{$cat_title}</option>";

      }
        }
        ?>
        
      </select>
    </div>
    <div class="form-group">
    <label for="user">Post User</label>

      <select name="post_user" id="post_category_id">
      <?php echo "<option value='{$post_user}'> {$post_user}</option>";?>

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
    <label for="status">Post Status</label>

      <select name="post_status" id="post_status" >
        
      
       <option value='<?php echo $post_status?>'><?php echo $post_status?></option>;
       <?php
       if($post_status == "draft"){
         echo "<option value='published'>Published</option>";
       }
       else{
         echo "<option value='draft'>Draft</option>";
        
       }
       ?>
       
      </select>
    </div>
    <div class="form-group">
      
      <img src="../images/<?php  echo $post_image?>" alt="" height = '50' width = '100' >
      <input type="file"  name = "image">

    </div>
    <div class="form-group">
      <label for="cat-title">Post Tags</label>
      <input type="text" class="form-control" name = "post_tags" value = '<?php if(isset($post_tags)) echo $post_tags ;?>'>
    </div>
    <div class="form-group">
      <label for="summernote">Post Content</label>
      <textarea class="form-control" name = "post_content" cols = "30" rows = "10" id = "summernote" >
      <?php echo  str_replace('\r\n','<br>',$post_contents) ;?>
      </textarea>
    </div>
    <div class="form-group">
      
      <input type="submit" class="btn btn-primary" name = "update_post" value = "Update">
    </div>
</form>

