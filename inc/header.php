<?php 
include 'config/config.php';
include 'lib/Database.php';
include 'helpers/Format.php';
?>

<?php  
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<html>
<head>

<!-- meta tag, css file & js file from scripts folder -->
<?php include "scripts/meta.php" ;?>
<?php include "scripts/css.php" ;?>	
<?php include "scripts/js.php" ;?>
	
</head>
<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">

<?php 
    $query = "SELECT * FROM `title_slogan` WHERE `id` = 1 ";
    $result = $db->select($query);
    if ($result) {
        while ($title_slogan = $result->fetch_assoc()) { ?>

				<img src="admin/<?php echo $title_slogan['logo'] ;?>" alt="Logo"/>
				<h2><?php echo $title_slogan['title'] ;?></h2>
				<p><?php echo $title_slogan['slogan'] ;?></p>
	<?php } } ?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">

<?php  // copy from social.php
    $query = "SELECT * FROM `tbl_social` WHERE `id` = 1 ";
    $result = $db->select($query);
    if ($result) {
        while ($social = $result->fetch_assoc()) { 
             
?>
				<a href="<?php echo $social ['fb'] ;?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $social ['tw'] ;?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $social ['ln'] ;?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $social ['gp'] ;?>" target="_blank"><i class="fa fa-google-plus"></i></a>
<?php } } ?>			
			</div>
			<!-- search button -->
			<div class="searchbtn clear">
			<form action="search.php" method="GET"> <!--method must be used GET -->
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">

<?php  //active id for static page
 $path = $_SERVER['SCRIPT_FILENAME'];  
 $currentPage = basename($path, '.php');
?>
	<ul>
		<li><a  
			<?php 
				if ($currentPage == 'index') {
					echo 'id="active"';
				}
			 ?>
			href="index.php">Home</a></li>

	<!-- Dynamic page from admin panel -->
<?php  
    $query = "SELECT * FROM `tbl_page` ";
    $result = $db->select($query);
    if ($result) {
        while ($page = $result->fetch_assoc()) {                
?>	

		<li><a
			<?php   //database theke upload bole
				if (isset($_GET['pageid']) && $_GET['pageid'] == $page['id'] ) {
					echo 'id="active"';  //under <a tag
				}
			 ?>

		 href="page.php?pageid=<?php echo $page['id'] ?>">
			<?php echo $page['name'] ?></a></li>	

<?php } } ?>
	<!-- Dynamic page from admin panel -->

		<li><a 
			<?php 
				if ($currentPage == 'contact') {
					echo 'id="active"';
				}
			 ?>
			href="contact.php">Contact</a></li>
	</ul>
</div>
