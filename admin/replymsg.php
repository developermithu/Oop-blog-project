<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>

<?php 
    $replyid = mysqli_real_escape_string($db->link,  $_GET['replyid']);

  if (!isset($replyid) OR $replyid == NULL) {
    echo '<script> window.location = "inbox.php" ;</script>';
   }
  else{
      $replyid = $replyid;
  }
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Reply Message</h2>
        <div class="block">


<?php  //live server e upload na korle msg send hobe na error asbe
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $to      = $fm->validation($_POST['toEmail']);
        $from    = $fm->validation($_POST['fromEmail']);
        $subject = $fm->validation($_POST['subject']);
        $msg     = $fm->validation($_POST['msg']);

        $to      = mysqli_real_escape_string($db->link, $_POST['toEmail']);
        $from    = mysqli_real_escape_string($db->link, $_POST['fromEmail']);
        $subject = mysqli_real_escape_string($db->link, $_POST['subject']);
        $msg     = mysqli_real_escape_string($db->link, $_POST['msg']);


        $sendMail = mail($to, $subject, $msg, $from);
        if ($sendMail) {
            echo "<span class='success'>Message sent successfully</span>";
        }else{
            echo "<span class='error'>Live server e upload korte hobe</span>";
        }
    }
?>


<?php  // select query
    $query = "SELECT * FROM `tbl_contact` WHERE `id` = '$replyid' ";
    $result = $db->select($query);
      if ($result) {
        while ($contact = $result->fetch_assoc()) { ?>
          

            <form action="" method="post" >
                <table class="form">                    
                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" name="toEmail" value="<?php echo $contact['email']?>" class="medium" readonly/>
                        </td>
                    </tr>

                      <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="email" name="fromEmail"  class="medium" />
                        </td>
                    </tr>
                                    
                      <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" name="subject" class="medium"/>
                        </td>
                    </tr>

                    <tr>  <!-- Tinymice box -->
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="msg" class="medium">
                                
                            </textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Send" />
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