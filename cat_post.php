<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

 <?php //catid wrong pass korle 404 page

 	$catid = mysqli_real_escape_string($db->link, $_GET['catid']);
 	
	if (!isset($catid) OR $catid == NULL) {
		header("Location: 404.php");
	}else{
		$catid = $catid;
	}
 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

		<?php  //select data from database table
	       $query = "SELECT * FROM `tbl_post` WHERE `cat` = $catid ";  //cat=category id
	       $post = $db->select($query);

	       if($post){
		      while( $result = $post->fetch_assoc() ){  ?>

		<div class="samepost clear">
				<!-- post title -->
				<h2><a href="post.php?id=<?php echo $result['id'];?> "> 
				<?php echo $result['title'];?></a></h2>

				<!-- post date -->
				<h4><?php echo $fm->formatDate($result['date']) ;?>, By

				<!-- post author -->
				 <a href="#"><?php echo $result['author'];?></a></h4>

				 <!-- post image -->
				 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>

				<!-- post body part -->
				 <?php echo $fm->textShorten($result['body']);?>
				
				<div class="readmore clear">

					<!-- read more button -->
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
			</div>

	<!--end while & if loop-->
	<?php } } else{ echo '<h3>No post available in this category !</h3>' ;} ?> 

 <!-- sidebar & footer -->
</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>
