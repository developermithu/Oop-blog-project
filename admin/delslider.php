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

<?php 	$sliderid = mysqli_real_escape_string($db->link, $_GET['sliderid']);
		if (!isset($sliderid) or $sliderid == NULL) {
			header("location: sliderlist.php");
		}
		 else {
			$sliderid = $sliderid;

			$query = "SELECT * FROM `tbl_slider` WHERE `id` = '$sliderid' ";
			$result = $db->select($query);
			if($result){
					while ($slider = $result->fetch_assoc()) {
						$del_img = $slider['image'];
						unlink($del_img);  // upload folder theke o img delete korbe
					}
			}

			$query = "DELETE FROM `tbl_slider` WHERE `id` = '$sliderid' ";
			$dataDelete = $db->delete($query);
			if($dataDelete){
				echo '<script>alert("Slider deleted successfully !");</script>' ;
				echo "<script>window.location = 'sliderlist.php';</script>" ;
			}else{
				echo '<script>alert("Slider not deleted  !");</script>' ;
				echo "<script>window.location = 'sliderlist.php';</script>" ;
			}
		}
?>