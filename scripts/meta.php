<!-- Dynamic website main title -->
 <?php 
	if ( isset($_GET['pageid'])) {
		$pageid = $_GET['pageid'];

		$query = "SELECT * FROM `tbl_page` WHERE `id` = '$pageid' ";
        $result = $db->select($query);
    	if ($result) {
        while ($tbl_page = $result->fetch_assoc()) { ?>

			<title><?php echo $tbl_page['name'] ;?>-<?php echo TITLE ;?></title>
<?php } } }  //if end

	elseif ( isset($_GET['id'])) {
		$postid = $_GET['id'];

		$query = "SELECT * FROM `tbl_post` WHERE `id` = '$postid' ";
        $result = $db->select($query);
    	if ($result) {
        while ($tbl_post = $result->fetch_assoc()) { ?>

			<title><?php echo $tbl_post['title'] ;?>-<?php echo TITLE ;?></title>

	<!-- elseif end -->
 <?php } } } else{ ?> 
				<title><?php echo $fm->title() ;?>-<?php echo TITLE ;?></title> 
				<!--format.php title() method-->
 <?php } ?>
<!-- Dynamic website main title -->

	<meta name="language" content="English">


 <?php  // Dynamic meta description
	if ( isset($_GET['id'])) {
		$postid = $_GET['id'];
		$query = "SELECT * FROM `tbl_post` WHERE `id` = '$postid' ";
        $result = $db->select($query);
    	if ($result) {
        while ($tbl_post = $result->fetch_assoc()) { ?>
        	
		<meta name="description" content="<?php echo $tbl_post['metaDescription'] ;?>">

<?php } } }else{ ?>
			<meta name="description" content="<?php echo DESCRIPTION ;?>"><!--from config-->
<?php } ?> <!-- End Dynamic meta description -->



 <?php  // Dynamic meta keywords
	if ( isset($_GET['id'])) {
		$postid = $_GET['id'];
		$query = "SELECT * FROM `tbl_post` WHERE `id` = '$postid' ";
        $result = $db->select($query);
    	if ($result) {
        while ($tbl_post = $result->fetch_assoc()) { ?>

		<meta name="keywords" content="<?php echo $tbl_post['metaTags'] ;?>">

<?php } } }else{ ?>
			<meta name="keywords" content="<?php echo KEYWORDS ;?>"><!--from config-->
<?php } ?> <!-- End Dynamic meta keywords -->

	<meta name="author" content="Delowar">