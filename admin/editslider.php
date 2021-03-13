<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Edit Slider</h2>

<!-- get id from postlist.php page -->
<?php 
     $sliderid = mysqli_real_escape_string($db->link,  $_GET['sliderid']);
  if (!isset($sliderid) OR $sliderid == NULL) {
    header("location: sliderlist.php");
   }
  else{
      $sliderid = "$sliderid";
  }
 ?>

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $title = mysqli_real_escape_string($db->link,  $_POST['title']);

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $_FILES['image']['name'];
        $file_size  = $_FILES['image']['size'];
        $file_tmp   = $_FILES['image']['tmp_name'];

        $div          = explode('.', $file_name);
        $file_ext     = strtolower(end($div));
        $unique_img   = substr(md5(time()), 0, 10). '.' .$file_ext;
        $uploaded_img = "upload/slider" .$unique_img;  // final image

        // prev img change na korle
        if ( $title == "" ) { 
             echo '<span class="error"> Field must not be empty !</span>';
        }else{

        if (!empty($file_name)) {   //upload img folder jodi change kora hoy
            
        if ($file_size >1048567) {
             echo '<span class="error"> Image size should be less than 1MB !</span>';
        }

        elseif (in_array($file_ext, $permited) === false) {
             echo '<span class="error"> You can upload only:- '.implode(', ', $permited).' !</span>';
        }

        else {
            move_uploaded_file($file_tmp, $uploaded_img);
            $query = " UPDATE `tbl_slider` SET 
            `title` = '$title', 
            `image` = '$uploaded_img'
             WHERE `id` = '$sliderid' ";

            $data_updated = $db->update($query);
            if ($data_updated) {
                 echo '<span class="success"> Slider updated successfully !</span>';
            }
            else {
                 echo '<span class="error"> Slider not updated !</span>';
            }
        }

    }
    else{  //!empty() else   //image update hobe na
         $query = " UPDATE `tbl_slider` SET `title` = '$title' WHERE `id` = '$sliderid' ";

            $data_updated = $db->update($query);
            if ($data_updated) {
                 echo '<span class="success"> Slider updated successfully !</span>';
            }
            else {
                 echo '<span class="error"> Slider not updated !</span>';
            }
      }
   }
}
 ?>
        
        <div class="block">

 <?php  // select data by editid
    $query = "SELECT * FROM `tbl_slider` WHERE `id` = '$sliderid' ORDER BY `id` DESC ";
    $result = $db->select($query);
    if ($result) {
        while ($slider = $result->fetch_assoc()) { ?>

            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">                    
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $slider['title'];?>" class="medium" name="title" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $slider['image'];?>" height="100px" width="200px"> <br>
                            <input type="file" name="image" value="img" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
setupTinyMCE();
setDatePicker('date-picker');
$('input[type="checkbox"]').fancybutton();
$('input[type="radio"]').fancybutton();
});
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>