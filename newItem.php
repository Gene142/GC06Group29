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





$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');
	

$sql = "INSERT INTO items (name, description, startPrice, resPrice, categoryId, endDate) 
VALUES('$description','$startPrice', '$resPrice', '$categoryId', '$endDate', '$name')";


if ($db -> query ($sql) === TRUE )
{
echo "New Record Successfully Created" ;
} else {
 echo "error: " .$sql. "<br> " . $db -> error;
 }
 $db -> close ();
 
 ?>