<?php 

session_start();
$id = 0;
$name = "";
$location = "";

$update = False;

#database connection-------------------------------------------------------------
$mysqli = new SQLite3  ('people.db');
//$mysqli = new mysqli('localhost','root','','crud') or die ($mysqli);


#database queries----------------------------------------------------------------
//create data
if (isset($_POST['btn-save'])) {
	$nam = $_POST['u_name'];
	$loca = $_POST['u_address'];
	$mysqli->query("INSERT INTO people (name, location) VALUES ('$nam','$loca') ");

	$_SESSION['message'] ="Record '$nam' has been saved.";
}

//update data
if (isset($_GET['edit'])) { 
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("select * from people where rowid = $id");

	if ($result) {
		$row = $result->fetchArray();
		$name  = $row['name'];
		$location = $row['location'];

	}
}

if (isset($_POST['btn-update'])) {
	$upid = $_POST['id'];
	$nam = $_POST['u_name'];
	$loca = $_POST['u_address'];
	$mysqli->query("UPDATE people SET name = '$nam', location = '$loca' where rowid = $upid; ");

	$_SESSION['message'] ="Record '$nam' has been Updated. ";
}


//delete data
if(isset($_GET['delete'])){
	$delete = $_GET['delete'];
	$mysqli->query("DELETE from people where rowid='$delete';");

	$_SESSION['message'] ="Record $name has been deleted.";

	header('location:index.php');
}

