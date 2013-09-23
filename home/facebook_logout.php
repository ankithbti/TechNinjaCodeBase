<?php
    ob_start();
  	session_start();
  	$_SESSION['page'] = "LOGIN" ;
?>
<?php
	unset($_SESSION['uid']) ;
	unset($_SESSION['uname']) ;
	unset($_SESSION['upicture']) ;
	unset($_SESSION['uemail']) ;
	unset($_SESSION['source']) ;
	setcookie('PHPSESSID', '', time()-3600, '/');
	header( 'Location: http://www.techninja.fitied.com' ) ;
?>