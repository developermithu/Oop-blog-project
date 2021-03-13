<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<style>	

.pagination {text-align: center;margin-top: 65px;padding-bottom: 20px;}
.pagination a {font-size: 18px;padding: 6px 12px;background: #b7801c;margin: 5px;color: #fff;text-decoration: none;width: 21px;height: 50px;}
.pagination a:hover {background: #704903e0;}
	
</style>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

<?php //pagination page
	    $per_page = 3;
		if (isset ($_GET['page'])) {
			$page = $_GET['page'];
		}else{
			  $page = 1;
		}
		$start_from = ($page-1)*$per_page;
?>

<?php  //select data from database table order by Desc last post age show korbe
	$query = "SELECT * FROM `tbl_post` ORDER BY `id` DESC LIMIT $start_from, $per_page ";
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

				 <!-- post image src=admin/upload/   databse e save -->
				 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>

				<!-- post body part -->
				 <?php echo $fm->textShorten($result['body']);?>
				
				<div class="readmore clear">

					<!-- read more button -->
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>				
			</div>
		
<?php } ?> <!-- end while loop -->

<!-- pagination -->
<?php 
		$query = "SELECT * FROM `tbl_post` ";
		$result = $db->select($query);
		$total_rows = mysqli_num_rows($result);
		$total_page = ceil($total_rows/$per_page);  //ceil() avoid decimal
?>

<?php echo '<div class="pagination">'; ?>
 <?php echo '<div><a href="index.php?page=1">First page</a>' ;?> 

 <?php 	for ($i=2; $i <= $total_page ; $i++) { 
			echo  "<a href='index.php?page= ".$i." '>" .$i . "</a>" ; } ?>

<?php echo  '<a href="index.php?page=$total_page">Last page</a></div>' ;?>
<!-- pagination -->
<?php echo '</div>'; ?>

<?php } else{ header("location: 404.php"); } ?> 


<!-- sidebar & footer -->
		</div>
		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>

	