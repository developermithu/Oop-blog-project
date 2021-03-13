<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

  <?php 
    // $catid = mysqli_real_escape_string($db->link, $_GET['catid']);
    
  	if (isset($_GET['catid'])) {
  		$catid = $_GET['catid'];

  		$delQuery = "DELETE FROM `tbl_category` WHERE `id` = '$catid' ";
  		$result = $db->delete($delQuery);
  		if ($result) {
  			    echo '<span class="error"> Category Deleted Successfully !</span>';
  		}else{
  			    echo '<span class="error"> Category Not Deleted !</span>';
  		}
  	}
  ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
                <th>Action</th>            
						</tr>
					</thead>
					<tbody>

    <?php  //select from tbl_category table
	    $query = "SELECT * FROM `tbl_category` ORDER BY `id` DESC ";
	    $result = $db->select($query);
	    if ($result) {
	    	$i = 0;
	    	while ($category = $result->fetch_assoc()) {  		  
				$i++;
	 ?>

						<tr class="odd gradeX">
							<td> <?php echo $i; ?> </td>
							<td> <?php echo $category['name'] ?></td>
							<td>

<?php if (Session::get('userRole') == '0') { ?>                 
								<!-- category edit -->
								<a href="editcat.php?catid=<?php echo $category['id'] ;?>">Edit</a> || 
								<!-- category delete -->
								<a onclick="return confirm('Are you sure to delete?')" href="?catid=<?php echo $category['id'] ;?>">Delete</a> 
<?php } ?>  <!-- without admin no one can access this page edit -->             
							</td>
						</tr>

   <!-- end while & if loop -->
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
