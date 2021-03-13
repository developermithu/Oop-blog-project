<?php include 'inc/header.php' ;?>
<?php include 'inc/sidebar.php'; ?>

<!-- without admin no one can access this page -->
<?php if (!Session::get('userRole') == '0') { 
    echo "<script> window.location = 'index.php' ;</script>";
  } ?>
<!-- without admin no one can access this page -->

<div class="grid_10">
  <div class="box round first grid">
    <h2>Add New User</h2>
    <div class="block copyblock">

<?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $fm->validation($_POST['username']);
        $password = $fm->validation(md5($_POST['password']));
        $email    = $fm->validation($_POST['email']);
        $role     = $fm->validation($_POST['role']);


        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);
        $email    = mysqli_real_escape_string($db->link, $email);
        $role     = mysqli_real_escape_string($db->link, $role);

         if ( empty($username) || empty($password) || empty($role) || empty($email)) {
          echo '<span class="error"> Field must not be empty !</span>';
          }
          else{ // databse e same email thakle error asbe
            $mailquery = "SELECT * FROM `tbl_user` WHERE `email` = '$email' LIMIT 1 ";
            $mailCheck = $db->select($mailquery);
            if ($mailCheck != false) {
              echo '<span class="error"> Email address already exists !</span>';
            }
             else{
             $query = "INSERT INTO `tbl_user` (`username`, `password`,`email`, `role`) VALUES ('$username', '$password', '$email', '$role')";
             $catInsert = $db->insert($query);
              if ($catInsert) {
                echo '<span class="success"> User Created Successfully !</span>';
              }else{
                  echo '<span class="error"> User Not Created !</span>';
             }
          }
        }
   }
?>


      <form action="" method="post">
        <table class="form">
          <tr>
            <td>Username</td>
            <td>
              <input type="text" placeholder="Enter Username..." class="medium" name="username" />
            </td>
          </tr>
          <tr>
            <td>Password</td>
            <td>
              <input type="password" placeholder="Enter Password..." class="medium" name="password" />
            </td>
          </tr>
           <tr>
            <td>Email</td>
            <td>
              <input type="email" placeholder="Enter Valid Email..." class="medium" name="email" />
            </td>
          </tr>
          <tr>
            <td>User Role</td>
            <td>
              <select name="role">
                <option selected>Select User Role</option>
                <option value="0">Admin</option>
                <option value="1">Author</option>
                <option value="2">Editor</option>
                option
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" name="submit" Value="Create" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>


<?php include 'inc/footer.php'; ?>