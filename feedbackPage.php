<?php
SESSION_START();

//data: buyerId, sellerId, feedback
$sellerId = $_POST["sellerId"];
$pointsGiven = $_POST ["pointsGiven"];
$buyerId = $_SESSION['buyerId'];


$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');
	//no need for verification, feedback is unique for buyerId and sellerId
	$sql = "INSERT INTO feedback (buyerId, sellerId, pointsGiven) VALUES ('$buyerId','$sellerId','$pointsGiven'";
	if ($db -> query($sql) === TRUE ) {
		echo "Feedback Given";
	} else {
 echo "error: " .$sql. "<br> " . $db -> error;
 		}
}

 $db -> close ();
 echo "<a href='buyerHome.php'>Return to Home</a>";

 ?>