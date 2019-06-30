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
    <title>BLOG - Edit Blog(Admin)</title>
    <meta name="description" content="Agaetis Technologies">
    <meta name="keywords" content="Demo Company in Borivali, Demo Company in Mumbai, Demo Company in India" />
    <link href="../assets/images/favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style-admin.css" />
    <script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  	<script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  	</script>
</head>

<body>

    <div id="wrapper">

        <?php include('menu.php');?>

            <h1>Edit Blog</h1>
			
				<?php

					if(isset($_POST['submit'])){

						$_POST = array_map( 'stripslashes', $_POST );

						extract($_POST);

						if($postID ==''){
							$error[] = 'This post is missing a valid id!.';
						}

						if($postTitle ==''){
							$error[] = 'Please enter the title.';
						}

						if($postDesc ==''){
							$error[] = 'Please enter the description.';
						}

						if($postCont ==''){
							$error[] = 'Please enter the content.';
						}

						if($postBy ==''){
							$error[] = 'Please enter posted by.';
						}

						if(!isset($error)){

							try {

								$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont, postBy = :postBy WHERE postID = :postID') ;
								$stmt->execute(array(
									':postTitle' => $postTitle,
									':postDesc' => $postDesc,
									':postCont' => $postCont,
									':postBy' => $postBy,
									':postID' => $postID
								));

								header('Location: index.php?action=Updated');
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

							$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont, postBy FROM blog_posts WHERE postID = :postID') ;
							$stmt->execute(array(':postID' => $_GET['id']));
							$row = $stmt->fetch(); 

						} catch(PDOException $e) {
						    echo $e->getMessage();
						}

				?>

				<form action='' method='post' autocomplete="off" class="addblog-form">

					<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

					<div class="bloginfo">
						<p><label>Title</label><br />
						<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

						<p><label>Description</label><br /><br />
						<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p><br />

						<p><label>Content</label><br /><br />
						<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p><br />

						<p><label>Posted By</label><br />
						<input type='text' name='postBy' value='<?php echo $row['postBy'];?>'></p>
					</div>

					<p class="btnstyle">
						<button type='submit' name='submit'><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Update Blog</button>&nbsp;&nbsp;
						<a href="./"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Go Back</a>
					</p>

				</form>
			

    </div>
<script src="assets/js/script-admin.js"></script>
</body>

</html>
