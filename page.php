<?php include 'inc/header.php'; ?>
<style>
	.about h2{padding-left:10px}
</style>

<?php  //get id from header.php page part 
	$pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);

  if (!isset($pageid) OR $pageid == NULL) {
    header("location: 404.php");
   }
  else{
      $id = $pageid;
  }
 ?>

 <?php  
    $query = "SELECT * FROM `tbl_page` WHERE `id` = '$id' ";
    $result = $db->select($query);
    if ($result) {
        while ($tbl_page = $result->fetch_assoc()) {                
?>	
	

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">

				<!-- page name -->
				<h2><?php echo $tbl_page['name'] ?></h2>

				<!--  page body part -->
				<?php echo $tbl_page['body'] ?>		
	</div>
		</div>

<?php } } else{ header("location: 404.php"); } ?>	

		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>

