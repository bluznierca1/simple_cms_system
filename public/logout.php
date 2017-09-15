<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php 
	//Version 1: Simple logout

	$_SESSION['admin_id'] = null;
	$_SESSION['username'] = null;

	redirect_to("login.php");
?>

<!-- <?php 
	//Version 2: destroy session
//assumes nothing else in session to keep

	session_start();
	$_SESSION = [];
	if( isset($_COOKIE[session_name()]) ){
		setcookie(session_name(), '', time()-4200, '/');
	}
	session_destroy();
	redirect_to("login.php");
?> -->