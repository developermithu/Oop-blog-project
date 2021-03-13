<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>     

   <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>

<?php  // status 0 ke 1 korle seen box e jabe
	 // $seenid = mysqli_real_escape_string($db->link, $_GET['seenid']);
	if ( isset($_GET['seenid'])) {
		   $id = $_GET['seenid'];

		  $query = " UPDATE `tbl_contact` SET `status` = '1' WHERE `id` = '$id' ";
          $catUpdated = $db->update($query);

          if ($catUpdated) {
               echo '<span class="success"> Message sent seen box Successfully !</span>';
          }else{
             echo '<span class="error"> Somthing went wrong !</span>';
          }
	}
 ?>                 
                <div class="block">  

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

<?php  //select from tbl_contact table
	 $query = "SELECT * FROM `tbl_contact` WHERE `status`= '0' ORDER BY `id` DESC ";
	 $selected_row = $db->select($query);
	 if ($selected_row) {
	   $i = 0;
	 	while ($contact = $selected_row->fetch_assoc()) {  		  	
	 	$i++;
?>			
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $contact['fname'].' '.$contact['lname'] ;?></td> 
							<td><?php echo $contact['email'] ;?></td>
							<td><?php echo $fm->textShorten($contact['msg'], 30) ;?></td>
							<td><?php echo $fm->formatDate($contact['date']) ;?></td>

							<td>
								<a href="viewmsg.php?msgid=<?php echo $contact['id'];?>">View</a> || 
								<a href="replymsg.php?replyid=<?php echo $contact['id'];?>">Reply</a> ||
								<a onclick="return confirm('Are you sure to send the msg in seen box')" href="?seenid=<?php echo $contact['id'] ;?>">Seen</a>
							</td>
						</tr>	

<?php } } ?>											
					</tbody>
				</table>
               </div>
            </div>

      <!-- seen message box -->
      <div class="box round first grid">
                <h2>Seen Message</h2>

<?php  //seen message  query
	// $delid = mysqli_real_escape_string($db->link, $_GET['delid']);
	if (isset($_GET['delid'])) {
		$id = $_GET['delid'];

		$query = "DELETE FROM `tbl_contact` WHERE `id` = '$id' ";
		$deleted_row = $db->delete($query);
		if ($deleted_row) {
			echo '<span class="success"> Message deleted Successfully !</span>';
		}else{ 
			echo '<span class="error"> Somthing went wrong !</span>';
		 }
	}
 ?>   

                <div class="block">  
                   <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>


<?php  //select status=1 query
	 $query = "SELECT * FROM `tbl_contact` WHERE `status`= '1' ORDER BY `id` DESC ";
	 $selected_row = $db->select($query);
	 if ($selected_row) {
	 	while ($contact = $selected_row->fetch_assoc()) {  		  	
?>			
						<tr class="odd gradeX">						
							<td><?php echo $contact['fname'].' '.$contact['lname'] ;?></td> 
							<td><?php echo $contact['email'] ;?></td>
							<td><?php echo $fm->textShorten($contact['msg'], 30) ;?></td>
							<td><?php echo $fm->formatDate($contact['date']) ;?></td>

							<td>	
								<a href="viewmsg.php?msgid=<?php echo $contact['id'];?>">View</a> ||		
								<a onclick="return confirm('Are you sure to delete the msg?')" href="?delid=<?php echo $contact['id'] ;?>">Delete</a> 
							</td>
						</tr>	

<?php } } ?>											
					</tbody>
				</table>

               </div>
            </div>
        </div>


<!-- footer part -->
<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
</script>
 <?php include 'inc/footer.php'; ?>
