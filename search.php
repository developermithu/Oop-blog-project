<!-- all code copy from cat_post.php -->
<?php include 'inc/header.php'; ?>


 <?php //form method Must be (GET)
	if (!isset($_GET['search']) OR $_GET['search'] == NULL) {
		header("location: 404.php");
	}else{
		$search = $_GET['search'];
	}
 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

		<?php  //select data from database table
	       $query = "SELECT * FROM `tbl_post` WHERE `title` LIKE '%$search%' OR `body` LIKE '%$search%' "; 
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
	<?php } } else{ ?>
	<p>Your search query not found !!!</p>
	<?php } ?> 

 <!-- sidebar & footer -->
</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>
