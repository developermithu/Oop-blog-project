<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<style>
 .leftside{float: left; width: 70%;}
 .rightside{float: left; width: 20%;}
 .rightside img{width: 200px; height: 100px;}
</style>

<!-- without admin no one can access this page -->
<?php
    if (!Session::get('userRole') == '0') { 
    echo "<script> window.location = 'index.php' ;</script>";
} ?>
<!-- without admin no one can access this page -->

        <div class="grid_10">	
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $title  = $fm->validation($_POST['title']);
         $slogan = $fm->validation($_POST['slogan']);

        $title    = mysqli_real_escape_string($db->link,  $title);
        $slogan   = mysqli_real_escape_string($db->link,  $slogan);
     

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $_FILES['logo']['name'];
        $file_size  = $_FILES['logo']['size'];
        $file_tmp   = $_FILES['logo']['tmp_name'];

        $div          = explode('.', $file_name);
        $file_ext     = strtolower(end($div));
        $unique_img   = 'logo'. '.' .$file_ext;
        $uploaded_img = "upload/" .$unique_img;  // final image

        // prev img change na korle
        if ( $title == "" || $slogan == "" ) { 
             echo '<span class="error"> Field must not be empty !</span>';
        }else{

        if (!empty($file_name)) {
            
        if ($file_size >1048567) {
             echo '<span class="error"> Image size should be less than 1MB !</span>';
        }

        elseif (in_array($file_ext, $permited) === false) {
             echo '<span class="error"> You can upload only:- '.implode(', ', $permited).' !</span>';
        }

        else {
            move_uploaded_file($file_tmp, $uploaded_img);
            $query = " UPDATE `title_slogan` SET 
             `title` = '$title', 
             `slogan` = '$slogan', 
             `logo` = '$uploaded_img'
               WHERE `title_slogan`.`id` = 1 ";

            $data_updated = $db->update($query);
            if ($data_updated) {
                 echo '<span class="success"> Data updated successfully !</span>';
            }
            else {
                 echo '<span class="error"> Data not updated !</span>';
            }
        }

    }
    else{  //!empty() else   //image update hobe na
          $query = " UPDATE `title_slogan` SET 
             `title` = '$title', 
             `slogan` = '$slogan'            
               WHERE `title_slogan`.`id` = 1 ";

            $data_updated = $db->update($query);
            if ($data_updated) {
                 echo '<span class="success"> Data updated successfully !</span>';
            }
            else {
                 echo '<span class="error"> Data not updated !</span>';
            }
      }
   }
}
 ?>


<?php 
    $query = "SELECT * FROM `title_slogan` WHERE `id` = 1 ";
    $result = $db->select($query);
    if ($result) {
        while ($title_slogan = $result->fetch_assoc()) { ?>
                
                <div class="block sloginblock">    

                <div class="leftside">
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $title_slogan['title'] ;?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $title_slogan['slogan'] ;?>" name="slogan" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Website Logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo">
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                  </div>
                <div class="rightside">
                    <img src="<?php echo $title_slogan['logo'] ;?>" alt="logo">
                </div>

                </div>
            </div>
<?php } } ?>

        </div>
       
        <?php include 'inc/footer.php'; ?>
