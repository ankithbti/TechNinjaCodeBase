<?php
    ob_start();
    session_start();
    $_SESSION['page'] = "LOGIN" ;
    include('htmlHeader.html');
?>

<?php

  # Learn from - https://developers.facebook.com/docs/reference/php/facebook-getAccessToken/
  require_once("../res/f-php-sdk/facebook.php");  

  $config = array();
  $config['appId'] = '1410985479119424';
  $config['secret'] = 'f58f2f098af2d5de26777b5f783a8f80';
  $config['fileUpload'] = false; // optional

  $facebook = new Facebook($config);

  $uid = $facebook->getUser();
  
//   $params = array(
//   'ok_session' => 'http://www.fitied.com/socialIntercation/AfterLogin_OK.php',
//   'no_user' => 'http://www.fitied.com/socialIntercation/Afterlogout.php',
//   'no_session' => 'http://www.fitied.com/socialIntercation/no_session.php',
// );

//$next_url = $facebook->getLoginStatusUrl($params);
//echo "NEXT URL = " . $next_url . "<br/>" ;

if($uid == 0){
	echo " USER NOT LOGGED IN " . "<br/>" ;
}else{
	echo " USER LOGGED IN UID = " . $uid . "<br/>" ; 
  $access_token = $facebook->getAccessToken();
  echo "ACCESS_TOKEN = " . $access_token . "<br/>" ;
}

if($uid == 0){
	$params = array(
  		//'scope' => 'read_stream, friends_likes, user_likes, publish_actions', // Get more from API Explorer page
      'scope' => 'email, publish_actions', // Get more from API Explorer page
  		'redirect_uri' => 'http://www.techninja.fitied.com/home/facebook_login_success.php',
  		//'display' => 'popup'
	);
	$login_url = $facebook->getLoginUrl($params);
	echo "<a href='" . $login_url . "'>Login</a>" . "<br/>";
}else{
  echo "Already Logged In" ;
	// $params = array( 'next' => 'http://www.fitied.com/socialIntercation/Afterlogout.php' );
	// $logout_url = $facebook->getLogoutUrl($params); // $params is optional.
	// echo "<a href='" . $logout_url . "'>Logout</a>" . "<br/>" ;

  // $user_profile = $facebook->api('/me?fields=name','GET');
  // print_r($user_profile);
  // echo "<br/>";
  
  // $friends = $facebook->api('/me/friends?fields=name,gender,picture','GET');
  // print_r($friends) ;
  // echo "<br/>";

  // $grant_permissions = $facebook->api('/me/permissions','GET');
  // print_r($grant_permissions);
  // echo "<br/>";

  // $ret_del = $facebook->api('/me/permissions/friends_likes','DELETE');
  
  // $grant_permissions = $facebook->api('/me/permissions','GET');
  // print_r($grant_permissions);
  // echo "<br/><br/>";

  // $my_likes = $facebook->api('/me/likes','GET');
  // print_r($my_likes)  ;
  // echo "<br/>";


  
  // Publish on Facebook
  //$post_id = $facebook->api('/me/feed','POST',
    //array(
      // 'link' => 'www.fitied.com/swar'
      // 'message' => 'This is pure test message',
      // 'name' => 'My Post Name',
      // 'caption' => 'My Post caption',
      // 'description' => 'My Post description',
      //'privacy' => array('value' => 'ALL_FRIENDS') // privacy -> EVERYONE, SELF, ALL_FRIENDS
      //));
  // print_r($post_id)  ;
  // echo "<br/>";
  // echo "<br/>";



  // //Like on facebook
  // $like_action = $facebook->api('/me/og.likes', 'POST',
  //   array(
  //     'object' => 'http://samples.ogp.me/226075010839791'
  //     ));
  // print_r($like_action)  ;
  // echo "<br/>";
}
?>