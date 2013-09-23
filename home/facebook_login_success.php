<?php
    ob_start();
  	session_start();
  	$_SESSION['page'] = "LOGIN" ;
  	require_once('../res/dbconfig.php');
  	require_once('userProfile.php');
  	require_once("../res/f-php-sdk/facebook.php");
?>

<?php

# Learn from - https://developers.facebook.com/docs/reference/php/facebook-getAccessToken/


$config = array();
$config['appId'] = '1410985479119424';
$config['secret'] = 'f58f2f098af2d5de26777b5f783a8f80';
$config['fileUpload'] = false; // optional

$facebook = new Facebook($config);

$uid = $facebook->getUser();

$uId = "" ;
$uEmail = "" ;
$uName = "" ;
$uGender = "" ;
$uPicture = "" ;

if($uid == 0){
	echo " <h2>Sorry Login not successful.</h2> " ;
	header( 'Location: http://www.techninja.fitied.com' ) ;
}else{
	// $params = array( 'next' => 'http://www.techninja.fitied.com/home/facebook_logout.php' );
	// $logout_url = $facebook->getLogoutUrl($params); // $params is optional.
	// echo "<a href='" . $logout_url . "'>Logout</a>" . "<br/>" ;

	// Access Token
	//echo " USER LOGGED IN UID = " . $uid . "<br/>" ; 
  	$access_token = $facebook->getAccessToken();
  	//echo "ACCESS_TOKEN = " . $access_token . "<br/>" ;

  	// User Profile
  	$user_profile = $facebook->api('/me?fields=name,gender,picture,email','GET');
  	// print_r($user_profile);
  	// echo "<br/>";

  	$count = 0 ;
  	foreach ($user_profile as $userAttr) {
  		if($count == 0){
  			// NAME
  			$uName = $userAttr ;
  		}elseif ($count == 1) {
  			// GENDER
  			$uGender = $userAttr ;
  		}elseif ($count == 2) {
  			// Email
  			$uEmail = $userAttr ;
  		}elseif ($count == 3) {
  			// ID
  			$uId = $userAttr ;
  		}elseif ($count == 4) {
  			// Picture
  			$gotPicture = 0 ;
  			foreach($userAttr as $picAttr){
  				foreach($picAttr as $picUrl){
  					$uPicture = $picUrl ;
  					$gotPicture = 1 ;
  					break ;
  				}//for
  				if($gotPicture == 1){
  					break ;
  				}
  			}//for
  		}else{
  			// Do nothing
  		}
  		$count++ ;
  	}

  	// Put the details in Database
  	//Check for same Id existence
  	$query = "SELECT id from users where id='$uId'";
  	$result = mysql_query($query) or trigger_error("Select Query Fails.");
    if(mysql_num_rows($result) == 0){
    	// Insert the record first time
    	date_default_timezone_set('UTC');
        $curr_date = date(DATE_RFC822);
    	$query = "INSERT INTO users(id, name, picture, email) VALUES('$uId', '$uName', '$uPicture', '$uEmail')";
        $result=mysql_query($query) or trigger_error("Insert Query Fails.");
        if(mysql_affected_rows() == 1){
        	// Insertion successful
        }else{
        	// Insertion Fails
        }
    }else{
    	// No Need to insert as already exist, just update
    	// Update other fields
    	$query = "Update users SET picture='" . $uPicture . "', name='" . $uName . "', email='" . $uEmail . "' where id='" . $uId . "'" ;
    	$result=mysql_query($query) or trigger_error("Update Query Fails.");
    	if(mysql_affected_rows() == 1){
    		// Updates done
    	}else{
    		// Nothing updated....all well
    	}
    }

    // Create userProfile object
    $uProfile = new userProfile();
    $uProfile->setName($uName);
    $uProfile->setPicture($uPicture);
    $uProfile->setId($uId);
    $uProfile->setEmail($uEmail);
    // echo "<br> Name: " . $uProfile->getName() . "<br>";
    // echo "<br> Email: " . $uProfile->getEmail() . "<br>";
    // echo "<br> Picture: " . $uProfile->getPicture() . "<br>";
    // echo "<br> Id: " . $uProfile->getId() . "<br>";

    $_SESSION['uid'] = $uId ;
    $_SESSION['uname'] = $uName ;
    $_SESSION['upicture'] = $uPicture ;
    $_SESSION['uemail'] = $uEmail ;
    $_SESSION['source'] = "Facebook" ;

    header( 'Location: http://www.techninja.fitied.com' ) ;

 	// User Friends
 	// $friends = $facebook->api('/me/friends?fields=name,gender,picture','GET');
  // 	print_r($friends) ;
  // 	echo "<br/>";

  	// User Permissions
  	// $grant_permissions = $facebook->api('/me/permissions','GET');
  	// print_r($grant_permissions);
  	// echo "<br/>";

  	// To delete User specific Permission
  	//$ret_del = $facebook->api('/me/permissions/friends_likes','DELETE');
  
  	// User Likes
  	//$my_likes = $facebook->api('/me/likes','GET');
  	//print_r($my_likes)  ;
  	//echo "<br/>";
  	//echo "<br/>";

  	// Publish on Facebook on User Wall
  	//$post_id = $facebook->api('/me/feed','POST',
    //array(
      //'link' => 'http://www.techninja.fitied.com'
      // 'message' => 'This is pure test message',
      // 'name' => 'My Post Name',
      // 'caption' => 'My Post caption',
      // 'description' => 'My Post description',
      //'privacy' => array('value' => 'ALL_FRIENDS') // privacy -> EVERYONE, SELF, ALL_FRIENDS
      //));
  	//print_r($post_id)  ;
  	//echo "<br/>";
  	//echo "<br/>";

  	//Like on facebook - Not Working
  	// echo "<br/><br/>Like action: <br/>";
  	// $like_action = $facebook->api('/me/og.likes', 'POST',
   //  array(
   //    'object' => 'http://www.techninja.fitied.com'
   //    ));
  	// print_r($like_action)  ;
  	// echo "<br/>";
}

?>