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
    <title>BLOG - Edit User(Admin)</title>
    <meta name="description" content="Agaetis Technologies">
    <meta name="keywords" content="Demo Company in Borivali, Demo Company in Mumbai, Demo Company in India" />
    <link href="../assets/images/favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style-admin.css" />
</head>

<body>

    <div id="wrapper">

        <?php include('menu.php');?>

            <h1>Edit User</h1>

			<?php

				if(isset($_POST['submit'])){

					extract($_POST);

					if( strlen($password) >= 0){

						if($password ==''){
							$error[] = 'Please enter the password.';
						}

						if($passwordConfirm ==''){
							$error[] = 'Please confirm the password.';
						}

						if($password != $passwordConfirm){
							$error[] = 'Passwords do not match.';
						}

					}
					

					if(!isset($error)){

						try {

							if(isset($password)){

								$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

								$stmt = $db->prepare('UPDATE blog_members SET username = :username, password = :password, email = :email WHERE memberID = :memberID') ;
								$stmt->execute(array(
									':username' => $username,
									':password' => $hashedpassword,
									':email' => $email,
									':memberID' => $memberID
								));


							} else {

								$stmt = $db->prepare('UPDATE blog_members SET username = :username, email = :email WHERE memberID = :memberID') ;
								$stmt->execute(array(
									':username' => $username,
									':email' => $email,
									':memberID' => $memberID
								));

							}
						
							header('Location: users.php?action=Updated');
							exit;

						} catch(PDOException $e) {
						    echo $e->getMessage();
						}

					}

				}

			?>


				<?php

					if(isset($error)){
						echo '<div class="error-box">';
						foreach($error as $error){
							echo '<p class="error">'.$error.'</p>';
						}
						echo '</div>';
					}

					try {

						$stmt = $db->prepare('SELECT memberID, username, email FROM blog_members WHERE memberID = :memberID') ;
						$stmt->execute(array(':memberID' => $_GET['id']));
						$row = $stmt->fetch(); 

					} catch(PDOException $e) {
					    echo $e->getMessage();
					}

				?>

				<form action='' method='post' autocomplete="off" class="adduser-form">

					<input type='hidden' name='memberID' value='<?php echo $row['memberID'];?>'>

					<div class="userinfo">
						<p><label>Username</label><br />
						<input type='text' name='username' value='<?php echo $row['username'];?>' style="user-select:none;opacity: 0.5;cursor: not-allowed;" readonly></p>

						<p><label>Password (only to change)</label><br />
						<input type='password' name='password' value=''></p>

						<p><label>Confirm Password</label><br />
						<input type='password' name='passwordConfirm' value=''></p>

						<p><label>Email</label><br />
						<input type='text' name='email' value='<?php echo $row['email'];?>' style="user-select:none;opacity: 0.5;cursor: not-allowed;" readonly></p>
					</div>

					<p class="btnstyle">
						<button type='submit' name='submit'><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Update User</button>&nbsp;&nbsp;
						<a href="users.php"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Go Back</a>
					</p>

				</form>

    </div>
<script src="assets/js/script-admin.js"></script>
</body>

</html>
