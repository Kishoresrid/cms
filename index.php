<!-- <?php
// include "includes/db.inc.php";
?> -->

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
$per_page = 1;
if(isset($_GET['page'])){
    $page_no = $_GET['page'];
    
}
else{
    $page_no = '';
}
if($page_no == ''||$page_no == 1){
    $post_start = 0;
}
else{
    $post_start = ($page_no*$per_page)-$per_page;
}

?>

                <?php
                $query_count = "SELECT * FROM posts";
                $select_count = mysqli_query($connection,$query_count);
                $count = mysqli_num_rows($select_count);

                
                if($count<1){
                    echo "<h2 class = 'text-center'>No Results Found</h2>";
                }else{
                    if(isset($_SESSION['role'])){
                        $count_num = ceil($count/$per_page);
                        if(isset($_SESSION['role']) === 'admin'){
                        $query = "SELECT * FROM posts LIMIT $post_start,$per_page";
                    }

                    else{
                        
                        $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $post_start,$per_page";
                    }
                    $select_all_posts_query = mysqli_query($connection,$query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                     $post_title = $row['post_title'];
                     $post_user = $row['post_user'];
                     $post_date = $row['post_date'];
                     $post_image = $row['post_image'];
                     $post_content = substr($row['post_content'],0,150);
                     $post_status = $row['post_status'];
                     
                     
                     ?>


<!-- First Blog Post -->
<h2>
    <a href="post.php?id=<?php echo $post_id?>"><?php echo $post_title?></a>
</h2>
<p class="lead">
    by <a href="get_author_posts.php?author=<?php echo $post_user?>"><?php echo $post_user?></a>
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
else{
    echo "<h2 class = 'text-center'>Login first</h2>";
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
<div>

    <ul class = "pager">
        <?php
        if(isset($count_num)){

            for($i = 1;$i<=$count_num; $i++){
                if($i == $page_no){
                    echo  "<li><a class = 'active_link' href='index.php?page={$i}'>{$i}</a></li>";
                }
                else{
                    echo  "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    
                }
            }
            }
            ?>
    </ul> 
</div>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
