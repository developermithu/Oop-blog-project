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
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $text = $fm->validation($_POST['text']);

        $text   = mysqli_real_escape_string($db->link,  $text);

        if ( $text == "" ) { 
             echo '<span class="error"> Field must not be empty !</span>';
        }else{
             $query = " UPDATE `tbl_copy` SET `text` = '$text' WHERE `id` = 1 ";  //id always 1

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
    $query = "SELECT * FROM `tbl_copy` WHERE `id` = 1 ";  //id always 1
    $result = $db->select($query);
    if ($result) {
        while ($copyright = $result->fetch_assoc()) {    

 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $copyright['text'] ;?>" name="text" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
<?php  } } ?>
                </div>
            </div>
        </div>
        
       <?php include 'inc/footer.php'; ?>