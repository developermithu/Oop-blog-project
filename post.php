<?php include 'inc/header.php' ;?>
<?php include 'inc/slider.php' ; ?>

<style>.samesidebar h2, .about h2 {padding-left: 10px;}</style>

 <?php //id wrong pass korle 404 page

 	$id = mysqli_real_escape_string($db->link, $_GET['id']);

	if (!isset($id) OR $id == NULL) {
		header("Location: 404.php");
	}else{
		$id = $id;
	}
 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
	
	<?php // select data from table where id=$id
		$query = "SELECT * FROM `tbl_post` WHERE `id` = '$id' ORDER BY `id` DESC ";
		$post = $db->select($query);
		if ($post) {
			while ($result = $post->fetch_assoc() ) { ?>

                <!-- post title -->
				<h2><?php echo $result['title'] ?></h2>
				
				<!-- post date -->
				<h4><?php echo $fm->formatDate($result['date']) ?>, By

				<!-- post author -->
				<a href="#"><?php echo $result['author'];?></a> </h4>

				<!-- post image -->
				<img src="admin/<?php echo $result['image'] ?>" alt="MyImage"/>

				<!-- post body details -->
				<?php echo $result['body'] ?>
				

				<!-- related article -->
				<div class="relatedpost clear">
					<h2>Related articles</h2>

					<?php 
						$catid = $result['cat'];  //from prev while loop
						$relatedQuery = "SELECT * FROM `tbl_post` WHERE `cat` = '$catid' ORDER BY rand() LIMIT 6 ";
						$relatedPost = $db->select($relatedQuery);
						if ($relatedPost) {
							while ($rResult = $relatedPost->fetch_assoc() ) { ?>

					<!-- category id & image from tbl_post-->
					<a href="post.php?id=<?php echo $rResult['id'] ?>"><img src="admin/<?php echo $rResult['image'];?>" alt="post image"/></a>
					

					<!--end relatedPost while & if loop-->
				<?php } }else{ echo 'No Related Post Available!!';} ?>

				</div>
				
				<!--end 1st while & if loop-->
				<?php } } else{ header("location: 404.php"); } ?> 

	</div>
		</div>

		<!-- sidebar & footer -->
	    <?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>