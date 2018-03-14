<?php
SESSION_START();

$Category = $_POST ['categoryId'];


$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');


$sql = "SELECT items.itemId, items.description, items.categoryId, bids.bidAmount FROM items 
INNER JOIN bids ON bids.itemId = items.itemId  WHERE items.categoryId = '$categoryId' 
ORDER  BY B=bids.bidAmount";



		
$result = $db->query($sql)
or die('Error with query'.mysql_error()); 
echo '<tr>'."These Are the Current items on the category You have Searched For". '</tr>' ;
echo'<table border = "1">';



while ($row= mysqli_fetch_array($result)) {

echo '<tr><td>'."Item ID No". '</td>'. '<td>' . $row['itemID'].'</td></tr>';
echo '<tr><td>' ."Item Description". '</td>'. '<td>' . $row['description'].'</td></tr>';
echo '<tr><td>' . "Bid Amount". '</td>'. '<td>' .'£'. $row['amount'].'</td></tr>';
	
}



echo '</table>';

mysqli_close($db);




 ?>

