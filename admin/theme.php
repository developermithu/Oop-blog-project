<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2> Website Theme</h2>
               <div class="block copyblock"> 

 <?php //update query
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $theme = mysqli_real_escape_string($db->link, $_POST['theme']);
      
          $query = " UPDATE `tbl_theme` SET `theme` = '$theme' WHERE `id` = '1' ";

          $update_row = $db->update($query);
          if ($update_row) {
               echo '<span class="success"> Theme Updated Successfully !</span>';
          }else{
             echo '<span class="error"> Theme Not Updated !</span>';
          }
        }
 ?>


 <?php  // select query
    $query = "SELECT * FROM `tbl_theme` WHERE `id` = '1' ";
    $selected_row = $db->select($query);
      if ($selected_row) {
        while ($result = $selected_row->fetch_assoc()) { ?>
            
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>    <!-- Checked input radio atribute -->
                                <input <?php if ($result['theme'] == 'default') { echo 'Checked'; } ?>  
                                   type="radio" name="theme" value="default">Default
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'green') { echo 'Checked'; } ?>
                                 type="radio" name="theme" value="green">Green
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'red') { echo 'Checked'; } ?>
                                 type="radio" name="theme" value="red">Red
                            </td>
                        </tr>
						            <tr> 
                            <td>
                                <input type="submit" name="update" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
 <?php } } ?>

                </div>
            </div>
        </div>
        
       <?php include 'inc/footer.php'; ?>