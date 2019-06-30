<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate, postBy FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

if($row['postID'] == ''){
    header('Location: ./');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG - <?php echo $row['postTitle'];?></title>
    <meta name="description" content="Agaetis Technologies">
    <meta name="keywords" content="Demo Company in Borivali, Demo Company in Mumbai, Demo Company in India" />
    <link href="assets/images/favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="assets/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

</head>

<body>

    <div class="wrapper">

        <header id="navigation">

            <div class="topbar">
                <div class="topbar-centered">
                    <a href="index.php" class="active"><img src="assets/images/blog_logo.png" alt="Blog Logo"></a>
                </div>

                <a href="javascript:void(0)">Subscribe</a>

                <div class="topbar-right">
                    <a href="javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i></a>

                <!--<div class="box">
			  			<input class="search" type="search" placeholder="Search" />
			  			<div class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></div>
		  			</div> -->

                    <a href="javascript:void(0)" class="signup">Sign up</a>
                </div>
            </div>

            <hr style="width: 98%;" />

            <nav class="navigate-main">
                <div class="topnav" id="mytopnav">
                    <a href="javascript:void(0)">World</a>
                    <a href="javascript:void(0)">U.S.</a>
                    <a href="javascript:void(0)">Technology</a>
                    <a href="javascript:void(0)">Design</a>
                    <a href="javascript:void(0)">Culture</a>
                    <a href="javascript:void(0)">Business</a>
                    <a href="javascript:void(0)">Politics</a>
                    <a href="javascript:void(0)">Opinion</a>
                    <a href="javascript:void(0)">Science</a>
                    <a href="javascript:void(0)">Health</a>
                    <a href="javascript:void(0)">Style</a>
                    <a href="javascript:void(0)">Travel</a>
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
            </nav>

        </header>


        <div class="header">
            <div class="content">
                <h3>How to pick the right UI font</h3>
                <p>Find out how to pick fonts for your user interfaces that aren't just beautiful, but also improve your websites' usability.</p>
                <a href="javascript:void(0)">Continue reading...</a>
            </div>
        </div>

        <div class="row thumb">

            <div class="thumb-leftcolumn">
                <div class="card">
                    <div class="blogimg"></div>
                    <div class="thumb-blog-info">
                        <p>World</p>
                        <h1>10 essential UI design tips</h1>
                        <p>Dec 7</p>
                        <p>Memorize these 10 guidelines if you want to build elegant, easy to use, and human-centered user interfaces.</p>
                        <a href="javascript:void(0)">Continue reading</a>
                    </div>

                </div>
            </div>
            <div class="thumb-rightcolumn">
                <div class="card">
                    <div class="blogimg"></div>
                    <div class="thumb-blog-info">
                        <p>Design</p>
                        <h1>Best site search practices</h1>
                        <p>Dec 6</p>
                        <p>Search can be a powerful tool for improving UX. And it only gets more powerful when you follow these best practices.</p>
                        <a href="javascript:void(0)">Continue reading</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="leftcolumn">
                <div class="card section-heading">
                    <h2>Latest Blogs</h2>
                    <hr/>
                </div>

                <?php
                            
                    echo '<div class="card">';
                    echo '<h1>'.$row['postTitle'].'</h1>';
                    echo '<h5>'.date('jS M Y', strtotime($row['postDate'])).' by <span>'.$row['postBy'].'</span></h5>';
                    echo '<p>'.$row['postCont'].'</p>'; 
                    echo '</div>';

                ?>

                <div class="card button">
                    <a href="./" class="older"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Go Back</a>
                </div>

            </div>

            <div class="rightcolumn">
                <div class="card about">
                    <h1>About</h1>
                    <p>A blog is a discussion or informational website published on the World Wide Web consisting of discrete, often informal diary-style text entries.</p>
                </div>
                <div class="card archives">
                    <h1>Archives</h1>
                    <p>March 2014</p>
                    <p>February 2014</p>
                    <p>January 2014</p>
                    <p>December 2013</p>
                    <p>November 2013</p>
                    <p>October 2013</p>
                    <p>September 2013</p>
                    <p>August 2013</p>
                    <p>July 2013</p>
                    <p>June 2013</p>
                    <p>May 2013</p>
                    <p>April 2013</p>
                </div>
                <div class="card elsewhere">
                    <h1>Elsewhere</h1>
                    <p>GitHub</p>
                    <p>Twitter</p>
                    <p>Facebook</p>
                </div>
            </div>

        </div>

        <footer class="footer">

            <div class="footer-section">

                <div class="copyright">
                    <p>Blog template built for <a href="javascript:void(0)" target="_blank">Bootstrap</a> by <a href="javascript:void(0)" target="_blank">@mdo</a></p>
                </div>

                <div class="scrolltop">
                    <div class="scroll icon">Back to top</div>
                </div>

            </div>

        </footer>

    </div>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>