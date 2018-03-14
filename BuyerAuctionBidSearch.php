<?php
SESSION_START();

$categoryId = $_POST['categoryId'];


$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');

$sql = "SELECT A.itemId, B.name, B.description, B.categoryId, A.bidAmount FROM (select itemId, max(bidAmount) AS bidAmount from bids group by itemId) as A JOIN (SELECT itemId, name, description, startPrice, resPrice, categoryId, endDate from items WHERE endDate > CURRENT_TIMESTAMP() AND categoryId = '$categoryId') AS B ON A.itemId = B.itemId";

		
$result = $db->query($sql)
or die('Error with query'); 
echo '<tr>'."These Are the Current items on the category You have Searched For". '</tr>';
echo'<table border = "1">';



while ($row = $result->fetch_assoc()) {

echo '<tr><td>'."Name". '</td>'. '<td>' . $row['name'].'</td></tr>';
echo '<tr><td>' ."Item Description". '</td>'. '<td>' . $row['description'].'</td></tr>';
echo '<tr><td>' . "Bid Amount". '</td>'. '<td>' .'£'. $row['bidAmount'].'</td></tr>';
echo '<tr><td>'."<a href='bidPage.php?id=".$row['itemId']."'>BID ON ITEM</a>".'</td>'. '<td>'."".'</td></tr>';
//include a more bidOn button at bottom of table.	
}



echo '</table>';

mysqli_close($db);




 ?>

