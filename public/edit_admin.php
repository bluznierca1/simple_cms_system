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
	
	$admin = find_admin_by_id($_GET['id']);
	$id = $admin["id"];

	if( !$admin ){
		redirect_to("manage_admins.php");
	}
?>

<?php 
	// Performing updating after SUBMIT
	if( isset($_POST['submit']) ){
		$username = mysql_prep($_POST["username"]);
		$hashed_password = password_encrypt($_POST["hashed_password"]);

		// Form Validation
		$required_fields = ["username", "hashed_password"];
		validate_presences($required_fields);

		$fields_with_max_lengths = ["username" => 20, "hashed_password" => 20];
		validate_max_lengths($fields_with_max_lengths);

		// Checking if no errors
		if( empty($errors) ) {
			// Success 
			//Updating chosen Admin
			$query = "UPDATE admins SET ";
			$query .= "username = '{$username}', ";
			$query .= "hashed_password = '{$hashed_password}' ";
			$query .= "WHERE id = {$id} ";
			$query .= "LIMIT 1";
			$result = mysqli_query($connection, $query);

			//  checking if connection is well done
			if( $result && mysqli_affected_rows($connection) == 1 ){
				// Success
				$_SESSION["message"] = "Admin Updated.";
				redirect_to("manage_admins.php");
			} else {
				// Failure
				$_SESSION["message"] = "Admin Updation Failed.";
				redirect_to("manage_admins.php");
			}
		} else {
			$_SESSION["message"] = "Wrong password for chosen Admin. Edition failed!";
				redirect_to("manage_admins.php");
		}
			//Probably a GET request
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

	<form role="form" method="post" action="edit_admin.php?id=<?php echo $_GET['id']; ?> ">
		<p>Username:
			<input type="text" name="username" value="<?php echo htmlentities($admin['username']); ?>" >
		</p>
		<p>Password:
			<input type="password" name="hashed_password" value="" >
		</p>
		<p>
			<input type="submit" name="submit" value="Edit Admin">
		</p>
		<br/>
		<a href="manage_admins.php">Cancel</a>
	</form>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>