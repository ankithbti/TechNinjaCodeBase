<?php
    ob_start();
  	session_start();
  	$_SESSION['page'] = "CHANGEPASSWORD" ;
  	require_once('../res/dbconfig.php');
  	require_once('userProfile.php');

  	echo "<h2>Reset Login Page</h2>" ;
  	$base_page = 'http://www.techninja.fitied.com/home' ;

  	if(isset($_POST['submitted'])){
  		$uId = sha1(trim($_POST['email']));
		  $uEmail = $_POST['email'] ;
      $baseURL = $_POST['pageURL'] ;
      $base_page = $baseURL ;
      $uOldPassword = sha1($_POST['oldpassword']) ;
      $uNewPassword = $_POST['newpassword'] ;
      $uRePassword = $_POST['repassword'] ;
		
  		$query = "SELECT id, password from users where id='$uId'";
  		$result = mysql_query($query) or trigger_error("Select Query Fails.");
  		if(mysql_num_rows($result) == 0){
  			// ID not registered
  			header( 'Location: ' . $base_page . '?changeerror=Sorry!! The given email id is not registered with TechNinja.' ) ;
  		}else{
        // ID is in database, check whether old password is correct or not
        $row = mysql_fetch_array ($result, MYSQL_NUM);
        mysql_free_result($result);
        if ($row[1] != NULL && strcmp($row[1], $uOldPassword) == 0){
          // Entered Password matched
          // Update New password
          if(strcmp($uNewPassword, $uRePassword) != 0){
            // Confirm new Password is not equal to new password
            header( 'Location: ' . $base_page . '?changeerror=Sorry!! The given confirm password does not match with the given new password.' ) ;
          }else{
            // All good
            // Update Password in database
            $query = "Update users SET password='" . sha1($uNewPassword) . "' where id='" . $uId . "'" ;
            $result=mysql_query($query) or trigger_error("Update Query Fails.");
            if(mysql_affected_rows() == 1){
              // Updated successful

              // Send email
              // Updates done
              date_default_timezone_set('UTC');
              $curr_date = date(DATE_RFC822);
              //header( 'Location: http://www.techninja.fitied.com/home/?success=' . 'Congrats!! You are a Ninja Now.' ) ;
              $body = "<font color='gray' size='2px' face='tahoma'>";
              $body .= " <b>Hi " . $name . ",</b><br/><br/>Greetings from TechNinja. Thank you for changing your password.<br/>";
              $body .= " Your password has been changed successfully.<br/> " ;
              $body .= "<br/><br/>" ;
              $body .= "<b>Thanks & Regards<br/>TechNinja<br/><a href='http://www.techninja.fitied.com'>www.techninja.fitied.com</a></b>";
              $body .= "</font>" ;
              $from_address = "admin@techninja.fitied.com";
              $to = $uEmail ;
              $subject = 'Change Password with TechNinja Confirmed at ' . $curr_date ;
              //text/html\r\n ||||  ."Content-Type: text/plain; charset=utf-8\r\n"
              $headers = "MIME-Version: 1.0\r\n"
                ."Content-Type: text/html\r\n"
                ."Content-Transfer-Encoding: 8bit\r\n"
                ."From: =?UTF-8?B?". base64_encode($from_name) ."?= <$from_address>\r\n"
                ."X-Mailer: PHP/". phpversion();
              mail($to, $subject, $body, $headers, "-f $from_address");


              header( 'Location: ' . $base_page . '?changesuccess=Your password has been updated. You can Login with this new password.' ) ;
            }else{
              // Not Updated....Technical Issue
              header( 'Location: ' . $base_page . '?changeerror=Sorry!! There is some technical issue. Please Try again.' ) ;
            }
          }
        }else{
          // Old Password does not matched
          header( 'Location: ' . $base_page . '?changeerror=Sorry!! The given old password does not match with our record.' ) ;
        }
  		}
  	}else{
  		header( 'Location: ' . $base_page . '?changeerror=Please Submit the login form first.' ) ;
  	}
?>

