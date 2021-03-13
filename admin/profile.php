<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<div class="grid_10">
    
<?php 
    $userid   = Session::get('userid');
    $userRole = Session::get('userRole');
 ?>    

    <div class="box round first grid">
        <h2>Update User Role</h2>

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name      = mysqli_real_escape_string($db->link,  $_POST['name']);
        $username  = mysqli_real_escape_string($db->link,  $_POST['username']);
        $email     = mysqli_real_escape_string($db->link,  $_POST['email']);
        $details   = mysqli_real_escape_string($db->link,  $_POST['details']);

        // prev img change na korle
        if ( $name == "" || $username == "" || $email == "" || $details == "") { 
             echo '<span class="error"> Field must not be empty !</span>';
        }else{

            $query = " UPDATE `tbl_user` SET 
             `name`     = '$name',
             `username` = '$username', 
             `email`    = '$email',
             `details`  = '$details'
             WHERE `id` = '$userid' ";

            $data_updated = $db->update($query);
            if ($data_updated) {
                 echo '<span class="success">User Data updated successfully !</span>';
            }
            else {
                 echo '<span class="error">User Data not updated !</span>';
            }
        }

    }

 ?>
        
        <div class="block">

 <?php  // select data by editid
    $query = "SELECT * FROM `tbl_user` WHERE `id` = '$userid' AND `role` = '$userRole' ";
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
                            <input type="text" value="<?php echo $user['name'];?>" class="medium" name="name" />
                        </td>
                    </tr>    
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $user['username'];?>" class="medium" name="username" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $user['email'];?>" class="medium" name="email" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="details">
                                <?php echo $user['details'];?>
                            </textarea>
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