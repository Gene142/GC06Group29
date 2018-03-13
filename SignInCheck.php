<?php 

//get variables
$username =  $_POST["email"];
$password = $_POST["inputPassword"];

//connect to DB
$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or die ('could not connect to database');

//set up query
$sql = "SELECT * FROM buyers WHERE email = '$username' AND password = '$password' ";
//run query
$result = $db->query($sql);

//if successful get information
if($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	//start session
	session_start();
	$_SESSION['userFirstName'] = $row['firstName'];
	$_SESSION['userId'] = $row['buyerId'];
	$_SESSION['userEmail'] = $row['email'];
	$_SESSION['userLastName'] = $row['lastName'];
	//lead to next page
	header("Location: buyerHome.php");
} else {
	echo("failed to login");
}

?>