<!DOCTYPE html>
<html>
<head>
	<title>Address Book</title>
	<link rel="stylesheet" type="text/css" href="address.css">
</head>
<body>
	<?php require_once('process.php'); ?>

	<?php 
		if (isset($_SESSION['message'])) {
			echo ($_SESSION['message'] );
			unset($_SESSION['message']);
		}
	?>

	<div class="container">
		<h1>Address Book</h1>

		<form action="index.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<label>Name: </label> 
			<input required class="text-input" type="text" name="u_name" placeholder="Enter Name" value="<?php echo $name; ?>" >  <br><br>
			<label>Address: </label> 
			<input class="text-input" type="text" name="u_address" placeholder="Enter Address" value="<?php echo $location; ?>"> <br>
			<?php 
				if ($update) {
					echo '<button class="btn-submit" type="submit" name="btn-update"> Update </button';
				}

				else {
					echo '<button class="btn-submit" type="submit" name="btn-save"> Save </button>';
				}
			?>

			
		</form>
	</div>

	<table>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Address</th>
			<th>Action</th>
		</tr>


		<?php
			$res = $mysqli->query('select  rowid,* from people;');
			$count = 1;
			
			while($row = $res->fetchArray()){
		?>		
				<tr>
					<td> <?php echo ( $count++ );  		?></td>
					<td> <?php echo ( $row['name'])     ?></td>
					<td> <?php echo ( $row['location']) ?></td>
					<td>
						<a href="index.php?edit=<?php echo($row['rowid']);  ?> " >Edit</a>
						<a href="process.php?delete=<?php echo($row['rowid']);  ?> " >Delete</a>
					</td>
				</tr>	
		<?php					
			}
		?>
	</table>

</body>
</html>