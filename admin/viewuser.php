<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>View User Data</h2>

<?php 
    $userid = mysqli_real_escape_string($db->link,  $_GET['userid']);
  if (!isset($userid) OR $userid == NULL) {
    header("location: userlist.php");
     //echo '<script> window.location = "catlist.php" ;</script>';
   }
  else{
      $userid = "$userid";
  }
 ?>

<?php  //redirect userlist page after vewing data
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       echo '<script> window.location = "userlist.php" ;</script>';
     }
 ?>
        
        <div class="block">

 <?php  // select data by editid
    $query = "SELECT * FROM `tbl_user` WHERE `id` = '$userid' ";
    $result = $db->select($query);
    if ($result) {
        while ($user = $result->fetch_assoc()) { ?>

            <!-- form -->
            <form action="" method="post">
                <table class="form">                    
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $user['name'];?>" class="medium" name="name"  readonly/>
                        </td>
                    </tr>    
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $user['username'];?>" class="medium" name="username"  readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $user['email'];?>" class="medium" name="email"  readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea readonly class="tinymce" name="details" >
                                <?php echo $user['details'];?>
                            </textarea>
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


