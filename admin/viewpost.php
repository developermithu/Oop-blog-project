<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>View Post</h2>

<!-- get id from postlist.php page -->
<?php 
    $viewid = mysqli_real_escape_string($db->link,  $_GET['viewid']);
  if (!isset($viewid) OR $viewid == NULL) {
    header("location: postlist.php");
   }
   else{
      $viewid = "$viewid";
  }
 ?>

<?php  //redirect postlist page
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script> window.location = 'postlist.php' </script>";
    }
?>    

        <div class="block">

 <?php  // select data by editid
    $query = "SELECT * FROM `tbl_post` WHERE `id` = '$viewid' ORDER BY `id` DESC ";
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
                            <input type="text" value="<?php echo $post['title'];?>" class="medium" name="title"  readonly/>
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
                                 value="<?php echo $category['id'];?> " readonly>
                                <?php echo $category['name'];?> </option>
    <!-- end if & while -->
    <?php } } ?>

                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $post['image'];?>" height="100px" width="200px"> <br>
                            <input type="file" name="image" value="img"  readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body" readonly>
                                <?php echo $post['body'];?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $post['metaTags'];?>" class="medium" name="metaTags"  readonly/>
                        </td>
                    </tr>
                      <tr>
                        <td>
                            <label>Meta Description</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $post['metaDescription'];?>" class="medium" name="metaDescription"  readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $post['author'];?>" class="medium" name="author"  readonly/>
                            <input type="hidden" value="<?php echo Session::get('userid') ;?>" class="medium" name="user_id" /> <!--hidden update userid & user_id diffrence -->
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Ok" />
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