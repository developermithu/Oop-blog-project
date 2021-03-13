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

<?php $del_id = mysqli_real_escape_string($db->link, $_GET['del_id']);
if (!isset($del_id) or $del_id == NULL) {
	header("location: postlist.php");
} else {
	$del_id = $del_id;

	$query = "SELECT * FROM `tbl_post` WHERE `id` = '$del_id' ";
	$result = $db->select($query);
	if ($result) {
		while ($post = $result->fetch_assoc()) {
			$del_img = $post['image'];
			unlink($del_img);  // upload folder theke o img delete korbe
		}
	}

	$query = "DELETE FROM `tbl_post` WHERE `id` = '$del_id' ";
	$dataDelete = $db->delete($query);
	if ($dataDelete) {
		echo '<script>alert("Data deleted successfully !");</script>';
		echo "<script>window.location = 'postlist.php';</script>";
	} else {
		echo '<script>alert("Data not deleted  !");</script>';
		echo "<script>window.location = 'postlist.php';</script>";
	}
}
?>