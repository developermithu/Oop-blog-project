<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php'; ?>

<?php 
  $catid = mysqli_real_escape_string($db->link, $_GET['catid']);
  if (!isset($catid) OR $catid == NULL) {
    header("location:catlist.php");
     //echo '<script> window.location = "catlist.php" ;</script>';
   }
  else{
      $catid = $catid;
  }
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 

<?php  // update query
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $catName = mysqli_real_escape_string($db->link, $catName);

        if ( empty($catName)) {
            echo '<span class="error"> Field must not be empty !</span>';
        }
        else{       
          $query = " UPDATE `tbl_category` SET `name` = '$catName' WHERE `id` = '$catid' ";
          $catUpdated = $db->update($query);

          if ($catUpdated) {
               echo '<span class="success"> Category Updated Successfully !</span>';
          }else{
             echo '<span class="error"> Category Not Updated !</span>';
          }
        }
    }
 ?>


<?php  // select query
    $query = "SELECT * FROM `tbl_category` WHERE `id` = '$catid' ORDER BY `id` DESC ";
    $result = $db->select($query);
      if ($result) {
        while ($category = $result->fetch_assoc()) { ?>
            
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $category['name'] ;?>" class="medium" name="catName" />
                            </td>
                        </tr>
						            <tr> 
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php } } ?>

                </div>
            </div>
        </div>
        
       <?php include 'inc/footer.php'; ?>