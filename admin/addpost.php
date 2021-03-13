<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $cat      = mysqli_real_escape_string($db->link,  $_POST['cat']);
        $title    = mysqli_real_escape_string($db->link,  $_POST['title']);
        $body     = mysqli_real_escape_string($db->link,  $_POST['body']);
        $metaTags = mysqli_real_escape_string($db->link,  $_POST['metaTags']);
        $metaDescription = mysqli_real_escape_string($db->link,  $_POST['metaDescription']);
        $author   = mysqli_real_escape_string($db->link,  $_POST['author']);
        $user_id   = mysqli_real_escape_string($db->link,  $_POST['user_id']); //hidden id

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $_FILES['image']['name'];
        $file_size  = $_FILES['image']['size'];
        $file_tmp   = $_FILES['image']['tmp_name'];

        $div          = explode('.', $file_name);
        $file_ext     = strtolower(end($div));
        $unique_img   = substr(md5(time()), 0, 10). '.' .$file_ext;
        $uploaded_img = "upload/" .$unique_img;  // final image

        if ( $cat == "" || $title == "" || $body == "" || $metaTags == "" || $metaDescription== "" || $author == "" || $file_name == "" ) {
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
            $query = " INSERT INTO `tbl_post` (`id`, `cat`, `title`, `body`, `image`, `author`, `metaTags`, `metaDescription`, `date`, `user_id`) VALUES (NULL, '$cat', '$title', '$body', '$uploaded_img', '$author', '$metaTags', '$metaDescription', current_timestamp(), '$user_id'); ";
            $data_inserted = $db->insert($query);
            if ($data_inserted) {
                 echo '<span class="success"> Post created successfully !</span>';
            }
            else {
                 echo '<span class="error"> Post not created !</span>';
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
                            <input type="text" placeholder="Enter Post Title..." class="medium" name="title" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <option selected>Select Category</option>
                                <?php  // select category
                                $query = "SELECT * FROM `tbl_category`";
                                $result = $db->select($query);
                                if ($result) {
                                while ($category = $result->fetch_assoc()) { ?>
                                
                                <option value="<?php echo $category['id'];?> ">
                                <?php echo $category['name'];?> </option>
                                <?php } } ?>
                            </select>
                        </td>
                    </tr>
                    
                    <!--
                    <tr>
                        <td>
                            <label>Date Picker</label>
                        </td>
                        <td>
                            <input type="" id="date-picker" />
                        </td>
                    </tr> -->
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Meta Tags</label>
                        </td>
                        <td>
                            <input type="text" placeholder="write tag keywords..." class="medium" name="metaTags" />
                        </td>
                    </tr>
                       <tr>
                        <td>
                            <label>Meta Description</label>
                        </td>
                        <td>
                            <input type="text" placeholder="write meta description..." class="medium" name="metaDescription" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>  <!-- without admin no one can add user role -->
                            <input type="text" value="<?php echo Session::get('username') ;?>" class="medium" name="author" />
                            <input type="hidden" value="<?php echo Session::get('userid') ;?>" class="medium" name="user_id" /><!--hidden update userid & user_id diffrence -->
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