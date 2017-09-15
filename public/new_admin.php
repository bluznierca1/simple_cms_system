<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php 
  if( !isset($_SESSION['admin_id']) ){
    redirect_to("login.php");
  }
?>

<?php 
	global $errors;

	if( isset($_POST['submit']) ){
		$username = mysql_prep($_POST['username']);
		$hashed_password = password_encrypt($_POST['hashed_password']);

		//Start validation

		$required_fields = ['username', 'hashed_password'];
		validate_presences($required_fields);

		$fields_with_max_length = ['username' => 20, 'hashed_password' => 20];
		validate_max_lengths($fields_with_max_length);

		if( empty($errors) ){
			$query = "INSERT INTO admins ( ";
			$query .= "username, hashed_password ) ";
			$query .= "VALUES ( '{$username}', '{$hashed_password}' ) ";
			$result = mysqli_query($connection, $query);

			if( $result ){
				//Success - Created admin
				$_SESSION['message'] = "Admin Created!";
				redirect_to("manage_admins.php");
			} else {
				$_SESSION["message"] = "Something went wrong...";
			}
		}
	} 
?>


<?php 
	$context_layout = "admin";
	$context_menu = "admin"; 
?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<div id="main">
  <div id="navigation">
		
  </div>
  <div id="page">
	<h2>Create Admin</h2>
	
	<?php echo message(); ?>
	<?php echo form_errors($errors); ?>

	<form role="form" method="post" action="new_admin.php">
		<p>Username:
			<input type="text" name="username" value="" >
		</p>
		<p>Password:
			<input type="password" name="hashed_password" value="" >
		</p>
		<p>
			<input type="submit" name="submit" value="Create Admin">
		</p>
		<br/>
		<a href="manage_admins.php">Cancel</a>
	</form>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
