<?php
include '../lib/Session.php';
Session::checkSession();
?>

<?php
include '../config/config.php';
include '../lib/Database.php';
include '../helpers/Format.php';
?>

<?php
$db = new Database();
?>

<?php 	$delid = mysqli_real_escape_string($db->link, $_GET['delid']);
		if (!isset($delid) or $delid == NULL) {
			header("location: index.php");
		}
		 else {
			$delid = $delid;

			$query = "DELETE FROM `tbl_page` WHERE `id` = '$delid' ";
			$dataDelete = $db->delete($query);
			if($dataDelete){
				echo '<script>alert("Data deleted successfully !");</script>' ;
				echo "<script>window.location = 'index.php';</script>" ;
			}else{
				echo '<script>alert("Data not deleted  !");</script>' ;
				echo "<script>window.location = 'editpage.php';</script>" ;
			}
		}
?>