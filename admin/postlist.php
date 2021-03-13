<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable postlist" id="example">
					<thead>
						<tr>
							<th width="3%">No.</th>
							<th width="10%">Post Title</th>
							<th width="17%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="7%">mTags</th>
							<th width="8%">mDesc</th>
							<th width="10%">Author</th>
							<th width="10%">Date</th>
							<th width="15%">Action</th>
						</tr>
					</thead>

					<tbody>

	<?php  // tbl_post & tbl_category join query
		$query = "SELECT `tbl_post`.*, `tbl_category`.`name` FROM `tbl_post` INNER JOIN `tbl_category`
		  ON `tbl_post`.`cat` = `tbl_category`.`id` ORDER BY `tbl_post`.`title` DESC";
		  $result = $db->select($query);
		  if ($result) {
		  	$i = 0;
		  	while ($post = $result->fetch_assoc()) {
		  	    $i++;		  
	 ?>					
						<tr class="dd gradeXo">
							<td><?php echo $i; ?></td>
							<td><?php echo $post['title'] ;?></td>
							<td><?php echo $fm->textShorten($post['body'], 80) ;?></td>
							<td><?php echo $post['name'] ;?></td> <!-- category name -->
							<td><img src="<?php echo $post['image'];?>" height="40px" width="60px"></td> <!-- category name -->
							<td><?php echo $post['metaTags'] ;?></td> <!-- category name -->
							<td><?php echo $post['metaDescription'] ;?></td> <!-- category name -->
							<td><?php echo $post['author'] ;?></td> <!-- category name -->
							<td><?php echo $fm->formatDate($post['date']);?></td> <!-- category name -->
							
							<td><a href="viewpost.php?viewid=<?php echo $post['id'];?>">View</a>

		<!-- without writer & admin no one can edit and delete -->
		<?php if (Session::get('userid') == $post['user_id'] || Session::get('userRole') == '0') { ?>
							||<a href="editpost.php?edit_post_id=<?php echo $post['id'];?>">Edit</a>||<a onclick="return confirm('Are you sure to delete?')" href="delpost.php?del_id=<?php echo $post['id'] ;?>">Delete</a></td>
		<?php } ?>						
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