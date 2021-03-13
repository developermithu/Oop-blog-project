<?php include 'inc/header.php'; ?>
<style>.about h2{padding-left:10px}</style>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>

<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$fname = $fm->validation($_POST['fname']);
		$lname = $fm->validation($_POST['lname']);
		$email = $fm->validation($_POST['email']);
		$msg   = $fm->validation($_POST['msg']);

		$fname = mysqli_real_escape_string($db->link, $fname);
		$lname = mysqli_real_escape_string($db->link, $lname);
		$email = mysqli_real_escape_string($db->link, $email);
		$msg   = mysqli_real_escape_string($db->link, $msg); 
	
		if (empty($fname)) {
			$error = "Firstname must not be empty!";
		}
		elseif (empty($lname)) {
			$error = "Lastname must not be empty!";
		}
		elseif (empty($email)) {
			$error = "Email address must not be empty!";
		}
		elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
			$error = "Email address invalid!";
		}
		elseif (empty($msg)) {
			$error = "Message must not be empty!";
		}
		  else{

	          $query = " INSERT INTO `tbl_contact` (`fname`, `lname`, `email`, `msg`, `status`) VALUES ('$fname', '$lname', '$email', '$msg', '0') ";
	          $inserted_row = $db->insert($query);
	          if ($inserted_row) {
	               $success = "Message send Successfully !";
	          }else{
	             $error = "Message not send !";
	          }
         	}         	
 	} //main if end	
 ?>


<?php 
	if (isset($error)) {
		echo "<span style='color:red;font-weight:bold;'>$error</span>";
	}

	if (isset($success)) {
		echo "<span style='color:green;font-weight:bold;'>$success</span>";
	}
 ?>

			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="fname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lname" placeholder="Enter Last name" />
					</td>
				</tr>			
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="msg"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>	

 </div>

		</div>

		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>

		