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
              
              if(isset($_POST['submit'])){
           
                  $search = $_POST['search'];
           
                  $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                  $search_query = mysqli_query($connection,$query);
                  if(!$search_query){
                   die("Query Failed".mysqli_error($connection)) ;
                  }
                  $count_results = mysqli_num_rows($search_query);
                  if($count_results == 0){
                   echo "<h1>No Results Found</h1>";
                  }
                  else{
                    while($row = mysqli_fetch_assoc($search_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                      ?>
                        <h2>
                        <a href="#"><?php echo $post_title?></a>
                     </h2>
                     <p class="lead">
                         by <a href="index.php"><?php echo $post_author?></a>
                     </p>
                     <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                     <hr>
                     <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                     <hr>
                     <p><?php echo $post_content?></p>
                     <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
     
                     <hr>
                     
                     <?php
                 }
                }

              }
                 ?>
                
                <!-- First Blog Post -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php
           include "includes/sidebar.inc.php";
           ?>
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

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