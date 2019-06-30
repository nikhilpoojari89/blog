<?php 
require_once('../includes/config.php');
$postByUsername = $_SESSION['username'];

if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG - Add User(Admin)</title>
    <meta name="description" content="Agaetis Technologies">
    <meta name="keywords" content="Demo Company in Borivali, Demo Company in Mumbai, Demo Company in India" />
    <link href="../assets/images/favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style-admin.css" />
</head>

<body>

    <div id="wrapper">

        <?php include('menu.php');?>

            <h1>Add User</h1>

            <?php
			
				if(isset($_POST['submit'])){
				
					extract($_POST);

					if($username ==''){
						$error[] = 'Please enter the username.';
					}

					if($password ==''){
						$error[] = 'Please enter the password.';
					}

					if($passwordConfirm ==''){
						$error[] = 'Please confirm the password.';
					}

					if($password != $passwordConfirm){
						$error[] = 'Passwords do not match.';
					}

					if($email ==''){
						$error[] = 'Please enter the email address.';
					}

					if(!isset($error)){

						$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

						try {

							$stmt = $db->prepare('INSERT INTO blog_members (username,password,email) VALUES (:username, :password, :email)') ;
							$stmt->execute(array(
								':username' => $username,
								':password' => $hashedpassword,
								':email' => $email
							));

							header('Location: users.php?action=Added');
							exit;

						} catch(PDOException $e) {
							echo $e->getMessage();
							}

					}

				}

				if(isset($error)){
					echo '<div class="error-box">';
					foreach($error as $error){
						echo '<p class="error">'.$error.'</p>';
					}
					echo '</div>';
				}
			?>

			<form action='' method='post' autocomplete="off" class="adduser-form">

				<div class="userinfo">
					<p><label>Username</label><br />
					<input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

					<p><label>Password</label><br />
					<input type='password' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

					<p><label>Confirm Password</label><br />
					<input type='password' name='passwordConfirm' value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>

					<p><label>Email</label><br />
					<input type='text' name='email' value='<?php if(isset($error)){ echo $_POST['email'];}?>'></p>
				</div>

				<p class="btnstyle">
					<button type='submit' name='submit'><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add User</button>&nbsp;&nbsp;
					<a href="users.php"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Go Back</a>
				</p>

			</form>

    </div>
<script src="assets/js/script-admin.js"></script>
</body>

</html>
