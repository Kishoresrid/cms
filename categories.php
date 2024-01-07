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
                 <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <?php

                if(isset($_GET['cat_id'])){
                  $cat_id =  $_GET['cat_id'];
                if(isset($_SESSION['role'])){
                   if(isset($_SESSION['role'])=='admin'){

                       $query = "SELECT * FROM posts WHERE post_category_id = $cat_id";
                   }
                   else{
                    $query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status = 'published'";

                   }
                    
                    $select_posts_query = mysqli_query($connection,$query);
                    $count = mysqli_num_rows($select_posts_query);
                    if($count<1){
                        echo "<h2 class = 'text-center'>No Results Found</h2>";
                    } else{
                        
                        while($row = mysqli_fetch_assoc($select_posts_query)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0,150);
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
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <hr>
                
                <?php
         
    }}
   
}else{
    echo "<h2 class = 'text-center'>Login first</h2>";
}
}
 else{
    header("Location: index.php");
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
