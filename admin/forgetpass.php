<?php 
include '../lib/Session.php';
Session::checkLogin(); //session_start(); korlam method er maddome
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php  
	$db = new Database();
	$fm = new Format();
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

     	<?php 
     		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     			$email = $fm->validation($_POST['email']);
     			$email = mysqli_real_escape_string($db->link, $email);
     			
                    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                         echo '<h3 style="color:red;">Invalid Email Address !</h3>';
                    }
                    else{ //livserver e upload na korle email jabe na error asbe
          			$mailquery = "SELECT * FROM `tbl_user` WHERE `email` = '$email' LIMIT 1 ";
                         $mailCheck = $db->select($mailquery);
                         if ($mailCheck) {
                              while ($user = $mailCheck->fetch_assoc()) {
                                  $userid   = $user['id'];
                                  $username = $user['username'];
                              }
                              $text = substr($email, 0, 3);
                              $rand = rand(10000, 99999);
                              $newpassword = "$text$rand"; //email er 3 char & pass 5 char
                              $password = md5($newpassword); //md5 pass database e jabe r new pass user er email e

                               $query = " UPDATE `tbl_user` SET 
                                   `password` = '$password'     
                                    WHERE `id` = '$userid' ";
                                   $updated_row = $db->update($query);

                                   $to      = "$email";
                                   $from    = "mywebsite@gmail.com";
                                   $header  = "From: $from\n"; 
                                   $header .= 'MIME-Version: 1.0' . "\r\n";
                                   $header .= 'Content-type: text/html; charset =iso-8859-1' . "\r\n";
                                   $subject = "Your Password";
                                   $message = "Your username is" .$username. "and Your password is" .$newpassword. "Please visit website to login ";

                                   $sendMail = mail($to, $subject, $message, $header); //php.net from

                                   if ($sendMail == true) {
                                        echo '<span style="color:green;"> Please check your email for new password !</span>';
                                   }else{
                                      echo '<span style="color:red;"> Email not sent !</span>';
                                   }

                         }
          			else{
          				echo '<h3 style="color:red;">Email Not Exists !</h3>';
          			}
                    }
     		}
     	 ?>

		<form action="" method="POST">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter valid email address"  name="email" required="" />
			</div>
			
			<div>
				<input type="submit" value="Send Email" >
			</div>
		</form><!-- form -->
 
          <div class="button">
               <a href="login.php">Back</a>
          </div><!-- button -->

		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>