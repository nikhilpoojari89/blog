<?php
require_once('../includes/config.php');
$postByUsername = $_SESSION['username'];

if(!$user->is_logged_in()){ header('Location: login.php'); }

if(isset($_GET['deluser'])){ 

	if($_GET['deluser'] !='1'){

		$stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID') ;
		$stmt->execute(array(':memberID' => $_GET['deluser']));

		header('Location: users.php?action=Deleted');
		exit;

	}
} 

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BLOG - Users(Admin)</title>
        <meta name="description" content="Agaetis Technologies">
        <meta name="keywords" content="Demo Company in Borivali, Demo Company in Mumbai, Demo Company in India" />
        <link href="../assets/images/favicon.ico" rel="shortcut icon" />
        <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/style-admin.css" />
        <script>
            function deluser(id, title) {
                if (confirm("Are you sure you want to delete '" + title + "'")) {
                    window.location.href = 'users.php?deluser=' + id;
                }
            }
        </script>
    </head>

    <body>

        <div id="wrapper">

            <?php include('menu.php');?>

                <?php 
					if(isset($_GET['action'])){ 
                        $actionres = $_GET['action'];
                        if($actionres == 'Updated') {
                            echo '<h3 class="status-addmsg">User '.$_GET['action'].'&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></h3>';
                        }
                        else if($actionres == 'Deleted') {
                            echo '<h3 class="status-delmsg">User '.$_GET['action'].'&nbsp;<i class="fa fa-frown-o" aria-hidden="true"></i></h3>';
                        }
                        else if($actionres == 'Added') {
                            echo '<h3 class="status-addmsg">User '.$_GET['action'].'&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></h3>';
                        }
					} 
				?>

                    <h1>Users</h1>

                    <table width="100%">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

								try {

									$stmt = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY memberID');
									while($row = $stmt->fetch()){

										echo '<tr>';
										echo '<td data-title="Username">'.$row['username'].'</td>';
										echo '<td data-title="Email">'.$row['email'].'</td>';
									?>

				                        <td data-title="Action">
				                        	<a href="edit-user.php?id=<?php echo $row['memberID'];?>" class="edit">Edit</a>
				                            <?php if($row['memberID'] != 1){?>
				                            | <a href="javascript:deluser('<?php echo $row['memberID'];?>','<?php echo $row['username'];?>')" class="delete">Delete</a>
				                            <?php } ?>
				                        </td>

				                        <?php 
										echo '</tr>';

									}

								} catch(PDOException $e) {
								    echo $e->getMessage();
								}

							?>
                        </tbody>
                    </table>

                    <p class="btnstyle"><a href='add-user.php'><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add User</a></p>

        </div>
        <script src="assets/js/script-admin.js"></script>
    </body>

    </html>