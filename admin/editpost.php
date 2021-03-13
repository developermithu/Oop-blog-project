<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Update Post</h2>

<!-- get id from postlist.php page -->
<?php 
    $edit_post_id = mysqli_real_escape_string($db->link, $_GET['edit_post_id']);
  if (!isset($edit_post_id) OR $edit_post_id == NULL) {
    header("location: postlist.php");
   }
  else{
      $editid = $edit_post_id;
  }
 ?>

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $cat      = mysqli_real_escape_string($db->link,  $_POST['cat']);
        $title    = mysqli_real_escape_string($db->link,  $_POST['title']);
        $body     = mysqli_real_escape_string($db->link,  $_POST['body']);
        $metaTags = mysqli_real_escape_string($db->link,  $_POST['metaTags']);
        $metaDescription = mysqli_real_escape_string($db->link,  $_POST['metaDescription']);
        $author   = mysqli_real_escape_string($db->link,  $_POST['author']);
        $user_id  = mysqli_real_escape_string($db->link,  $_POST['user_id']); //hidden id

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $_FILES['image']['name'];
        $file_size  = $_FILES['image']['size'];
        $file_tmp   = $_FILES['image']['tmp_name'];

        $div          = explode('.', $file_name);
        $file_ext     = strtolower(end($div));
        $unique_img   = substr(md5(time()), 0, 10). '.' .$file_ext;
        $uploaded_img = "upload/" .$unique_img;  // final image

        // prev img change na korle
        if ( $cat == "" || $title == "" || $body == "" || $metaTags == "" || $metaDescription == "" || $author == "") { 
             echo '<span class="error"> Field must not be empty !</span>';
        }else{
        if (!empty($file_name)) { //jodi img change kora hoy tahole update `image`='$image'
        if ($file_size >1048567) {
             echo '<span class="error"> Image size should be less than 1MB !</span>';
        }
        elseif (in_array($file_ext, $permited) === false) {
             echo '<span class="error"> You can upload only:- '.implode(', ', $permited).' !</span>';
        }
        else {
            move_uploaded_file($file_tmp, $uploaded_img);
            $query = " UPDATE `tbl_post` SET 
              `cat`             = '$cat',
              `title`           = '$title', 
              `body`            = '$body', 
              `image`           = '$uploaded_img',
              `author`          = '$author', 
              `metaTags`        = '$metaTags',
              `metaDescription` = '$metaDescription',
              ` user_id`          = '$user_id'
               WHERE `id`       = '$editid' ";

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
         $query = " UPDATE `tbl_post` SET `cat` = '$cat', `title` = '$title', `body` = '$body', `author` = '$author', `metaTags` = '$metaTags', `metaDescription` = '$metaDescription', `user_id` = '$user_id' WHERE `tbl_post`.`id` = '$editid' ";

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
        
        <div class="block">

 <?php  // select data by editid
    $query = "SELECT * FROM `tbl_post` WHERE `id` = '$editid' ORDER BY `id` DESC ";
    $result = $db->select($query);
    if ($result) {
        while ($post = $result->fetch_assoc()) { ?>

            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">                    
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $post['title'];?>" class="medium" name="title" />
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
     
                                
                                <option 

        <?php  // inside option tag
        if ($post['cat'] == $category['id']) { ?>
            selected="selected"
       <?php } ?> 
                                 value="<?php echo $category['id'];?> ">
                                <?php echo $category['name'];?> </option>
    <!-- end if & while -->
    <?php } } ?>

                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $post['image'];?>" height="100px" width="200px"> <br>
                            <input type="file" name="image" value="img" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body">
                                <?php echo $post['body'];?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $post['metaTags'];?>" class="medium" name="metaTags" />
                        </td>
                    </tr>
                      <tr>
                        <td>
                            <label>Meta Description</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $post['metaDescription'];?>" class="medium" name="metaDescription" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $post['author'];?>" class="medium" name="author" />
                            <input type="hidden" value="<?php echo Session::get('userid') ;?>" class="medium" name="user_id" /> <!--hidden update userid & user_id diffrence -->
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