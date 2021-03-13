<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>

<!-- without admin no one can access this page -->
<?php
    if (!Session::get('userRole') == '0') { 
    echo "<script> window.location = 'index.php' ;</script>";
} ?>
<!-- without admin no one can access this page -->

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">     

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $fb = $fm->validation($_POST['fb']);
        $tw = $fm->validation($_POST['tw']);
        $ln = $fm->validation($_POST['ln']);
        $gp = $fm->validation($_POST['gp']);

        $fb   = mysqli_real_escape_string($db->link,  $fb);
        $tw   = mysqli_real_escape_string($db->link,  $tw);
        $ln   = mysqli_real_escape_string($db->link,  $ln);
        $gp   = mysqli_real_escape_string($db->link,  $gp);

        if ( $fb == "" || $tw == "" || $ln == "" || $gp == "") { 
             echo '<span class="error"> Field must not be empty !</span>';
        }else{
             $query = " UPDATE `tbl_social` SET 
             `fb` = '$fb',  
             `tw` = '$tw',
             `ln` = '$ln', 
             `gp` = '$gp'         
            WHERE `id` = 1 ";  //id always 1

            $data_updated = $db->update($query);
            if ($data_updated) {
                 echo '<span class="success"> Data updated successfully !</span>';
            }
            else {
                 echo '<span class="error"> Data not updated !</span>';
            }
        }
    }
?>


<?php 
    $query = "SELECT * FROM `tbl_social` WHERE `id` = 1 ";
    $result = $db->select($query);
    if ($result) {
        while ($social = $result->fetch_assoc()) { 
             
?>
                 <form action="social.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $social['fb'] ;?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $social['tw'] ;?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $social['ln'] ;?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $social['gp'] ;?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php } } ?>
                </div>
            </div>
        </div>
        
       <?php include 'inc/footer.php'; ?>
