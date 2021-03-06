<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/functions.php"); ?>


<?php 
global $errors;
$username = "";

	if( isset($_POST["submit"]) ){
		//Process the form

		//Start validation
		$required_fields = ["username", "password"];
		validate_presences($required_fields);

		//Attempt Login

		if( empty($errors) ){
			
			$username = $_POST["username"];
			$password = $_POST["password"];

			$found_admin = attempt_login($username, $password);

			if( $found_admin ){
			//success
			//Mark user as logged in
				$_SESSION["admin_id"] = $found_admin["id"];
				$_SESSION["username"] = $found_admin["username"];
				redirect_to("admin.php");
			} else {
				//Failute
				$_SESSION["message"] = "Username/Password not found.";
			}
		} //The end of if(empty($errors) )

	} else {
			//This is probaby a GET request
	}
?>


<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
		
  </div>
  <div id="page">
	<?php echo message(); ?>
	<?php echo form_errors($errors); ?>

	<h2>Login </h2>
	<form action="login.php" method="post">
		<p>Username:
			<input type="text" name="username" value="<?php echo htmlentities($username); ?>">
		</p>
		<p>Password:	
			<input type="password" name="password" value="" >
		</p>
		<input type="submit" name="submit" value="Submit">
	</form>
</div>

<?php include("../includes/layouts/footer.php"); ?>
