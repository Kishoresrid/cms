<div class="col-md-4">

<!-- Blog Search Well -->


<div class="well">
    <h4>Blog Search</h4>
    <div class="input-group">
        <form action="search.php" method = "post">
            <input type="text" class="form-control" name = "search">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name = "submit" >
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </form>
    </div>
    <!-- /.input-group -->
</div>

<!-- Login Box -->
<div class="well"> 
    <?php if(isset($_SESSION['username'])): ?>
        <h4>Logged in as <?php echo $_SESSION['username'] ?></h4>
        <div class="input-group-btn">
                    <a href = 'includes/logout.php' class="btn btn-primary"  name = "logout" >
                        Logout
                    </a>
                </div>
        <?php else: ?>
         <h4>Login</h4>
    
          <form action="includes/login.php" method = "post">
            <div class="form-group">
                <input type="text" class="form-control" name = "username" placeholder = "Enter Username">
            </div>
            <div class="input-group">

                <input type="password" class="form-control" name = "password" placeholder = "Enter password">
                
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name = "login" >
                        Login
                    </button>
                </span>
            </div>
        </form>
    <?php endif ?>
</div>
<!-- Blog Categories Well -->
<div class="well">
                    <h4>Blog Categories</h4>
                    <?php
                  $query = "SELECT * FROM categories";
                  $select_all_categories_sidebar = mysqli_query($connection,$query);
                  
                  
                  ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                              <?php
                              while($row =mysqli_fetch_assoc($select_all_categories_sidebar) ){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                                echo "<li><a href='categories.php?cat_id=$cat_id'>{$cat_title}</a></li>";
                              }
                              
                              ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                
<?php
 include "sidewidget.inc.php";
?>