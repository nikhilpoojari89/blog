<?php
require_once('../includes/config.php');

$postByUsername = $_SESSION['username'];

if(!$user->is_logged_in()){ header('Location: login.php'); }

if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));

	header('Location: index.php?action=Deleted');
	exit;
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG - Home(Admin)</title>
    <meta name="description" content="Agaetis Technologies">
    <meta name="keywords" content="Demo Company in Borivali, Demo Company in Mumbai, Demo Company in India" />
    <link href="../assets/images/favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style-admin.css" />
	  <script>
	  function delpost(id, title)
	  {
		  if (confirm("Are you sure you want to delete '" + title + "'"))
		  {
		  	window.location.href = 'index.php?delpost=' + id;
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
               	echo '<h3 class="status-addmsg">Blog '.$_GET['action'].'&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></h3>';
            }
            else if($actionres == 'Deleted') {
                echo '<h3 class="status-delmsg">Blog '.$_GET['action'].'&nbsp;<i class="fa fa-frown-o" aria-hidden="true"></i></h3>';
            }
            else if($actionres == 'Added') {
                echo '<h3 class="status-addmsg">Blog '.$_GET['action'].'&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></h3>';
            }
		} 
	?>

	<h1>Home</h1>

	<table width="100%">
	<thead>
		<tr>
			<th>Title</th>
			<th>Date</th>
			<th>Posted By</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
			<?php
				try {

					$stmt = $db->query('SELECT postID, postTitle, postDate, postBy FROM blog_posts ORDER BY postID DESC');
					while($row = $stmt->fetch()){
						
						echo '<tr>';
						echo '<td data-title="Title">'.$row['postTitle'].'</td>';
						echo '<td data-title="Date">'.date('jS M Y', strtotime($row['postDate'])).'</td>';
						echo '<td data-title="Posted By">'.$row['postBy'].'</td>';
						?>

						<td data-title="Action">
							<a href="edit-blog.php?id=<?php echo $row['postID'];?>" class="edit">Edit</a> | 
							<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')" class="delete">Delete</a>
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

	<p class="btnstyle"><a href='add-blog.php'><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Blog</a></p>

</div>
<script src="assets/js/script-admin.js"></script>
</body>
</html>
