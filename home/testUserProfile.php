<?php
    ob_start();
  	session_start();
  	$_SESSION['page'] = "LOGIN" ;

  	require_once('userProfile.php');

  	// return our current unix time in millis
	function current_millis() {
	    list($usec, $sec) = explode(" ", microtime());
	    return round(((float)$usec + (float)$sec) * 1000);
	}

  	$uProfile = new userProfile();

  	$uProfile->setName("Ankit");
  	echo $uProfile->getName() ;


  	echo "<br>" . uniqid() . "<br>";

?>

