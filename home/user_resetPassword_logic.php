<?php
    ob_start();
  	session_start();
  	$_SESSION['page'] = "RESETLOGIN" ;
  	require_once('../res/dbconfig.php');
  	require_once('userProfile.php');

  	echo "<h2>Reset Login Page</h2>" ;
  	$base_page = 'http://www.techninja.fitied.com/home/resetPassword.php' ;

  	if(isset($_POST['submitted'])){
  		$uId = sha1(trim($_POST['email']));
		  $uEmail = $_POST['email'] ;
      $uPassword = "ninja_" . substr($uId, 2,3);
		
		$query = "SELECT id from users where id='$uId'";
		$result = mysql_query($query) or trigger_error("Select Query Fails.");
		if(mysql_num_rows($result) == 0){
			// ID not registered
			header( 'Location: ' . $base_page . '?reseterror=Sorry!! The given email id is not registered with TechNinja. Please Register first on the right side.' ) ;
		}else{
			// ID is in database, now rset password.
      $query = "Update users SET password='" . sha1($uPassword) . "' where id='" . $uId . "'" ;
      $result=mysql_query($query) or trigger_error("Update Query Fails.");
      if(mysql_affected_rows() == 1){
        // Updates done
        date_default_timezone_set('UTC');
        $curr_date = date(DATE_RFC822);
        //header( 'Location: http://www.techninja.fitied.com/home/?success=' . 'Congrats!! You are a Ninja Now.' ) ;
        $body = "<font color='gray' size='2px' face='tahoma'>";
        $body .= " <b>Hi " . $name . ",</b><br/><br/>Greetings from TechNinja. Thank you for resetting password.<br/>";
        $body .= " To Login into your account, use password as given below:<br/> " ;
        $body .= $uPassword ;
        $body .= "<br/><br/>" ;
        $body .= "It is advised to change this password for security reasons. Use below link to change this reset password: <br/>" ;
        $body .= "<a href='http://www.techninja.fitied.com/home/changePassword.php'>Change Password Link</a>";
        $body .= "<br/><br/>" ;
        $body .= "<b>Thanks & Regards<br/>TechNinja<br/><a href='http://www.techninja.fitied.com'>www.techninja.fitied.com</a></b>";
        $body .= "</font>" ;
        $from_address = "admin@techninja.fitied.com";
        $to = $uEmail ;
        $subject = 'Reset Password with TechNinja Confirmed at ' . $curr_date ;
        //text/html\r\n ||||  ."Content-Type: text/plain; charset=utf-8\r\n"
        $headers = "MIME-Version: 1.0\r\n"
          ."Content-Type: text/html\r\n"
          ."Content-Transfer-Encoding: 8bit\r\n"
          ."From: =?UTF-8?B?". base64_encode($from_name) ."?= <$from_address>\r\n"
          ."X-Mailer: PHP/". phpversion();
        mail($to, $subject, $body, $headers, "-f $from_address");
        header("Location: " . $base_page . "?resetsuccess=Your Password has been reset successfully.<br>A confirmation mail has been sent to your mail id with your new password details.");
      }else{
        // Nothing updated....all well
        header( 'Location: ' . $base_page . '?reseterror=Sorry!! The password reset failed due to some technical issues. Please try again.' ) ;
      }
		  	
		}
  	}else{
  		header( 'Location: ' . $base_page . '?reseterror=Please Submit the login form first.' ) ;
  	}
?>

