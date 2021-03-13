<style>
.copyright {color: #fff}
.copyright a{color: #efe219 !important; text-decoration: none;}	
</style>

</div>
	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>

<?php //for copyright
    $query = "SELECT * FROM `tbl_copy` WHERE `id` = 1 ";  //id always 1
    $result = $db->select($query);
    if ($result) {
        while ($copyright = $result->fetch_assoc()) {    
 ?>   
	  <p class="copyright">&copy; Copyright <a href="#"><?php echo $copyright['text'] ;?></a> <?php echo date('Y') ;?></p>

<?php } } ?>

	</div>
	<div class="fixedicon clear">

<?php  // from social.php
    $query = "SELECT * FROM `tbl_social` WHERE `id` = 1 ";
    $result = $db->select($query);
    if ($result) {
        while ($social = $result->fetch_assoc()) { 
             
?>
		<a href="<?php echo $social['fb'] ;?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $social['tw'] ;?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $social['ln'] ;?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $social['gp'] ;?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>

<?php } } ?>

	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>