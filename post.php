<?php
include "includes/db.inc.php";
?>
<?php
include "admin/includes/functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php
include "includes/header.inc.php";
?>
<body>

    <!-- Navigation -->
    <?php
include "includes/nav.inc.php";
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                 <h1 class="page-header">
                    Posts
                    <!-- <small>Secondary Text</small> -->
                </h1>

                <?php
                if(isset($_GET['id'])){
                  $post_id = $_GET['id'];
                  
                  $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = '{$post_id}'";
                  $update_views = mysqli_query($connection,$query);
                  if(!$update_views){
                    die("Query Failed");
                  }

                  if(isset($_SESSION['user_role']) && $_SESSION['user_role' == 'admin']){

                      $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
                  }
                  else{
                    $query = "SELECT * FROM posts WHERE post_id = $post_id AND post_status = 'published'";

                  }
                  $select_all_posts_query = mysqli_query($connection,$query);
                  
                  while($row = mysqli_fetch_assoc($select_all_posts_query)){
                      $post_id_ = $row['post_id'];
                      $post_title = $row['post_title'];
                      $post_author = $row['post_user'];
                      $post_date = $row['post_date'];
                      $post_image = $row['post_image'];
                      $post_content = $row['post_content'];
                      ?>
                
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?id=<?php echo $post_id?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="img">
                <hr>
                <p><?php echo $post_content?></p>
                
                
                <hr>
                
                <?php
            }}
            
            ?>
 <!-- Blog Comments -->

                <!-- Comments Form -->

<?php
if(isset($_POST['submit_comment'])){

    $comment_post_id = $_GET['id'];
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment = $_POST['comment'];
    if(!empty($comment_author) && !empty($comment_email) && !empty($comment)){

        
        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) 
    VALUES('{$comment_post_id}','{$comment_author}','{$comment_email}','{$comment}','unapproved',NOW())";

$comment_insert = mysqli_query($connection,$query);
if(!$comment_insert){
    die("Query Failed: ".mysqli_error($connection));
}

// $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
// $increase_comment_count = mysqli_query($connection,$query);

}
else{
    echo "<script>alert('Fields cannot be empty')</script>";
    // header("Location: post.php?id={$post_id}");
}
    redirect(location:"/cms/post.php?id=$post_id");
}


?>

                <div class="well">
                    <h4>Leave a Comment:</h4>
                   
                    <form role="form" method = "post" action = "">
                        <div class = "form-group">
                            <input type="text" class='form-control' name = "comment_author" placeholder = "Your Name">
                        </div>
                        <div class = "form-group">
                            <input type="text" class = "form-control" name = "comment_email" placeholder = "Your Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" placeholder = "Your Comments" name = "comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name = "submit_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}' AND 
                comment_status = 'approved' ORDER BY comment_id DESC";
                $select_comment = mysqli_query($connection,$query);
                if(!$select_comment){
                    die("Query Failed: ".mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($select_comment)){
                   $comment_date = $row['comment_date'];
                   $comment_content = $row['comment_content'];
                   $comment_author = $row['comment_author'];
                
                ?>
                                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                       
                        <h4 class="media-heading"><?php echo $comment_author?>
                            <small><?php echo $comment_date?></small>
                        </h4>
                        <?php echo $comment_content?>
                    </div>
                </div>

                <?php
            }?>



                <!-- Comment -->
                 




            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php
           include "includes/sidebar.inc.php";
           ?>
                
            

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
include "includes/footer.inc.php";
?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src = 'admin/js/script.js'></script> -->
    
</body>

</html>
