<?php session_start();?>
<?php include "includes/functions.php";?>

<?php
if(!isset($_SESSION['role'])){
  
    header("Location: ../index.php");
 
}

?>


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
                Welcome to Admin
                <small><?php  echo $_SESSION['username']?></small>
               
              </h1>
              
            </div>
          </div>
          <!-- /.row -->
          <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                  <div class='huge'><?php echo $posts_count = count_num('posts')?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php $comments_count= count_num('comments')?>
                     <div class='huge'><?php echo $comments_count ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php $users_count = count_num('users')?>
                    <div class='huge'><?php echo $users_count?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php $categories_count= count_num('categories')?>
                        <div class='huge'><?php echo $categories_count?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="category.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    
</div>
                <!-- /.row -->

                <?php
                      $published = checkStatus("posts","post_status","published");

                      $draft = checkStatus("posts","post_status",'draft');

                      $unapproved_comments = checkStatus("comments","comment_status","unapproved");

                      $user_subscriber = checkStatus("users","user_role","subscriber");
                 
                ?>
                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['data','count'],
          <?php
          // $element_text = ['posts','comments','users','categories'];
          // $lelment_count = [$posts_count,$comments_count,$users_count,$categories_count];
          $element = ['posts'=>$posts_count,'published posts'=>$published,'draft posts'=>$draft,'comments'=>$comments_count,'unapproved comments'=>$unapproved_comments,
          'users'=>$users_count,'user subscriber'=>$user_subscriber,'categories'=>$categories_count];

          foreach($element as $key => $value){
            echo "['$key',$value],";
          
          }

          ?>
          // ['posts', 1000],
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: auto; height: 400px;"></div>
                </div>
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
    <script src = "js/script.js"></script>
   
   
  </body>
</html>
