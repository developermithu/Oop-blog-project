<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Add Slider Image</h2>
        <div class="block">

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $title    = mysqli_real_escape_string($db->link,  $_POST['title']);

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $_FILES['image']['name'];
        $file_size  = $_FILES['image']['size'];
        $file_tmp   = $_FILES['image']['tmp_name'];

        $div          = explode('.', $file_name);
        $file_ext     = strtolower(end($div));
        $unique_img   = substr(md5(time()), 0, 10). '.' .$file_ext;
        $uploaded_img = "upload/slider/" .$unique_img;  // slider folder e image upload hobe

        if ( $title == "" || $file_name == "" ) {
             echo '<span class="error"> Field must not be empty !</span>';
        }

        elseif ($file_size >1048567) {
             echo '<span class="error"> Image size should be less than 1MB !</span>';
        }

        elseif (in_array($file_ext, $permited) === false) {
             echo '<span class="error"> You can upload only:- '.implode(', ', $permited).' !</span>';
        }

        else {
            move_uploaded_file($file_tmp, $uploaded_img);
            $query = " INSERT INTO `tbl_slider` (`title`, `image`) VALUES ('$title', '$uploaded_img'); ";
            $data_inserted = $db->insert($query);
            if ($data_inserted) {
                 echo '<span class="success"> Image added successfully !</span>';
            }
            else {
                 echo '<span class="error"> Image not added !</span>';
            }
        }
    }
?>

            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">                    
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" placeholder="Enter image Title..." class="medium" name="title" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                   
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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