<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php' ;?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Category List</h2>

    <?php
       // $userid = mysqli_real_escape_string($db->link,  $_GET['userid']);
      if (isset($_GET['userid'])) {
        $userid = $_GET['userid'];

        $delQuery = "DELETE FROM `tbl_user` WHERE `id` = '$userid' ";
        $result = $db->delete($delQuery);
        if ($result) {
          echo '<span class="error"> User Accounts Deleted Successfully !</span>';
        }else{
          echo '<span class="error"> User Accounts Not Deleted !</span>';
        }
      }
    ?>

    <div class="block">
      <table class="data display datatable" id="example">
        <thead>
          <tr>
            <th width="10%">Serial No.</th>
            <th width="15%">Name</th>
            <th width="15%">Username</th>
            <th width="15%">Email</th> 
            <th width="20%">Details</th>
            <th width="10%">Role</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody>

<?php  //select from tbl_category table
   $query = "SELECT * FROM `tbl_user` ORDER BY `id` DESC ";
   $result = $db->select($query);
   if ($result) {
      $i = 0;
      while ($user = $result->fetch_assoc()) {
      $i++;
?>
          <tr class="odd gradeX">
            <td> <?php echo $i; ?> </td>
            <td> <?php echo $user['name'] ?></td>
            <td> <?php echo $user['username'] ?></td>
            <td> <?php echo $user['email'] ?></td>
            <td> <?php echo $fm->textShorten($user['details'], 30) ?></td>

            <td> 
              <?php 
                  if ($user['role'] == '0') {
                    echo "Admin";
                  }
                  if ($user['role'] == '1') {
                    echo "Author";
                  }
                  if ($user['role'] == '2') {
                    echo "Editor";
                  }
               ?>
            </td>

            <td>
              <!-- user edit -->
              <a href="viewuser.php?userid=<?php echo $user['id'] ;?>">View</a>

              <!-- user delete -->
  <?php if ( Session::get('userRole') == '0') { ?>
              || <a onclick="return confirm('Are you sure to delete?')" href="?userid=<?php echo $user['id'] ;?>">Delete</a>
 <?php } ?>           
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