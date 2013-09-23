<?php
ob_start();
session_start();
$_SESSION['page'] = "HOME" ;
include('htmlHeader.html');

// Facebook Login Part 
# Learn from - https://developers.facebook.com/docs/reference/php/facebook-getAccessToken/
require_once("../res/f-php-sdk/facebook.php");  
$config = array();
$config['appId'] = '1410985479119424';
$config['secret'] = 'f58f2f098af2d5de26777b5f783a8f80';
$config['fileUpload'] = false; // optional
$facebook = new Facebook($config);
$uid = $facebook->getUser();

?>
<body>

<!-- Start Page Loader -->
<div class="pageloader">
	<img src="../res/images/pageloader1.gif"/>
</div>
<!-- Stop Page Loader -->

<?php
	include('pageHeader.php');
?>

<!-- Search Box -->
<div class="container maincontent">
	<div class="searchbox">
		<form action="#" method="post">
		<input type="search" id="searchbox" placeholder="Type keyword to search and Press Enter" />
		</form>
	</div>
</div>
<!-- Search Box -->

<?php
	if(isset($_SESSION['uid'])){
?>
<div class="container maincontent tquestbox">
	<div class="row">
		<div class="span12">
			<form action="#" method="post">
				<center>
				<input type="text" placeholder="Ask technical question ?" name="techques" />
				<br/>
					<input type="submit" class="askbutton" value="Hit to ask"/>
				</center>
			</form>
		</div>
	</div>
</div>
<?php
	}else{
?>
<div class="container maincontent">
	<div class="row">
		<div class="span12">
			<center>
				<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
				  Login to Ask technical Question.
				</div>
			</center>
		</div>
	</div>
</div>
<?php
	}
?>

<div class="container maincontent">
	<div class="row">
		<div class="span12">
			<center>

<?php
		if(isset($_GET['error'])){
			echo "<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button>";
  				echo $_GET['error']  ;
			echo "</div>" ;
			echo "<div class='clearfix'></div>" ;
		}elseif ($_GET['success']) {
			echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>";
  				echo $_GET['success']  ;
			echo "</div>" ;
			echo "<div class='clearfix'></div>" ;
		}
?>
			</center>
		</div>
	</div>
</div>


<div class="container maincontent">
	<div class="row">
		<div class="span8">
			<ul class="nav nav-tabs" id="maintabs">
			  <li><a href="#popular" data-toggle="tab">Popular</a></li>
			  <li><a href="#latest" data-toggle="tab">Latest</a></li>
			  <li><a href="#winners" data-toggle="tab">Winners</a></li>
			</ul>
			<div class="tab-content">
			   <div class="tab-pane active" id="popular">
			  	 <!-- <h2>Popular</h2> -->

			  	 <?php
			  	 	include('popular_less.php');
			  	 ?>


			   </div>
			   <div class="tab-pane" id="latest">
			  	 <h2>Latest</h2>
			   </div>
			   <div class="tab-pane" id="winners">
			  	 <h2>winners</h2>
			   </div>
		   </div>
		</div>
		<div class="span4">

			<?php
				if(isset($_SESSION['uid'])){
					echo "<div class='subscribebox userInfoBox'>";
						echo "<h4>Welcome!!!!</h4>" ;
						echo "<img src='" . $_SESSION['upicture'] . "'/>";
						echo "<p>" . $_SESSION['uname'] . "</p>" ;
						if(isset($_SESSION['source']) && strcmp($_SESSION['source'], "TechNinja") == 0){
							echo "<p><a href='changePassword.php'>Change Password</a></p>" ;
						}
						echo "<div class='clearfix'></div>";
					echo "</div>";
				}
			?>

			<div class="tagbox">
				<h4>Tags Database</h4>
				<ul>
					<li><a href="#">C++</a></li>
					<li><a href="#">Java</a></li>
					<li><a href="#">DataBase</a></li>
					<li><a href="#">Web</a></li>
					<li><a href="#">Data Structure</a></li>
					<li><a href="#">Algorithm</a></li>
				</ul>
				<div class="clearfix"></div>
			</div>



			<?php
				if(!isset($_SESSION['uid'])){
			?>

			<div class="subscribebox">
                	<h4>Login via Facebook ID</h4>
                    <p>You can login with your facebook credentials in TechNinja.</p>
                    <?php
                    	$params = array(
	  						//'scope' => 'read_stream, friends_likes, user_likes, publish_actions', // Get more from API Explorer page
					      	'scope' => 'email, publish_actions', // Get more from API Explorer page
					  		'redirect_uri' => 'http://www.techninja.fitied.com/home/facebook_login_success.php',
					  		//'display' => 'popup'
						);
						$login_url = $facebook->getLoginUrl($params);
						echo "<p><a href='" . $login_url . "'><img src='../res/images/fb_login.png' /></a>" . "</p>";
					?>
                    <p class="smaller">We assure you that your facebook profile is <strong>safe</strong> with us.</p>
			</div>

			<!-- <div class="subscribebox">
				
                	<h4>Login via TechNinja ID</h4>
                
                    <p>Login to start fighting your way to learn</p>
                    <form action="user_login.php" method="POST">
                    	<input type="email" name="email" id="text-input" required="required" placeholder="Enter your Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
                    	<input type="password" name="password" id="text-input" required="required" placeholder="Enter password">
                    	
                    	<input type="hidden" name="submitted">
                    	<input type="hidden" name="pageURL" value="<?php echo $_SERVER['PHP_SELF'] ; ?>">
                        <input type="submit" name="submit" id="submit" value="Go">
                    </form>
                    <p>Forgot Password ? <a href="resetPassword.php">Reset Password</a></p>
                    <p class="smaller">Not <strong>Registered</strong>!! Please Register below.</p>
			</div> -->

			

			<!-- <div class="subscribebox">
				
                	<h4>Register for free</h4>
                
                    <p>Join others and be a part of TechNinja</p>
                    <form action="user_registration.php" method="POST">
                    	<input type="text" name="name" id="text-input" required="required" placeholder="Enter your Name">
                    	<input type="email" name="email" id="text-input" required="required" placeholder="Enter your Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
                    	<input type="hidden" name="submitted">
                    	<input type="hidden" name="pageURL" value="<?php echo $_SERVER['PHP_SELF'] ; ?>">
                        <input type="submit" name="submit" id="submit" value="Go">
                    </form>
                    <p class="smaller">We will <strong>never</strong> share your email with others.</p>
			</div> -->

			<?php
				}
			?>
			
		</div>
	</div>
</div>

</body>
</html>