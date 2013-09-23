<div class="topline"></div>

<!-- Top Nav -->

<div class="container maincontent">
	<div class="topnavigation">
		<a href="../home/"><div class="logo"></div></a>
		<div class="topmenu">
			<ul>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>

				<?php
					if($uid == 0){
						if(isset($_SESSION['uid'])){
							// Login from TechNinja ID
							$logout_url = 'http://www.techninja.fitied.com/home/facebook_logout.php' ;
							echo "<li class='logout'><a href='" . $logout_url . "'><i class='icon-off icon-white'></i>&nbsp;Logout</a>" . "<br/></li>" ;
						}else{
							echo "<li><a href='#dialog1' name='modal'>Register</a></li>" ;
							echo "<li><a href='#dialog' name='modal'>Login</a></li>";
						}
						// Not Logged In
						// $params = array(
	  			// 			//'scope' => 'read_stream, friends_likes, user_likes, publish_actions', // Get more from API Explorer page
					 //      	'scope' => 'email, publish_actions', // Get more from API Explorer page
					 //  		'redirect_uri' => 'http://www.techninja.fitied.com/home/facebook_login_success.php',
					 //  		//'display' => 'popup'
						// );
						// $login_url = $facebook->getLoginUrl($params);
						// echo "<li><a href='" . $login_url . "'>Login</a></li>" . "<br/>";
					}else{
						// Logged In
						$params = array( 'next' => 'http://www.techninja.fitied.com/home/facebook_logout.php' );
						$logout_url = $facebook->getLogoutUrl($params); // $params is optional.
						echo "<li class='logout'><a href='" . $logout_url . "'><i class='icon-off icon-white'></i>&nbsp;Logout</a>" . "<br/></li>" ;

					}
				?>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<!-- Box for login modal window -->
<div id="boxes">
	<div id="dialog" class="window">
		<!-- Simple Modal Window |  <a href="#"class="closemodalwindow">Close it</a> -->
		<div class="modalwindowtop">
			<p>
				Sign In / Login
				<a href="#"class="closemodalwindow">&nbsp;X&nbsp;</a>
			</p>
			
			<div class="clearfix"></div>
		</div>
		<div class="modalwindowfacebooklogin">
			<p align="center">
				<?php
                	$params = array(
  						//'scope' => 'read_stream, friends_likes, user_likes, publish_actions', // Get more from API Explorer page
				      	'scope' => 'email, publish_actions', // Get more from API Explorer page
				  		'redirect_uri' => 'http://www.techninja.fitied.com/home/facebook_login_success.php',
				  		//'display' => 'popup'
					);
					$login_url = $facebook->getLoginUrl($params);
					echo "<a href='" . $login_url . "'><img src='../res/images/fb_login.png' /></a>" ;
				?>
				<br><br>
				<span class="smaller">We assure you that your facebook profile is <strong>safe</strong> with us.</span>
				<!-- <img src='../res/images/fb_login.png' /> -->
			</p>
			<div class="clearfix"></div>
		</div>
		<div class="modalwindowaltline">
			<p align="center">
				------&nbsp;&nbsp;OR via TechNinija&nbsp;&nbsp;------
			</p>
			<div class="clearfix"></div>
		</div>
		<div class="modalwindowloginfields" align="center">
			<p align="center">
	            <form action="user_login.php" method="POST">
	            	<input type="email" name="email" id="text-input" required="required" placeholder="Enter your Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
	            	<input type="password" name="password" id="text-input" required="required" placeholder="Enter password">
	            	<!--<input type="password" name="confirmpassword" id="text-input" required="required" placeholder="Re-enter the above password"> -->
	            	<input type="hidden" name="submitted">
	            	<input type="hidden" name="pageURL" value="<?php echo $_SERVER['PHP_SELF'] ; ?>">
	                <br>
	                <input type="submit" name="submit" id="submit" value="Go">
	            </form>
	            <p>Forgot Password ? <a href="resetPassword.php">Reset Password</a></p>
	            <p class="smaller">Not <strong>Registered</strong>!! Please <a href="register.php">Register</a></p>
	        </p>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<!-- Box for register modal window -->
<div id="boxes">
	<div id="dialog1" class="window">
		<!-- Simple Modal Window |  <a href="#"class="closemodalwindow">Close it</a> -->
		<div class="modalwindowtop">
			<p>
				Sign Up / Register
				<a href="#"class="closemodalwindow">&nbsp;X&nbsp;</a>
			</p>
			
			<div class="clearfix"></div>
		</div>
		<div class="modalwindowfacebooklogin">
			<p align="center">
				<?php
                	$params = array(
  						//'scope' => 'read_stream, friends_likes, user_likes, publish_actions', // Get more from API Explorer page
				      	'scope' => 'email, publish_actions', // Get more from API Explorer page
				  		'redirect_uri' => 'http://www.techninja.fitied.com/home/facebook_login_success.php',
				  		//'display' => 'popup'
					);
					$login_url = $facebook->getLoginUrl($params);
					echo "<a href='" . $login_url . "'><img src='../res/images/fb_login.png' /></a>" ;
				?>
				<br><br>
				<span class="smaller">We assure you that your facebook profile is <strong>safe</strong> with us.</span>
				<!-- <img src='../res/images/fb_login.png' /> -->
			</p>
			<div class="clearfix"></div>
		</div>
		<div class="modalwindowaltline">
			<p align="center">
				------&nbsp;&nbsp;OR via TechNinija&nbsp;&nbsp;------
			</p>
			<div class="clearfix"></div>
		</div>
		<div class="modalwindowloginfields" align="center">
			<p align="center">
	            <form action="user_registration.php" method="POST">
	            	<input type="text" name="name" id="text-input" required="required" placeholder="Enter your Name">
	            	<input type="email" name="email" id="text-input" required="required" placeholder="Enter your Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
	            	
	            	<!--<input type="password" name="confirmpassword" id="text-input" required="required" placeholder="Re-enter the above password"> -->
	            	<input type="hidden" name="submitted">
	            	<input type="hidden" name="pageURL" value="<?php echo $_SERVER['PHP_SELF'] ; ?>">
	                <br>
	                <input type="submit" name="submit" id="submit" value="Register">
	            </form>
	            <p class="smaller">Already <strong>Registered</strong>!! Try <a href="login.php">Login</a></p>
	        </p>
			<div class="clearfix"></div>
		</div>
	</div>
</div>


<!-- Mask to cover the whole screen -->
<div id="mask"></div>




