<?php
require_once('../includes/config.php');
if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BLOG - Login</title>
        <meta name="description" content="Agaetis Technologies">
        <meta name="keywords" content="Demo Company in Borivali, Demo Company in Mumbai, Demo Company in India" />
        <link href="../assets/images/favicon.ico" rel="shortcut icon" />
        <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/style-admin.css" />

    </head>

    <body>

        <div class="main-section">
            <h1>Blog Login</h1>

            <div class="main-box">
                <div class="main-content" id="login">
                    <div class="user-img">
                        <img src="../assets/images/blog_logo_login.png" alt="">
                    </div>

                    <?php

        				if(isset($_POST['submit'])){

        					$username = trim($_POST['username']);
        					$password = trim($_POST['password']);

        					if($user->login($username,$password)){ 

        						header('Location: index.php');
        						exit;

        					} else {
        						$message = '<p class="error">Wrong username or password</p>';
        					}

        				}

    				    if(isset($message)){ echo $message; }
    				?>

                        <form action="" method="post">
                            <p class="login-font">Login Here<span class="fa fa-hand-o-down"></span></p>
                            <div class="input">
                                <input type="text" placeholder="Username" name="username" required="" value="">
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="input">
                                <input type="password" placeholder="Password" name="password" required="" value="">
                                <span class="fa fa-unlock"></span>
                            </div>
                            <button type="submit" name="submit" class="btn submit">
                                <span class="fa fa-sign-in"></span>
                            </button>
                        </form>
                        <p>Admin/User Login</p>
                        <br/>
                </div>
            </div>

            <div class="copyright">
                <h2>© 2019 Blog Login. All rights reserved.</h2>
            </div>

        </div>

    </body>

    </html>