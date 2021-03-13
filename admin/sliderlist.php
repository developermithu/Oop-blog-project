<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block"> 

              <table class="data display datatable postlist" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Slider Title</th>
							<th>Slider Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

	<?php  // tbl_post & tbl_category join query
		$query = "SELECT * FROM `tbl_slider` ";
		  $result = $db->select($query);
		  if ($result) {
		  	$i = 0;
		  	while ($slider = $result->fetch_assoc()) {
		  	    $i++;		  
	 ?>					
						<tr class="dd gradeXo">
							<td><?php echo $i; ?></td>
							<td><?php echo $slider['title'] ;?></td>
							<td><img src="<?php echo $slider['image'];?>" height="60px" width="100px"></td>
							<td>
		<!-- without admin no one can edit and delete -->
		<?php if (Session::get('userRole') == '0') { ?>
							
							<a href="editslider.php?sliderid=<?php echo $slider['id'];?>">Edit</a> || 
							<a onclick="return confirm('Are you sure to delete?')" href="delslider.php?sliderid=<?php echo $slider['id'] ;?>">Delete</a>

		<?php } ?>			
							</td>	
						</tr>	
	<?php } } ?>								
					</tbody>
				</table>
               </div>
            </div>
        </div>
      
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
		</script>
		
<?php include 'inc/footer.php'; ?>