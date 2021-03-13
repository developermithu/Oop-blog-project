<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<style>
    .delete a{border: 1px solid #ddd;color: #444;cursor: pointer;font-size: 20px;padding: 2px 10px;font-weight: normal}
</style>

<div class="grid_10">  
    <div class="box round first grid">
        <h2>Edit Page</h2>
        <div class="block">

<?php  //get id from sidebar.php 
  $pagid = mysqli_real_escape_string($db->link, $_GET['pagid']);
  if (!isset($pagid) OR $pagid == NULL) {
    header("location: index.php");
   }
  else{
      $pagid = $pagid;
  }
 ?>

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // $name = $fm->validation($_POST['name']);
        // $body = $fm->validation($_POST['body']);

        $name   = mysqli_real_escape_string($db->link, $_POST['name']);
        $body   = mysqli_real_escape_string($db->link, $_POST['body']);

        if ( $name == "" || $body == "" ) {
             echo '<span class="error"> Field must not be empty !</span>';
        }

         else{  // update query

          $query = " UPDATE `tbl_page` SET 
          `name` = '$name',
          `body` = '$body' 
           WHERE `id` = '$pagid' ";
          $updated_row = $db->update($query);

          if ($updated_row) {
               echo '<span class="success"> Page Updated Successfully !</span>';
          }else{
             echo '<span class="error"> Page Not Updated !</span>';
          }

        }

}
 ?>

<!-- get page value from addpage & replace placeholder = value -->
<?php 
    $query = "SELECT * FROM `tbl_page` WHERE `id` = '$pagid' ";
    $selected_row = $db->select($query);
    if ($selected_row) {
        while ($tbl_page = $selected_row->fetch_assoc()) {

?>            
            <!-- form -->
            <form action="" method="post" >
                <table class="form">                    
                    <tr>
                        <td>
                            <label>Page Nme</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $tbl_page['name'] ;?>" class="medium" name="name" />
                        </td>
                    </tr>
                                                 
                    <tr>  <!-- Tinymice box -->
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Page Body</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body">
                                <?php echo $tbl_page['body'] ;?>  <!-- body part -->
                            </textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>    <!-- edit button -->
                            <input type="submit" name="submit" Value="Update" />

                            <span class="delete"><a onclick="return confirm('Are you sure to delete the page?')" href="delpage.php?delid=<?php echo $tbl_page['id'] ;?>">Delete</a></span>
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