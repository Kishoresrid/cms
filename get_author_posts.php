<?php
include "includes/db.inc.php";
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
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <?php
                if(isset($_GET['author'])){
                  $post_user =  $_GET['author'];
                }
                
                ?>

                <?php
                $query = "SELECT * FROM posts WHERE post_user = '{$post_author}'";
                $select_all_posts_query = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,150);
                    $post_status = $row['post_status'];
                    if($post_status == "published"){
                        
                        ?>


<!-- First Blog Post -->
<h2>
    <a href="post.php?id=<?php echo $post_id?>"><?php echo $post_title?></a>
</h2>
<p class="lead">
    All posts by <?php echo $post_author?>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
<hr>
<a href="post.php?id=<?php echo $post_id?>">

    <img class="img-responsive" src="images/<?php echo $post_image?>" alt="img">
</a>
<hr>
<p><?php echo $post_content?></p>
<a class="btn btn-primary" href="post.php?id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>

<?php
}
            }
            ?>
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

</body>

</html>
