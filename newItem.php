<?php
SESSION_START();


//$itemID = $_POST ["itemID"];
$categoryId = $_POST ["categoryId"];
$description = $_POST ["description"];
$startPrice = $_POST ["startPrice"];
$resPrice = $_POST ["resPrice"];
$endDate = $_POST ["endDate"];
//$sellerID = $_POST ["sellerID"];
$name = $_POST ["name"];
//$highestBidID = $_POST ["highestBidID"];

$date = date('Y-m-d H:i:s');



$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');
	
//first double check endDate is > now
if($endDate > $date) {

	$sql = "INSERT INTO items (name, description, startPrice, resPrice, categoryId, endDate) 
	VALUES('$name','$description','$startPrice', '$resPrice', '$categoryId', '$endDate');";

	if ($db -> query ($sql) === TRUE ) {
		echo "New Record Successfully Created" ;
		echo "<a href="sellerHome.php">Return to Home</a>
	} else {
 echo "error: " .$sql. "<br> " . $db -> error;
 		}
}

 $db -> close ();
 
 ?>