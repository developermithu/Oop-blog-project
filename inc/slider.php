<style> 
.slidersection{max-height: 290px;} 
</style>

<div class="slidersection templete clear">
        <div id="slider">

<?php 
	$query = "SELECT * FROM `tbl_slider` ORDER BY `id` LIMIT 5 ";
	 $result = $db->select($query);
		if ($result) {
		while ($slider = $result->fetch_assoc()) {		  
?>	

            <a href="#"><img src="admin/<?php echo $slider['image'] ?>" alt="<?php echo $slider['title'] ?>" title="<?php echo $slider['title'] ?>" /></a>
         
<?php } } ?>
        </div>
</div>