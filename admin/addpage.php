<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>

<!-- without admin no one can access this page -->
<?php
    if (!Session::get('userRole') == '0') { 
    echo "<script> window.location = 'index.php' ;</script>";
} ?>
<!-- without admin no one can access this page -->

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Page</h2>
        <div class="block">

<?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $name = $fm->validation($_POST['name']);
        // $body = $fm->validation($_POST['body']);

        $name   = mysqli_real_escape_string($db->link, $_POST['name']);
        $body   = mysqli_real_escape_string($db->link, $_POST['body']);

        if ( $name == "" || $body == "" ) {
             echo '<span class="error"> Field must not be empty !</span>';
        }
        else {
            $query = "INSERT INTO `tbl_page` (`name`, `body`) VALUES ('$name', '$body') ";
            $data_inserted = $db->insert($query);
            if ($data_inserted) {
                 echo '<span class="success"> Page created successfully !</span>';
            }
            else {
                 echo '<span class="error"> Page not created !</span>';
            }
        }
}
 ?>

            <!-- form -->
            <form action="" method="post" >
                <table class="form">                    
                    <tr>
                        <td>
                            <label>Page Nme</label>
                        </td>
                        <td>
                            <input type="text" placeholder="Enter Page Name..." class="medium" name="name" />
                        </td>
                    </tr>
                                                 
                    <tr>  <!-- Tinymice box -->
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Page Body</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
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