<?php   session_start();?>  
<?php include "db.inc.php";?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <?php
                  $query = "SELECT * FROM categories";
                  $select_all_categories_query = mysqli_query($connection,$query);
                  while($row =mysqli_fetch_assoc($select_all_categories_query) ){

                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    $category_class = '';
                    $registration_class = '';
                    $current_page = basename($_SERVER['PHP_SELF']);
                    if($current_page == 'categories.php' && $_GET['cat_id'] == $cat_id){
                        $category_class = "active";
                    }
                    elseif($current_page == 'registration.php'){
                        $registration_class = 'active';
                    }



                    echo "<li class = '$category_class'><a href='categories.php?cat_id=$cat_id'>{$cat_title}</a></li>";
                  }
                  
                  ?>
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                    <li class = '<?php echo $registration_class?>'>
                        <a href="registration.php">Register</a>
                    </li>
                    <?php
                    if(isset($_SESSION['user_id'])){
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];

                      echo "<li><a href='admin/posts.php?source=edit_post&edit_post_id={$id}'>Edit Post</a></li>"; 
                        }
                    }
                    
                    
                    ?>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>