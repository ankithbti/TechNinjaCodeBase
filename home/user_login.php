<?php
    ob_start();
  	session_start();
  	$_SESSION['page'] = "LOGIN" ;
  	require_once('../res/dbconfig.php');
  	require_once('userProfile.php');

  	echo "<h2>Login Page</h2>" ;
  	$base_page = 'http://www.techninja.fitied.com/home/login.php' ;

  	if(isset($_POST['submitted'])){
  		$uId = sha1(trim($_POST['email']));
		  $uEmail = $_POST['email'] ;
      //$baseURL = $_POST['pageURL'] ;
		  //$base_page = $baseURL ;
      $uPassword = sha1($_POST['password']) ;

		$query = "SELECT id, password, picture, name from users where id='$uId'";
		$result = mysql_query($query) or trigger_error("Select Query Fails.");
		if(mysql_num_rows($result) == 0){
			// ID not registered
			header( 'Location: ' . $base_page . '?error=' . 'It seems you are not a registered Ninja. Please Register.' ) ;
		}else{
			// ID is in database, now check password.
		  	$row = mysql_fetch_array ($result, MYSQL_NUM);
        	mysql_free_result($result);
        	if ($row[1] != NULL && strcmp($row[1], $uPassword) == 0){
        		// Entered Password matched
        		$_SESSION['uid'] = $uId ;
			    $_SESSION['uname'] = $row[3] ;
			    $_SESSION['upicture'] = $row[2] ;
			    $_SESSION['uemail'] = $uEmail ;
			    $_SESSION['source'] = "TechNinja" ;
    			header( 'Location: http://www.techninja.fitied.com/home' ) ;
        	}else{
        		// Password is wrong
        		header( 'Location: ' . $base_page . '?error=' . 'You have entered wrong password.' ) ;
        	}
		}
  	}else{
  		header( 'Location: ' . $base_page . '?error=' . 'Please Submit the login form first.' ) ;
  	}
?>

