<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php 
	$context_layout = "admin";
	$context_menu = "admin"; 
?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<div id="main">
  <div id="navigation">
  <br />
	 <a href="admin.php">&laquo; Main menu</a><br />
  </div>
  <div id="page">
		<h2>Manage Admins</h2>
		
		<?php echo message();?>	

		<div>
			<table>
				<tr>
					<th style="text-align: left; width: 200px;"> Username </th>
					<th style="text-align: left;">Actions</th>
				</tr>
				<?php $admin_set = find_all_admins(); ?>
				<?php while( $admin = mysqli_fetch_assoc($admin_set) ){ ?>
				<tr>
					<td><?php echo htmlentities($admin["username"]); ?></td>
					<td><a href="edit_admin.php?id=<?php echo $admin["id"]; ?> ">Edit</a></td>
					<td><a href="remove_admin.php?id=<?php echo $admin["id"]; ?>" onclick="return confirm('Are you sure? ');">Remove </a></td>
				</tr>
				<?php } ?>
			</table>
			<br />
			<a href="new_admin.php">Add an Admin</a>

			<hr />

			<?php 

				
			?>
		</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
