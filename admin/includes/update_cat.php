      
            <form action="" method = "post">
                  <div class="form-group">
                    <label for="cat-title">Edit Category</label>
                    
                    <?php
              //  Get title Query to edit ---- 
              if(isset($_GET['edit_id'])){
                
                $edit_id =  $_GET["edit_id"];
                
                $query = "SELECT * FROM categories WHERE cat_id = {$edit_id}";
                $to_edit_content = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($to_edit_content)){
                  $title = $row['cat_title'];
                  
                }}
                ?>



                  <?php

                    
                    if(isset($_POST['update_cat'])){
                      
                      $update_title =  $_POST["cat-title"];
                      
                      $query = "UPDATE  categories SET cat_title = '{$update_title}' WHERE cat_id = '{$edit_id}'";
                      $update = mysqli_query($connection,$query);
                      if(!$update){
                        die("Query Failed ".mysqli_error($connection));
                      }
                      
                    }
                  ?>
               
               <input type='text' class='form-control' name = 'cat-title' value = '<?php if(isset($title)) echo $title ;?>'  >
              </div>
               
              <div class="form-group">
                
                    <input type="submit" class="btn btn-primary" name = "update_cat" value = "Edit category">
                  </div>
            </form>