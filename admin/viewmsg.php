<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>

<?php 
    $msgid = mysqli_real_escape_string($db->link,  $_GET['msgid']);
  if (!isset($msgid) OR $msgid == NULL) {
    header("location:inbox.php");
   }
  else{
      $msgid = $msgid;
  }
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
        <div class="block">

<?php  //msg view kore ok dile inbox page redirect hobe & need javascript redirect
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         //header("location:inbox.php");  
         echo '<script> window.location = "inbox.php" ;</script>';
}?>

<?php  // select query
    $query = "SELECT * FROM `tbl_contact` WHERE `id` = '$msgid' ";
    $result = $db->select($query);
      if ($result) {
        while ($contact = $result->fetch_assoc()) { ?>
          

            <form action="" method="post" >
                <table class="form">                    
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $contact['fname'].' '.$contact['lname'] ?>" class="medium" readonly/>
                        </td>
                    </tr>

                      <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $contact['email']?>" class="medium" readonly/>
                        </td>
                    </tr>
                                    
                      <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $fm->formatDate($contact['date']) ;?>" class="medium" readonly/>
                        </td>
                    </tr>

                    <tr>  <!-- Tinymice box -->
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea cols="70" rows="12" style="padding:15px;" readonly>
                                <?php echo $contact['msg'] ;?>
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