<?php
    ob_start();
  	session_start();
  	$_SESSION['page'] = "LOGIN" ;
  	require_once('../res/dbconfig.php');
  	require_once('userProfile.php');

  	echo "<h2>Register Page</h2>" ;
  	$base_page = 'http://www.techninja.fitied.com/home/register.php' ;

  	if(isset($_POST['submitted'])){
  		$uId = sha1(trim($_POST['email']));
		$uEmail = $_POST['email'] ;
		$uName = $_POST['name'] ;
		$uPassword = "ninja_" . substr($uId, 0, 3) ;
		$baseURL = $_POST['pageURL'] ;
		$base_page = $baseURL ;
		$uConfirmPassword = $uPassword ; // Can be used later

		if(strcmp($uPassword, $uConfirmPassword) != 0){
			header( 'Location: ' . $base_page . '?error=' . 'Two passwords entered were not same.' ) ;
		}else{
			// Put the details in Database
		  	//Check for same Id existence
		  	$query = "SELECT id from users where id='$uId'";
		  	$result = mysql_query($query) or trigger_error("Select Query Fails.");
		    if(mysql_num_rows($result) == 0){
		    	// Insert the record first time
		    	$query = "INSERT INTO users(id, name, email, password, source) VALUES('$uId', '$uName', '$uEmail', '" . sha1($uPassword) . "', 'TechNinja')";
		        $result=mysql_query($query) or trigger_error("Insert Query Fails.");
		        if(mysql_affected_rows() == 1){
		        	// Insertion successful
	                date_default_timezone_set('UTC');
	                $curr_date = date(DATE_RFC822);
		        	//header( 'Location: http://www.techninja.fitied.com/home/?success=' . 'Congrats!! You are a Ninja Now.' ) ;
		        	$body = "<font color='gray' size='2px' face='tahoma'>";
	                $body .= " <b>Hi " . $name . ",</b><br/><br/>Greetings from TechNinja. Thank you for registring.<br/>";
	                $body .= " To Login into your account, use password as given below:<br/> " ;
	                $body .= $uPassword ;
	                $body .= "<br/><br/>" ;
	                $body .= "It is advised to change this password for security reasons. Use below link to change the default password: <br/>" ;
	                $body .= "<a href='http://www.techninja.fitied.com/home/changePassword.php'>Change Password Link</a>";
	                $body .= "<br/><br/>" ;
	                $body .= "<b>Thanks & Regards<br/>TechNinja<br/><a href='http://www.techninja.fitied.com'>www.techninja.fitied.com</a></b>";
	                $body .= "</font>" ;
	                $from_address = "admin@techninja.fitied.com";
	                $to = $uEmail ;
	                $subject = 'Registration with TechNinja Confirmed at ' . $curr_date ;
	                //text/html\r\n ||||  ."Content-Type: text/plain; charset=utf-8\r\n"
	                $headers = "MIME-Version: 1.0\r\n"
	                  ."Content-Type: text/html\r\n"
	                  ."Content-Transfer-Encoding: 8bit\r\n"
	                  ."From: =?UTF-8?B?". base64_encode($from_name) ."?= <$from_address>\r\n"
	                  ."X-Mailer: PHP/". phpversion();
	                mail($to, $subject, $body, $headers, "-f $from_address");
	                header("Location: " . $base_page . "?success=Welcome to TechNinja World!!<br>A confirmation mail has been sent to your mail id with your login details.");
		        }else{
		        	// Insertion Fails
		        	header( 'Location: ' . $base_page . '?error=' . 'Some Technical error has happened. Please Sign Up again.' ) ;
		        	//echo "<br> Error: " . $query . "<br>";
		        }
		    }else{
		    	header( 'Location: ' . $base_page . '?error=' . 'You are already registered.<br> Try Login via TechNinja.' ) ;
		    }
		}
  	}else{
  		header( 'Location: ' . $base_page . '?error=' . 'Please Submit the form first.' ) ;
  	}
?>

