<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php'; ?>

 <!-- without admin no one can access this page -->
<?php
    if (!Session::get('userRole') == '0') { 
    echo "<script> window.location = 'index.php' ;</script>";
} ?>
<!-- without admin no one can access this page -->     

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $catName = mysqli_real_escape_string($db->link, $catName);

        if ( empty($catName)) {
            echo '<span class="error"> Field must not be empty !</span>';
        }
        else{       
          $query = "INSERT INTO `tbl_category` (`name`) VALUES ('$catName') ";
          $catInsert = $db->insert($query);
          if ($catInsert) {
               echo '<span class="success"> Category Inserted Successfully !</span>';
          }else{
             echo '<span class="error"> Category Not Inserted !</span>';
          }
        }
    }
 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." class="medium" name="catName" />
                            </td>
                        </tr>
						            <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        
       <?php include 'inc/footer.php'; ?>