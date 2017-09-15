<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php 	
	//If id is sent - Start performing
	if( $_GET['id'] ){
		$admin_id = $_GET['id'];

		//Updating
		$query = "DELETE FROM admins ";
		$query .= "WHERE id = {$admin_id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);

		if( $result && mysqli_affected_rows($connection) == 1 ){
			//success
			$_SESSION["message"] = "Admin deleted.";
			redirect_to("manage_admins.php");
		} else {
			$_SESSION["message"] = "Admin is NOT removed.";
			redirect_to("manage_admins.php");
		}
	} else {
		//ID is not sent - redirect
		redirect_to("manage_admins.php");
	}
?>